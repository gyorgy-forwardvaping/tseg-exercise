<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MeterController extends Controller
{
    public function list() {
        $meters = \App\Models\Meter::all();
        return view('index', compact('meters'));
    }
    
    public function store(Request $request) {
        $message = [];
        
            $inputs = $request->validate([
                'mpxn' => 'required',
                'installation_date' => 'required'
            ]);

            if ($request->type == 'gas' || $request->type == 'electricity') {
                $inputs['type'] = $request->type;
            } else {
                $message[] = "You need to select valid type for the meter!<br>";
            }

            if (($request->eac > 2000 && $request->eac < 8000) || $request->eac == 2000 || $request->eac == 8000) {
                $inputs['estimated_annual_consumption'] = $request->eac;
            } else {
                $message[] = "You need to give estimated annual consumption in the range between of 2000 and 8000!<br>";
            }



            if (count($message) == 0) {
                \App\Models\Meter::create($inputs);
                $request->session()->flash('create_success', $inputs['mpxn'] . ' is recorded successfully');
            } else {
                $request->session()->flash('create_error', implode('<br>', $message));
            }
        
        return redirect()->route('meter.list');
    }
    
    public function destroy(\App\Models\Meter $meter, Request $request) {
        $mpxn = $meter->mpxn;
        try {
            $meter->delete();
            $request->session()->flash('delete_success', $mpxn . ' deleted succesfully!');
        } catch (Exception $ex) {
            $request->session()->flash('delete_error', $mpxn . ' delete error! Something went wrong!');
        }
        
        return  redirect()->route('meter.list');
    }
    
    public function details(\App\Models\Meter $meter) {
        return view('meter.index', compact('meter'));
    }
}
