<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('dashboard');
    }
    
    public function changePwFirstLogin()
    {
        return view('auth.changePwFirstLogin');
    }

    public function adminHome()
    {
        return view('admin.home');
    } 
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function studentHome()
    {
        return view('students.home');
    }
   
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function teacherHome()
    {
        return view('teachers.home');
    }
    public function resetPw($id){
        $user = User::find($id);
        return view('auth.resetStudent',compact('user'));
    }
    public function updatePw(Request $request, $id){
        // dd($request->password != $request->password_confirmation);
        $user = User::find($id);
        if($request->password != $request->password_confirmation){
            return redirect()->route('student-resetpassword',$user->id)->with('error','Password does not match');
        }else{
            $user->password = Hash::make($request->password);
            $user->first_login = 1;
            $user->update();
            Auth::logout();
            return redirect()->route('login')->with('success','Password successfully updated. Please login');
        }    
        
    }
}
