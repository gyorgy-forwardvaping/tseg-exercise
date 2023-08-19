<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class MeterReading extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'meter_mpxn', 
        'value', 
        'reading_date'
    ];
    
    public function meter() {
        $this->belongsTo(Meter::class);
    }
    
    public function getReadingDateAttribute($date) {
        return (new Carbon($date))->format('d/m/Y');
    }
    
    public function dateDiff($toDate, $fromDate) {
        $to = Carbon::parse($toDate);
        $from = Carbon::parse($fromDate);
        
        return $to->diffInDays($from);
    }
}
