<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MeterReadingController extends Controller
{
    public function store(Request $request, \App\Models\Meter $meter) {
        $inputs = $request->validate([
           'value' => 'required',
            'reading_date' => 'required'
        ]);
        
        if (is_int($inputs['value'])) {
            $target = ($meter->estimated_annual_consumption / 12);

            if ($meter->getRawOriginal('installation_date') < $inputs['reading_date']) {
                if (($target * 1.25) >= $inputs['value']) {
                    if ($meter->readings()->create($inputs)) {
                        $request->session()->flash('create_success', 'Reading recorded successfully');
                    } else {
                        $request->session()->flash('create_error', 'Reading record error');
                    }    
                } else {
                    $request->session()->flash('create_error', 'Value is greater than expected!');
                }    
            } else {
                $request->session()->flash('create_error', 'Error: Reading date is earlier than the Meter installation date!');
            }    
        } else {
                $request->session()->flash('create_error', 'Error: Reading value must be whole number!');
        }
        
        return redirect()->route('meter.view', $meter->id);
    }
    
    public function generateEstimatedReading(Request $request, \App\Models\Meter $meter) {
        $lastRecord = $meter->readings()->get()->last();
        if ($lastRecord) {
            $dailyUsage = $meter->estimated_annual_consumption / 365;
            $original = $lastRecord->getRawOriginal('reading_date');
            $dayDiff = $lastRecord->dateDiff($original,$request->reading_date);
            $input = $request->validate([
                'reading_date' => 'required'
            ]);
            // may seems interesting the intval + floor but in my experience the intval sometimes make mistakes
            $input['value'] = intval(floor($dayDiff * $dailyUsage));
            $meter->readings()->create($input);
            $request->session()->flash('create_success', 'Reading recorded successfully');
        } else {
            $request->session()->flash('create_error', 'For autogenerate is required at least one reading from the customer!');
        }       
        return redirect()->route('meter.view', $meter->id);
    }
    
    public function destroy(Request $request, \App\Models\Meter $meter, \App\Models\MeterReading $reading) {
        try {
            $reading->delete();
            $request->session()->flash('delete_success','deleted succesfully!');
        } catch (Exception $ex) {
            $request->session()->flash('delete_error', ' delete error! Something went wrong :(');
        }
        
        return  redirect()->route('meter.view', $meter->id);
    }
}
