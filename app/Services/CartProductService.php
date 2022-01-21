<?php
namespace App\Services;

use Auth;
use DB;
use App\Models\Product;
use App\Models\Cart;

class CartProductService{
    private $product_id;
    private $type;
    private $quantity;

    function getProduct_id() {
        return $this->product_id;
    }

    function setProduct_id($product_id) {
        $this->product_id = $product_id;
    }

    function getQuantity() {
        return $this->quantity;
    }

    function setQuantity($quantity) {
        $this->quantity = $quantity;
    }

    function getType() {
        return $this->type;
    }

    function setType($type) {
        $this->type = $type;
    }

    public function create(){
        $product = Product::find($this->product_id);
        $user = Auth::user();
        $cart = $user->cart;
        
        if(!$cart){
            $user->cart()->create([]);
        }

        $products = $cart->products->toArray();
        foreach($products as $p){
            if($p["id"] == $product->id){
                DB::table('cart_product')->where(['cart_id'=>$cart->id, 'product_id'=>$p["id"]])->increment('quantity');
                return;
            }
        }

        $cart->products()->attach($product, ["quantity"=>$this->quantity]);
    }

    public function get(){
        $cart = Auth::user()->cart;
        
        if(!$cart){
            $cartService = new CartService();
            $cartService->create();
        }
        
        $products = $cart->products;

        return $products;
    }

    public function updateQuantity(){
        $cart = Auth::user()->cart;

        if($this->type == 'ADD'){
            DB::table('cart_product')->where(['cart_id'=>$cart->id, 'product_id'=>$this->product_id])->increment('quantity');
        }

        else{
            $product = Product::find($this->product_id);
            $cart_product = DB::table('cart_product')->where(['cart_id'=>$cart->id, 'product_id'=>$this->product_id])->get();
            if($cart_product[0]->quantity == 1){
                $cart->products()->detach($product);
            }
            else{
                DB::table('cart_product')->where(['cart_id'=>$cart->id, 'product_id'=>$this->product_id])->decrement('quantity');
            }
        }
    }
}
?>