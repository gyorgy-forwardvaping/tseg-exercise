<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Meter extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'mpxn', 
        'installation_date', 
        'type', 
        'estimated_annual_consumption'
    ];
    
    public function readings() {
        return $this->hasMany(MeterReading::class);
    }
    
    public function getTypeAttribute($value) {
        return ucfirst($value);
    }
    
    public function getInstallationDateAttribute($date) {
        return (new Carbon($date))->format('d/m/Y');
    }
}
