<?php
namespace App\Services;

use Auth;
use DB;
use App\Models\Product;
use App\Models\Cart;

class CartProductService{
    public function create($cartproduct){
        $product = Product::find($cartproduct["productId"]);
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

        $cart->products()->attach($product, ["quantity"=>$cartproduct["quantity"]]);
    }

    public function get(){
        $cart = Auth::user()->cart;
        
        if(!$cart){
            $cart = new Cart();
            $cart->create();
        }
        
        $products = $cart->products;

        return $products;
    }

    public function updateQuantity($cartproduct){
        $cart = Auth::user()->cart;

        if($cartproduct["type"] == 'ADD'){
            DB::table('cart_product')->where(['cart_id'=>$cart->id, 'product_id'=>$cartproduct["productId"]])->increment('quantity');
            Product::find($cartproduct["productId"])->decrement('quantity');
        }

        else{
            $product = Product::find($cartproduct["productId"]);
            $cart_product = DB::table('cart_product')->where(['cart_id'=>$cart->id, 'product_id'=> $cartproduct["productId"]])->get();
            if($cart_product[0]->quantity == 1){
                $cart->products()->detach($product);
            }
            else{
                DB::table('cart_product')->where(['cart_id'=>$cart->id, 'product_id'=>$cartproduct["productId"]])->decrement('quantity');
            }
            Product::find($cartproduct["productId"])->increment('quantity');
        }
    }
}
?>