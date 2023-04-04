<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class In_out_item extends Model
{
    use HasFactory;

    public $fillable = [
        'item_id',
        'action',
        'quantity',
    ];


    public function getCreatedAtAttribute($value) {
        return \Carbon\Carbon::parse($value)->format('M d, Y');
    }

    public function item()
    {
        return $this->belongsTo(Item::class, 'item_id', 'id');
    }
}
