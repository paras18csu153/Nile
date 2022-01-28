<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    public function create($user){
        if(!$user->cart){
            try{
                $user->cart()->create([]);
            }
            catch(Throwable $th){
                return $th;
            }
        }
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function products(){
        return $this->belongsToMany(Product::class)->withPivot('quantity');
    }
}
