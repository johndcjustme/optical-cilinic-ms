<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Categories;

class Appointment extends Model
{
    use HasFactory;
    use Categories;

    public $fillable = [
        'patient_id',
        'date',
        'time',
        'status',
        'is_rescheduled',
    ];



    public function getCurrentStatusAttribute()
    {
        foreach ($this->from_trait_pt_appointment_status as $status)
            if ($status['value'] == $this->status)
                return $status['title'];
        
        return;
    }

    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }
}
