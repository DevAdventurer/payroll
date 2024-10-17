<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Services;
use App\Http\Resources\Admin\Fees\FeesCollection;
// use PhpOffice\PhpSpreadsheet\Calculation\Web\Service;

class ServiceContoller extends Controller
{
    public function index(Request $request)
{
    if ($request->wantsJson()) {
        // Fetch data with order and selection of columns
        $datas = Services::orderBy('name', 'asc')->select(['id', 'name', 'status']);

        // Get the total number of records before pagination
        $totalRecords = $datas->count();
        
        // Set default values for pagination if not provided
        $length = $request->input('length', 10);  // Default to 10 records per page
        $start = $request->input('start', 0);  // Default to starting from the first record
        
        // Apply pagination limits and offsets
        $datas = $datas->limit($length)->offset($start)->get();

        // Return a JSON response using the ServicesCollection resource
        return response()->json(new FeesCollection($datas, $totalRecords));
    }

    return view('admin.services.list');
}

    public function create(){
        return view('admin.services.create');
    }
    public function store(Request $request)
    {
        // Validate the input data
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'service_status' => 'required|in:active,inactive',
        ]);

        try {
            // Create a new service record
            $service = new Services();
            $service->name = $validatedData['name'];
            $service->status = $validatedData['service_status']; // Assuming the column in DB is 'status'
            $service->save();

            // Redirect back with success message
            return redirect()->back()->with(['class'=>'success', 'message'=>'Service Created successfully.']);
        } catch (\Exception $e) {
            // Redirect back with error message in case of failure
            return redirect()->back()->with(['class'=>'error', 'message'=>'Service not Created successfully.']);
        }
    }
    public function destroy( $id)
    {
        
        if(Services::where('id', $id)->delete()){
            
            return response()->json(['message'=>'Sevice deleted successfully ...', 'class'=>'success']);  
        }
        return response()->json(['message'=>'Whoops, looks like something went wrong ! Try again ...', 'class'=>'error']);
    }
    public function edit(string $id){
        $service=Services::find($id);
        return view('admin.services.edit',compact('service'));
    }
    public function update(Request $request, string $id)
{
    // Find the service by ID
    $service = Services::findOrFail($id);

    // Validate the incoming request data
    $request->validate([
        'name' => 'required|string|max:255',
        'service_status' => 'required',
    ]);

    // Update the service attributes
    $service->name = $request->input('name');
    $service->status = $request->input('service_status');

    // Save the changes to the database
    $service->save();

    // Redirect back with a success message
    return redirect()->route('admin.' . request()->segment(2) . '.index')
                     ->with(['class'=>'success', 'message'=>'Service Updated successfully.']);
}

}
