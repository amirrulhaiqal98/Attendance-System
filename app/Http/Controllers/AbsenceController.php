<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Absence;
use App\Models\Staff;

class AbsenceController extends Controller
{
    public function store(Request $request)
    {
        $checkStaff = Staff::where([
            'staff_id' => $request->staff_id
        ])->first();

        if(!$checkStaff){
            return redirect('/')->with('FailStaff','Anda Bukan Staff');
        }

        $check = Absence::where([
            'staff_id' => $request->staff_id,
            'date'     => date('Y-m-d')
        ])->first();

        if($check){
            return redirect('/')->with('Fail','Anda Sudah Hadir');
        }

        Absence::create([
            'staff_id' => $request->staff_id,
            'date'     => date('Y-m-d')
        ]);

        return redirect('/')->with('Success','Silakan Masuk');

    }
}
