<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reorder extends Model
{
    use HasFactory;

    public $fillable = [
        // 'supplier_id',
        // 'patient_id',
        'item_id',
        // 'name',
        // 'quantity',
        // 'description',
        'quantity',
        // 'size',
        'status'
    ];

    // public function item()
    // {
    //     return $this->belongsTo(Item::class);
    // }

    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }

    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }

    public function item()
    {
        return $this->belongsTo(Item::class);
    }
}
