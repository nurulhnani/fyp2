<?php

namespace App\Http\Controllers;

use App\Models\AutoFields;
use Illuminate\Http\Request;

class AutoFieldsController extends Controller
{
    public function addMorePost(Request $request){

        $input = $request->all();
        $name = $request->input('name');
        // dd(count($name));
        $type = $request->input('type');
        $dropdownNote = $request->input('note');
        // dd($dropdownNote[0]);
        $user = $request->input('user');
        for($i=0; $i<count($name); $i++){
            $data= [
                'user'=>$user,
                'name'=>$name[$i],
                'type'=>$type[$i],
                'dropdownNote'=>$dropdownNote[$i]
            ];
            AutoFields::create($data);
        }
        return redirect()->route('customfield')->with('success',"Successfully added!");
    }
    
}
