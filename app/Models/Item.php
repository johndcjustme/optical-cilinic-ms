<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;

    public $fillable = [
        'category_id',
        'supplier_id',
        'image',
        'code',
        'name',
        'description',
        'quantity',
        'size',
        'type',
        'unit',
        'price',
        'price_code',
        'cost',
        'buffer',
        'sph',
        'cyl',
        'in_date',
        'out_date',
    ];

    public function getSphereAttribute() {
        return (!empty($this->sph) || !empty($this->cyl)) 
            ? "SPH: {$this->sph} • CYL: {$this->cyl}"
            : null;
    }

    public function getListGroupItemSizeSphereDescriptionAttribute() {
        $size = '--'; 
        $sphere = '--';
        $description = '--';

        if (!empty($this->size)) 
            $size = "SIZE: {$this->size}";
        if (!empty($this->sph) || !empty($this->cyl)) 
            $sphere = "SPH: {$this->sph} • CYL: {$this->cyl}";
        if (!empty($this->description))
            $description = "{$this->description}";

        return "{$size} | {$sphere} | {$description}";
    }

    public function category() { 
        return $this->belongsTo(Category::class, 'category_id', 'id')->withDefault(); }

    public function supplier() {
        return $this->belongsTo(Supplier::class, 'supplier_id', 'id')->withDefault(); }

    // public function in_out() {
    //     return $this->hasMany(In_out_item::class, 'item_id', 'id'); }


    public function in_out() {
        return $this->hasMany(Purchase_detail::class, 'item_id', 'id'); }


    // public function has_in_out() {
    //     return $this->hasOne(In_out_item::class)->latestOfMany(); }

    public function has_in_out() {
        return $this->hasOne(Purchase_detail::class)->latestOfMany(); }

    public function orders() {
        return $this->hasMany(Order::class); }

    // public function reorder() {
    //     return $this->hasMany(Purchase_detail::class); }
    public function reorder() {
        return $this->hasMany(Reorder::class); }

    public function purchase_items() {
        return $this->hasMany(Purchase_detail::class); }
}
