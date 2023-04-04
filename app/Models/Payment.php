<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    public $fillable = [
        'purchase_id', 'amount', 'description', 'created_at', 'payment_mode'
    ];
    
    public function getCreatedAtAttribute($value)
    {
        return \Carbon\Carbon::parse($value)->format('M d, Y');
    }

    public function purchase() { 
        return $this->belongsTo(Purchase::class); }
}
