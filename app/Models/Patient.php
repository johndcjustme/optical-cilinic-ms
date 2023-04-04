<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Categories;

class Patient extends Model
{
    use HasFactory;
    use Categories;

    public $fillable = [
        'name',
        'age',
        'gender',
        'address',
        'occupation',
        'mobile_1',
        'mobile_2',
        'email',
        'purpose',
        'queue',
        'queue_status',
        'date_queue',
        'is_member',
        'created_at',
    ];


    public function getMobileNumbersAttribute() {

        if (!empty($this->mobile_2)) {
            return "{$this->mobile_1} ● {$this->mobile_2}";
        } else {
            return "{$this->mobile_1}";
        }
    }

    public function getMembershipAttribute() {
        if ($this->is_member) 
            return 'King Coop.';
        else 
            return '';
    }


    public function getPtGenderAttribute() {
        return $this->gender ? 'Male' : 'Female';
    }

    public function getCreatedAtAttribute($value) {
        return \Carbon\Carbon::parse($value)->format('M d, Y');
    }

    public function getPtPurposeAttribute()
    {
        foreach ($this->from_trait_pt_purpose as $purpose)
            if ($purpose['value'] == $this->purpose) 
                return $purpose['purpose'];

        return;
    }
    
    public function appointment()
    {
        return $this->hasOne(Appointment::class);
    }

    public function refractions()
    {   
        return $this->hasMany(Refraction::class);
    }

    public function purchase()
    {
        return $this->hasMany(Purchase::class);
    }

    public function order_items()
    {
        return $this->hasMany(Order_item::class);
    }
}