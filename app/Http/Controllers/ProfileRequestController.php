<?php

namespace App\Http\Controllers;

use App\Models\Profile_Request;
use App\Models\Student;
use App\Notifications\NewProfileRequestNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;


class ProfileRequestController extends Controller
{
    /* Admin Route */
    public function index()
    {
        $requests = Profile_Request::orderBy(DB::raw('case when status= "Pending" then 1 when status= "Approved" then 2 when status= "Declined" then 3 end'))
        ->orderBy('created_at', 'desc')
        ->get();
        $student_array = null;
        foreach ($requests as $request) {
            foreach (json_decode($request->changes) as $category => $val) {
                $student_array[$request->student_mykid][$category] = Student::where('mykid', '=', $request->student_mykid)
                    ->pluck($category)->all();
            }
        }
        return view('profileReq.index', compact('requests', 'student_array'));
    }

    public function storeApproval(Request $request, $id)
    {
        $profileReq = Profile_Request::findOrFail($id); //throw exception if not found
        $profile = Student::findOrFail($profileReq->student->id);

        if ($request->has('decline')) {
            $profileReq->status = 'Declined';
            $profileReq->save();
        } elseif ($request->has('approve')) {
            foreach (json_decode($profileReq->changes) as $category => $val) {
                $profile->$category = $val;
                $profileReq->status = 'Approved';
                $profile->save();
                $profileReq->save();
            }
        }
        return redirect()->route('manageProfileRequest')->with('success', 'Your approval result will be notified and reflected to the profile of respective students');
    }


    /* Student Route */
    public function storeRequest(Request $request)
    {
        $profileReq = $request->all();

        foreach ($profileReq as $category => $value) {
            if ($this->isSameAs($profileReq, $category)) {
                unset($profileReq[$category]);
            }
        }

        unset($profileReq['_token']);
        unset($profileReq['_method']);
        unset($profileReq['imageT']);

        $profileReqArr['changes'] = json_encode($profileReq);
        $profileReqArr['status'] = 'Pending';
        $profileReqArr['student_mykid'] = auth()->user()->nric_mykid;

        if($request->hasFile('imageT')){
            $student = Student::where('mykid',auth()->user()->nric_mykid)->first();
            $uploadedFileUrl = Cloudinary::upload($request->file('imageT')->getRealPath(), ['folder' => 'userImage'])->getSecurePath();
            $student->image_path = $uploadedFileUrl;
            $student -> update();
        }

        if(!empty(json_decode($profileReqArr['changes'], 1))){
            Profile_Request::create($profileReqArr);

            // $profile = Profile_Request::create($profileReqArr);
            /* Notifications */
            // $notification = Profile_Request::first();
            #store notification info into notifications table 
            // $notification->notify(new NewProfileRequestNotification($profile));
            // dd('user registered successfully, Notification send to Admin');

            return redirect()->route('viewstudentprofile')->with('success', 'You have been successfully updated your profile! Please wait for the admin approval');
        }
        return redirect()->route('viewstudentprofile');
    }

    public function isSameAs($profile, $category)
    {
        $student = Student::where('mykid', '=', auth()->user()->nric_mykid)->first()->toArray();
        if (array_key_exists($category, $student)) {
            if ($profile[$category] == $student[$category]) {
                return true;
            }
        }
        return false;
    }
}
