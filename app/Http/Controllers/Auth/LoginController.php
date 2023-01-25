<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Models\Student;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\Interest_Inventory_Results;
use App\Models\LoginCount;
use App\Models\Teacher;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
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
      
        if(auth()->attempt(array('nric_mykid' => $input['email'], 'password' => $input['password'])))
        {
            // dd(auth()->user()->type);
            if(auth()->user()->first_login == null && auth()->user()->type == 'teacher'){
                return redirect()->route('password.request');
            }else if((auth()->user()->first_login == null) && (auth()->user()->type == 'student')){
                // dd(auth()->user()->type);
                // $user = User::find(auth()->user()->id);
                return redirect()->route('student-resetpassword',auth()->user()->id);
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
                
                $teacher = Teacher::where('name','=',auth()->user()->name)->first();
                if($teacher->status == 'active'){
                    //store login count
                    $userid = auth()->user()->id;
                    $login = new LoginCount;
                    $login->user_id = $userid;
                    $login->created_at = now();
                    $login->updated_at = now();
                    $login->save();

                    return redirect()->route('teacher.home');
                }else{
                    Auth::logout();
                    return redirect()->route('login')->with('error','You are no longer allowed to log into the system');
                }
                

            }else{

                $student = Student::where('name','=',auth()->user()->name)->first();
                if($student->status == 'active'){
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
                }else{
                    Auth::logout();
                    return redirect()->route('login')->with('error','You are no longer allowed to log into the system');
                }
                               
            }
        }else{
            return redirect()->route('login')
                ->with('error','NRIC/Mykid and Password are wrong.');
        }
           
    }
}
