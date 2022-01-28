<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;

class Order extends Model
{
    protected $fillable = [
        'payment_method', 'address'
    ];

    public function create($products){
        DB::transaction(function ($products) use ($products) {
            $cart = $request->user->cart;
            $order = $request->user->orders()->create([
                'payment_method' => 'Cash On Delivery (COD)',
                'address' => 'default'
            ]);

            $data=[];
            $entry=[];
    
            foreach($products as $p){
                $p = (object)$p;
                $entry["order_id"] = $order->id;
                $entry["product_id"] = $p->id;
                $entry["quantity"] = $p->pivot['quantity'];
                array_push($data, $entry);
                $entry=[];
            }

            DB::table("order_product")->insert($data);
    
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
