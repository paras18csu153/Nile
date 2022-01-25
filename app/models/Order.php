<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;

class Order extends Model
{
    protected $fillable = [
        'payment_method', 'address'
    ];

    public function create($request, $user){
        DB::transaction(function ($request, $user) use ($request, $user) {
            $products = json_decode($request['products'], true);

            $cart = $user->cart;
            $order = $user->orders()->create([
                'payment_method' => 'Cash On Delivery (COD)',
                'address' => 'default'
            ]);
    
            foreach($products as $p){
                $p = (object)$p;
                $order->products()->attach($p->id, ['quantity'=> $p->pivot['quantity']]);
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
