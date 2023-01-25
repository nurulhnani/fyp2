<?php

namespace App\Http\Controllers;

use App\Models\AutoFields;
use Illuminate\Http\Request;

class AutoFieldsController extends Controller
{
    public function addMorePost(Request $request){

        $request->validate([
            'user'=>'required',
        ]);
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
        return redirect()->route('customfield')->with('success',"Custom field successfully added!");
    }

    public function showfields(){
        $customfields = AutoFields::all();
        // dd($customfields);
        return view('customfield.customizedfields',compact('customfields'));
    }

    public function deleteField($id){
        $customfield = AutoFields::find($id);
        // dd($customfield);

        $customfield->delete();
        return redirect()->back()->with('success',"Custom field successfully deleted!");
    }

    public function editField(Request $request,$id){
        $customfield = AutoFields::find($id);
        $customfield->user = $request->input('user');
        $customfield->name = $request->input('name');
        $customfield->type = $request->input('type');
        $customfield->dropdownNote = $request->input('description');
        $customfield->update();

        return redirect()->route('customfield')->with('success',"Custom field successfully updated!");
    }
    
}
