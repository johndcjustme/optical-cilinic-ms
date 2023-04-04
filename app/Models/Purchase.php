<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    use HasFactory;

    public $fillable = [
        'patient_id',
        'refraction_id',
        'discount',
        'deposit',
        'total',
    ];

    public function getCreatedAtAttribute($value)
    {
        return \Carbon\Carbon::parse($value)->format('M d, Y');
    }
    
    public function refraction() {
        return $this->belongsTo(Refraction::class); }

    public function patient() {
        return $this->belongsTo(Patient::class); }

    public function purchase_details() {   
        return $this->hasMany(Purchase_detail::class); }

    public function payments() {
        return $this->hasMany(Payment::class); }
}
