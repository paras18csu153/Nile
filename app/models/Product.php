<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Enum\Role;

class Product extends Model
{

    protected $fillable = [
        'name', 'description', 'additionalInformation', 'category', 'image', 'price', 'quantity',
    ];

    public function create($user, $data){
        $user->products()->create($data);
    }

    public function get($id, $user){
        $product = Product::findOrFail($id);

        if($user && $user->role==Role::seller){
            if($product->user_id != $user->id){
                abort(403, "Unauthorized Access.");
            }
        }

        return $product;
    }

    public function getAllPaginatedProducts($user, $data){

        if(!$user && !$data["category"]){
            abort(404);
        }

        if(!$user || ($data["category"] && $user->role != Role::seller)){
            if($data["sortPrice"] == 'DESC'){
                $products = Product::where('name', 'like', $data["category"].'%')->orWhere('category', 'like', $data["category"].'%')->orderBy('price', $data["sortPrice"])->paginate(10);
                return $products;
            }
        
            $products = Product::where('name', 'like', $data["category"].'%')->orWhere('category', 'like', $data["category"].'%')->orderBy('price')->paginate(10);
            return $products;
        }

        if($data["category"] && $user->role == Role::seller){
            abort(403, "Unauthorized Access!!");
        }

        if($data["sortPrice"] == 'DESC'){
            $products = $user->products()->orderBy('price', $data["sortPrice"])->paginate(10);
            return $products;
        }
        
        $products = $user->products()->orderBy('price')->paginate(10);
        
        return $products;
    }

    public function getAllProducts($user, $data){
        $cart = $user->cart;
        $products = $cart->products()->orderBy("price", $data["sortPrice"])->get();
        
        return $products;
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function carts(){
        return $this->belongsToMany(Cart::class)->withPivot('quantity');
    }

    public function orders(){
        return $this->belongsToMany(Order::class)->withPivot('quantity');
    }
}
