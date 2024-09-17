<?php

namespace App\Http\Controllers\Admin;

use Auth;
use Hash;
use Carbon\Carbon;
use App\Models\City;
use App\Models\Role;
use App\Models\Admin;
use App\Models\Client;
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
use App\Http\Resources\Admin\Client\ClientCollection;

class ClientController extends Controller
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
            $datas = Client::orderBy('created_at','desc')
            ->with(['city', 'media']);

            $request->merge(['recordsTotal' => $datas->count(), 'length' => $request->length]);
            $datas = $datas->limit($request->length)->offset($request->start)->get();

            return response()->json(new ClientCollection($datas));

        }
        return view('admin.client.list');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request )
    {
        $roles = Role::whereNotIn('id',[1])->select(['id','name'])->get()->pluck('name','id')->toArray();
        return view('admin.client.create',compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        $client = Client::find($id);
        return view('admin.client.view',compact('client'));
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
                'company_name' => 'required|max:255',
                'locality' => 'required|max:255',
                'state' => 'required',
                'city' => 'required',
                'district' => 'required',
                'pincode' => 'required|integer|digits:6',
                'gst' => ['required', new GSTNumber()],
                'mobile_number' => ['required', new MobileNumber()],
            ]);

            $client = new Client;
            $client->gender = 3;
            $client->password = bcrypt(123456);
            $client->first_name = $request->first_name;
            $client->last_name = $request->last_name;
            $client->full_name = $request->first_name . " " .$request->last_name;
            $client->name_init = Str::upper(Str::limit($request->first_name, 1,'').Str::limit($request->last_name, 1,''));
            $client->email = $request->email;
            $client->mobile = $request->mobile_number;

            $client->address = $request->address;
            $client->state_id = $request->state;
            $client->city_id = $request->city;
            $client->district_id = $request->district;
            $client->pincode = $request->pincode;
            $client->landmark = $request->landmark;
            $client->gst = $request->gst;
            $client->company_name = $request->company_name;

            $client->locality = $request->locality;
            $client->status_id = 12;
            $client->color = $random;

            if($request->has('logo')){
                foreach($request->logo as $file){
                    $client->media_id = $file;
                }
            }

            if($client->save()){
                return response()->json(['class' => 'bg-success', 'error' => false, 'message' => 'Client Saved Successfully', 'call_back' => route('admin.client.index')]);
            }

            return redirect()->back()->with(['class'=>'error','message'=>'Whoops, looks like something went wrong ! Try again ...']);
        }


        public function edit(Request $request, $id ){
            $client = Client::find($id);
            return view('admin.client.edit',compact('client'));
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
                'first_name'=>'required|string|max:255',
                'address' => 'required|max:500',
                'company_name' => 'required|max:255',
                'locality' => 'required|max:255',
                'state' => 'required',
                'city' => 'required',
                'district' => 'required',
                'pincode' => 'required|integer|digits:6',
                'gst' => ['nullable', new GSTNumber()],
                'mobile_number' => ['required', new MobileNumber()],
            ]);

            $client = Admin::find($id);
            $client->gender = 3;
            $client->password = bcrypt($request->password);
            $client->first_name = $request->first_name;
            $client->last_name = $request->last_name;
            $client->full_name = $request->first_name . " " .$request->last_name;
            $client->name_init = Str::upper(Str::limit($request->first_name, 1,'').Str::limit($request->last_name, 1,''));
            $client->email = $request->email;
            $client->mobile = $request->mobile_number;
            $client->address = $request->address;
            $client->state_id = $request->state;
            $client->city_id = $request->city;
            $client->district_id = $request->district;
            $client->pincode = $request->pincode;
            $client->gst = $request->gst;
            $client->company_name = $request->company_name;
            $client->locality = $request->locality;
            $client->landmark = $request->landmark;
            $client->status_id = $request->status;
            $client->color = $random;

            if($request->has('logo')){
                foreach($request->logo as $file){
                    $client->media_id = $file;
                }
            }
            if($client->save()){
                return response()->json(['class' => 'bg-success', 'error' => false, 'message' => 'Client Saved Successfully', 'call_back' => route('admin.client.index')]);
            }
            return redirect()->back()->with(['class'=>'error','message'=>'Whoops, looks like something went wrong ! Try again ...']);
        }

}
