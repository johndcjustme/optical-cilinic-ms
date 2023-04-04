<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User_activity extends Model
{
    use HasFactory;

    public $fillable = [
        'user_id', 'description'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
