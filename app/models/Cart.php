<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Auth;

class Cart extends Model
{
    private $id;

    function getId() {
        return $this->id;
    }

    function setId($id) {
        $this->id = $id;
    }

    public function create(){
        $user = Auth::user();
        if(!$user->cart){
            try{
                $user->cart()->create([]);
            }
            catch(Exception $e){
                abort(500);
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
