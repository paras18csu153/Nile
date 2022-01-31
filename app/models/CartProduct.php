<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class CartProduct extends Model
{
    protected $table = "cart_product";

    public function findAndIncreaseQuantity($cartId, $productId){
        CartProduct::where(['cart_id'=>$cartId, 'product_id'=>$productId])->increment('quantity');
    }

    public function findAndDecreaseQuantity($cartId, $productId){
        CartProduct::where(['cart_id'=>$cartId, 'product_id'=>$productId])->decrement('quantity');
    }

    public function get($cartId, $productId){
        return CartProduct::where(['cart_id'=>$cartId, 'product_id'=>$productId])->get();
    }

    public function create($cartproduct, $user){
        if(!$cart){
            $cart = new Cart();
            $cart->create($user);
        }

        $user->cart->products()->attach($cartproduct["productId"], ["quantity"=>1]);
    }

    public function getProducts($user){
        $cart = $user->cart;
        
        if(!$cart){
            $cart = new Cart();
            $cart->create($user);
        }
        
        $products = $cart->products;

        return $products;
    }

    public function updateQuantity($cartproduct, $user){
        $cart = $user->cart;

        if($cartproduct["type"] == 'ADD'){
            $this->findAndIncreaseQuantity($cart->id, $cartproduct["productId"]);
            Product::find($cartproduct["productId"])->decrement('quantity');
        }

        else{
            $product = Product::find($cartproduct["productId"]);
            $cart_product = $this->get($cart->id, $cartproduct["productId"]);
            if($cart_product[0]->quantity == 1){
                $cart->products()->detach($product);
            }
            else{
                $this->findAndDecreaseQuantity($cart->id, $cartproduct["productId"]);
            }
            Product::find($cartproduct["productId"])->increment('quantity');
        }
    }
}
