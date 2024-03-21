<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Absence;

class AbsenceController extends Controller
{
    public function store(Request $request)
    {
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
