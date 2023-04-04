<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Categories;

class Purchase_detail extends Model
{
    use HasFactory;
    use Categories;

    // public $timestamps = false;

    public $fillable = [
        'purchase_id',
        'item_id',
        'quantity',
        'price',
        'total',
        'action',
        'order_status',
    ];

    public function getCreatedAtAttribute($value) 
    {
        return \Carbon\Carbon::parse($value)->format('M d, Y');
    }

    public function getIsOrderAttribute()
    {
        return is_null($this->order_status) ? '' : 'Order';
    }

    public function getCurrentOrderStatusAttribute() 
    {
        foreach ($this->from_trait_order_status as $status) 
            if ($status['value'] == $this->order_status) 
                return $status['title'];

        return;
    }

    public function item()
    {
        return $this->belongsTo(Item::class);
    }

    public function purchase()
    {
        return $this->belongsTo(Purchase::class);
    }
    
}
