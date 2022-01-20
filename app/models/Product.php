<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'name', 'description', 'additionalInformation', 'category', 'image', 'price', 'quantity',
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function carts(){
        return $this->belongsToMany(Cart::class)->withPivot('quantity');
    }
}
