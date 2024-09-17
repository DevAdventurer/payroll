<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Models\Admin;
use App\Rules\ReCaptcha;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */


    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/admin/dashboard';



    public function showLoginForm()
    {
        return view('admin.auth.login');
    }





    public function login(Request $request)
    { 
        $request->validate([
            'password' => ['required'],
            'email' => ['required', 'email'],
            'g-recaptcha-response' => ['required', new ReCaptcha]
        ]);
    
        $remember_me = $request->has('remember_me') ? true : false;
    
        $check_status = Admin::where(['email' => $request->email, 'status_id' => 15])->first();
        if ($check_status) {
            return response()->json([
                'class' => 'bg-danger',
                'message' => 'You are not an active person, please contact the Owner.',
                'error' => true
            ]);
        }
    
        if ($this->guard()->attempt([
                'email' => $request->email, 
                'password' => $request->password, 
                'status_id' => 12 
            ], $remember_me)) {
    
            $user = $this->guard()->user();
    
            return response()->json([
                'class' => 'bg-success',
                'error' => false,
                'message' => 'Login Successfully'
            ]);
        }
    
        return response()->json([
            'class' => 'bg-danger',
            'message' => 'These credentials do not match our records.',
            'error' => true
        ]);
    }



    public function logout()
    {
        $this->guard()->logout();
        return redirect()->route('admin.login.form');
    }



    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('admin.guest', ['except' => 'logout']);
    // }


    protected function guard()
    {
        return Auth::guard('admin');
    }

}
