<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\User;
use Illuminate\Http\Request;
use PDF;

class PDFController extends Controller
{
    public function generatePDF($id)
    {
        $student = Student::find($id);
  
        $data = [
            'title' => 'Mescore Student Profiling System',
            'date' => date('d/m/Y'),
            'student' => $student
        ]; 

        // dd($data);
            
        $pdf = PDF::loadView('studentprofilePDF', $data)->setOptions(['defaultFont' => 'sans-serif']);
     
        return $pdf->download('student-profile.pdf');
    }
}
