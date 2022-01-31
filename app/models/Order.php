<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;
use App\Models\OrderProduct;

class Order extends Model
{
    protected $fillable = [
        'payment_method', 'address'
    ];

    public function create($request){
        DB::transaction(function ($request) use ($request) {
            $cart = $request->user->cart;
            $order = $request->user->orders()->create([
                'payment_method' => 'Cash On Delivery (COD)',
                'address' => 'default'
            ]);

            $data=[];
            $entry=[];
    
            foreach($request->products as $p){
                $entry["order_id"] = $order->id;
                $entry["product_id"] = $p->id;
                $entry["quantity"] = $p->pivot['quantity'];
                array_push($data, $entry);
                $entry=[];
            }

            $orderProduct = new OrderProduct();
            $orderProduct->insertMultiple($data);
    
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
