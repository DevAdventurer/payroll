<?php

namespace App\Http\Controllers\Admin;

use Auth;
use Hash;
use Carbon\Carbon;
use App\Models\City;
use App\Models\Role;
use App\Models\Admin;
use App\Models\Employee;
use App\Models\Wallet;
use App\Rules\GSTNumber;
use App\Rules\MobileNumber;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Crypt;
use App\Http\Resources\Admin\Employee\EmployeeCollection;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->wantsJson()) {
            //dd($request->all());
            $datas = Employee::orderBy('created_at','desc')
            ->with(['city', 'media']);

            $request->merge(['recordsTotal' => $datas->count(), 'length' => $request->length]);
            $datas = $datas->limit($request->length)->offset($request->start)->get();

            return response()->json(new EmployeeCollection($datas));

        }
        return view('admin.employee.list');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request )
    {
        return view('admin.employee.create');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        $employee = Employee::find($id);
        return view('admin.employee.view',compact('employee'));
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
        public function store(Request $request) {
            $array = ['primary', 'secondary', 'success', 'info', 'warning', 'danger'];
            $random = Arr::random($array);

            $request->validate([
                'last_name'=>'required|string|max:255',
                'password'=>'required|string|min:6',
                'email'=>'required|email|max:255|unique:admins',
                'first_name'=>'required|string|max:255',
                'address' => 'required|max:500',
                'company' => 'required',
                'locality' => 'required|max:255',
                'state' => 'required',
                'city' => 'required',
                'district' => 'required',
                'pincode' => 'required|integer|digits:6',
                'role' => 'required',
                'mobile_number' => ['required', new MobileNumber()],
            ]);

            $employee = new Employee;
            $employee->parent = $request->company;
            $employee->role_id = $request->role;
            $employee->gender = 3;
            $employee->password = bcrypt(123456);
            $employee->first_name = $request->first_name;
            $employee->last_name = $request->last_name;
            $employee->full_name = $request->first_name . " " .$request->last_name;
            $employee->name_init = Str::upper(Str::limit($request->first_name, 1,'').Str::limit($request->last_name, 1,''));
            $employee->email = $request->email;
            $employee->mobile = $request->mobile_number;

            $employee->address = $request->address;
            $employee->state_id = $request->state;
            $employee->city_id = $request->city;
            $employee->district_id = $request->district;
            $employee->pincode = $request->pincode;
            $employee->landmark = $request->landmark;
            $employee->company_name = $request->company_name;

            $employee->locality = $request->locality;
            $employee->status_id = 12;
            $employee->color = $random;

            if($request->has('logo')){
                foreach($request->logo as $file){
                    $employee->media_id = $file;
                }
            }

            if($employee->save()){
                return response()->json(['class' => 'bg-success', 'error' => false, 'message' => 'Employee Saved Successfully', 'call_back' => route('admin.employee.index')]);
            }

            return redirect()->back()->with(['class'=>'error','message'=>'Whoops, looks like something went wrong ! Try again ...']);
        }


        public function edit(Request $request, $id ){
            $employee = Employee::find($id);
            return view('admin.employee.edit',compact('employee'));
        }






        public function update(Request $request, $id) {
            $array = ['primary', 'secondary', 'success', 'info', 'warning', 'danger'];
            $random = Arr::random($array);

            $request->validate([
                'last_name'=>'required|string|max:255',
                'status'=>'required',
                'email' => [
                    'required',
                    'email',
                    'max:255',
                    Rule::unique('admins')->ignore($id) // Ignore the email uniqueness if it's an update
                ],
                'role' => 'required',
                'password'=>'required|string|min:6',
                'first_name'=>'required|string|max:255',
                'address' => 'required|max:500',
                'company' => 'required',
                'locality' => 'required|max:255',
                'state' => 'required',
                'city' => 'required',
                'district' => 'required',
                'pincode' => 'required|integer|digits:6',
                'mobile_number' => ['required', new MobileNumber()],
            ]);

            $employee = Admin::find($id);
            $employee->gender = 3;
            $employee->parent = $request->company;
            $employee->role_id = $request->role;
            $employee->password = bcrypt($request->password);
            $employee->first_name = $request->first_name;
            $employee->last_name = $request->last_name;
            $employee->full_name = $request->first_name . " " .$request->last_name;
            $employee->name_init = Str::upper(Str::limit($request->first_name, 1,'').Str::limit($request->last_name, 1,''));
            $employee->email = $request->email;
            $employee->mobile = $request->mobile_number;
            $employee->address = $request->address;
            $employee->state_id = $request->state;
            $employee->city_id = $request->city;
            $employee->district_id = $request->district;
            $employee->pincode = $request->pincode;
            $employee->company_name = $request->company_name;
            $employee->locality = $request->locality;
            $employee->landmark = $request->landmark;
            $employee->status_id = $request->status;
            $employee->color = $random;

            if($request->has('logo')){
                foreach($request->logo as $file){
                    $employee->media_id = $file;
                }
            }
            if($employee->save()){
                return response()->json(['class' => 'bg-success', 'error' => false, 'message' => 'Employee Saved Successfully', 'call_back' => route('admin.employee.index')]);
            }
            return redirect()->back()->with(['class'=>'error','message'=>'Whoops, looks like something went wrong ! Try again ...']);
        }

}
