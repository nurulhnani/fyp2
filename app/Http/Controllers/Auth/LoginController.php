<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Models\Student;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\Interest_Inventory_Results;
use App\Models\LoginCount;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

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

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    // protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function login(Request $request)
    {   
        $input = $request->all();
      
        $this->validate($request, [
            'email' => 'required',
            'password' => 'required',
        ]);
      
        if(auth()->attempt(array('email' => $input['email'], 'password' => $input['password'])))
        {
            // dd(auth()->user()->first_login);
            if(auth()->user()->first_login == null){
                return redirect()->route('password.request');
            }else if (auth()->user()->type == 'admin') {

                //store login count
                $userid = auth()->user()->id;
                $login = new LoginCount;
                $login->user_id = $userid;
                $login->created_at = now();
                $login->updated_at = now();
                $login->save();

                return redirect()->route('admin.home');

            }else if (auth()->user()->type == 'teacher') {
                
                //store login count
                $userid = auth()->user()->id;
                $login = new LoginCount;
                $login->user_id = $userid;
                $login->created_at = now();
                $login->updated_at = now();
                $login->save();

                return redirect()->route('teacher.home');

            }else{

                //store login count
                $userid = auth()->user()->id;
                $login = new LoginCount;
                $login->user_id = $userid;
                $login->created_at = now();
                $login->updated_at = now();
                $login->save();
                
                $studentname = auth()->user()->name;
                $studentid = Student::where('name',$studentname)->first()->id;
                return redirect()->route('studenthome',$studentid);
            }
        }else{
            return redirect()->route('login')
                ->with('error','Email-Address And Password Are Wrong.');
        }
           
    }
}
