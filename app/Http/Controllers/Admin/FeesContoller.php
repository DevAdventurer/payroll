<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Company;
use Illuminate\Http\Request;
use App\Models\FeePayment;
use App\Http\Resources\Admin\Services\ServicesCollection;


class FeesContoller extends Controller
{
    public function index(Request $request){
        if ($request->wantsJson()) {
            // Fetch data with order and selection of columns
            $datas = Company::orderBy('name', 'asc')->select(['id', 'name'])->where('entity_type', 'company');
    
            // Get the total number of records before pagination
            $totalRecords = $datas->count();
            
            // Set default values for pagination if not provided
            $length = $request->input('length', 10);  // Default to 10 records per page
            $start = $request->input('start', 0);  // Default to starting from the first record
            
            // Apply pagination limits and offsets
            $datas = $datas->limit($length)->offset($start)->get();
    
            // Return a JSON response using the ServicesCollection resource
            return response()->json(new ServicesCollection($datas, $totalRecords));
        }
        // $companies=Company::where('entity_type','company')->get();
        
        return view('admin.Fees.list');
    }
    public function store(Request $request){
        $request->validate([
            'company_id'   => 'required|exists:admins,id', // Ensure company_id exists in admins table
            'month'        => 'required|string', // Validates the month as a string
            'year'         => 'required|digits:4', // Validates the year as a 4-digit number
            'fee_amount'   => 'required|numeric|min:0', // Validates the fee amount as a positive number
            'doc_no' => 'required', // Ensures the payment_type is either 'fees' or 'payment'
        ]);
        try {
            // Store the fee payment record
            FeePayment::create([
                'company_id'   => $request->company_id,
                'month'        => $request->month,
                'year'         => $request->year,
                'fee_amount'   => $request->fee_amount,
                'payment_type' => 'Payment',
                'doc_no'=>$request->doc_no,
            ]);
    
            // Redirect back with a success message
            return redirect()->back()->with(['class'=>'success', 'message'=>'Payemnt Created successfully.']);
    
        } catch (\Exception $e) {
            // Log the exception and show an error message
            \Log::error("Error saving FeePayment: " . $e->getMessage());
    
            return redirect()->back()->with(['class'=>'error', 'message'=>'Payment not Created successfully.']);
        }
    }
    public function create(){
        $companies=Company::where('entity_type','company')->get();
        return view('admin.Fees.create',compact('companies'));
    }
    public function show($id){
                $company = Company::find($id); // Fetch a single company by its ID
                $name=$company->name;
        if ($company) {
            // Get all fee and payment transactions for this company
            $feePayments = FeePayment::where('company_id', $company->id)
                ->orderBy('created_at', 'asc') // Assuming there's a `payment_date` column
                ->get();

            // Initialize an array to hold transaction data
            $transactions = [];

            // Loop through each fee payment
            foreach ($feePayments as $payment) {
                // Classify payment type as either 'debit' or 'credit'
                $type = $payment->payment_type === 'fees' ? 'debit' : 'credit';

                $transactions[] = [
                    'date' => $payment->month, // Assuming there's a 'payment_date' column
                    'type' => $type,
                    'amount' => $payment->fee_amount,
                    'doc_no'=>$payment->doc_no
                ];
            }

            // Calculate total fees (debit) and total payments (credit)
            $totalFees = $feePayments->where('payment_type', 'fees')->sum('fee_amount');
            $totalPayments = $feePayments->where('payment_type', 'payment')->sum('fee_amount');
            $pending = $totalFees - $totalPayments; // Calculate pending amount

            // Prepare the final data array for this company
            $data = [
                'company_id' => $company->id,
                'company_name' => $company->name,
                'total_fees' => $totalFees,
                'total_received_payments' => $totalPayments,
                'pending' => $pending,
                'transactions' => $transactions, // Include the transactions data
            ];
            // dd($data);
                // Return or use $data as needed
                return view('admin.Fees.view',compact('data','name'));
            } else {
                // Handle case where the company is not found
                return response()->json(['error' => 'Company not found'], 404);
            }

    }
}
