<?php

namespace App\Http\Controllers;

use App\Imports\MeritPointsImport;
use App\Models\Merit_Points;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;


class MeritPointsController extends Controller
{
    public function index()
    {
        $meritsArr = Merit_Points::orderBy('merit_points', 'desc')->get();
        if (count($meritsArr) == 0) {
            MeritPointsController::loadMerit();
        }
        return view('meritPoints.index', compact('meritsArr'));
    }

    public function loadMerit()
    {
        $contents = file_get_contents('https://res.cloudinary.com/hme0x9wjh/raw/upload/v1673726066/Merits_dvdyxz.xlsx');
        file_put_contents('merit.xlsx', $contents);
        Excel::import(new MeritPointsImport, 'merit.xlsx');
    }

    public function store(Request $request)
    {
        $newMerit = $request->all();
        Merit_Points::create($newMerit);

        return redirect()->route('manageMerit')->with('success', 'Your merit record has successfully added');
    }

    public function update(Request $request, $id)
    {
        $updateMerit = $request->all();
        $meritPoints = Merit_Points::find($id);
        $meritPoints->update($updateMerit);
        return redirect()->route('manageMerit')->with('success', 'Your merit record has successfully updated');
    }

    public function destroy($id)
    {
        $meritPoints = Merit_Points::find($id);
        $meritPoints->delete();
        return redirect()->route('manageMerit')->with('success', 'Your merit record has successfully deleted');
    }
}
