<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Categories;

class Order_item extends Model
{
    use HasFactory;
    use Categories;


    public $fillable = [
        'refraction_id',
        'category_id',
        'patient_id',
        'supplier_id',
        'name',
        'description',
        'quantity',
        'code',
        'size',
        'status',
        'price'
    ];

    public function getCurrentStatusAttribute() 
    {
        foreach ($this->from_trait_order_status as $status) 
            if ($status['value'] == $this->status) 
                return $status['title'];

        return;
    }

    public function getCreatedAtAttribute($value) {
        return \Carbon\Carbon::parse($value)->format('M d, Y');
    }

    public function supplier() {
        return $this->belongsTo(Supplier::class);
    }

    public function patient() {
        return $this->belongsTo(Patient::class);
    }

    public function refraction() {
        return $this->belongsTo(Refraction::class);
    }
}
