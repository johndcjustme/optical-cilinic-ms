<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Refraction extends Model
{
    use HasFactory;

    public $incrementing = false;

    public $fillable = [
        'id',
        'patient_id',
        'OD_SPH',
        'OD_CYL',
        'OD_AXIS',
        'OD_NVA',
        'OD_PH',
        'OD_CVA',
        'OS_SPH',
        'OS_CYL',
        'OS_AXIS',
        'OS_NVA',
        'OS_PH',
        'OS_CVA',
        'ADD',
        'PD',
        'remarks',
        'frame',
        'lense',
        'tint',
        'particulars',
    ];

    public function getCreatedAtAttribute($value) {
        return \Carbon\Carbon::parse($value)->format('M d, Y'); }

    public function patient() {
        return $this->belongsTo(Patient::class); }

    public function purchase() {
        return $this->hasMany(Purchase::class); }

    public function order() {
        return $this->hasOne(Order_item::class); }
}
