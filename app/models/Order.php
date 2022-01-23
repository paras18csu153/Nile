<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Auth;
use DB;

class Order extends Model
{
    protected $fillable = [
        'payment_method', 'address'
    ];

    public function create($request){
        DB::transaction(function ($request) use ($request) {
            $products = json_decode($request['products'], true);
            $user = Auth::user();

            $cart = $user->cart;
            $order = $user->orders()->create([
                'payment_method' => 'Cash On Delivery (COD)',
                'address' => 'default'
            ]);
    
            foreach($products as $p){
                $p = Product::find($p["id"]);
                $order->products()->attach($p, ['quantity'=> $p->carts()->where('cart_id', $cart->id)->first()->pivot->quantity]);
                Product::find($p["id"])->update(["quantity" => ($p->quantity - $p->carts()->where('cart_id', $cart->id)->first()->pivot->quantity)]);
            }
    
            $cart->products()->detach();
        }, 5);
    }
    
    public function user(){
        return $this->belongsTo(User::class);
    }

    public function products(){
        return $this->belongsToMany(Product::class)->withPivot('quantity');
    }
}
