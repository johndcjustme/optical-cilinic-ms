<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    use HasFactory;

    public $timestamps = false;

    public $fillable = [
        'code',
        'name',
        'mobile_1',
        // 'mobile_2',
        'email',
        'address',
        'branch',
        'account_name',
        'account_number',
    ];

    public function getMobileNumbersAttribute() {

        if (!empty($this->mobile_2)) {
            return "{$this->mobile_1} ● {$this->mobile_2}";
        } else {
            return "{$this->mobile_1}";
        }

    }

    public function order_items()
    {
        return $this->hasMany(Order_item::class);
    }
}
