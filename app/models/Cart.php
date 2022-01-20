<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    public function user(){
        return $this->belongsTo(User::class);
    }

    public function products(){
        return $this->belongsToMany(Product::class)->withPivot('quantity');
    }
}
