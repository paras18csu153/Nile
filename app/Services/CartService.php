<?php
namespace App\Services;

use Auth;
use App\Models\Cart;

class CartService{
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
            $user->cart()->create([]);
        }
    }
}
?>