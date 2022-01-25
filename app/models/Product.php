<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    private $id;
    private $name;
    private $description;
    private $additionalInformation;
    private $category;
    private $sortPrice;
    private $price;
    private $quantity;
    private $image;

    protected $fillable = [
        'name', 'description', 'additionalInformation', 'category', 'image', 'price', 'quantity',
    ];

    function getId() {
        return $this->id;
    }

    function setId($id) {
        $this->id = $id;
    }

    function getName() {
        return $this->name;
    }

    function setName($name) {
        $this->name = $name;
    }

    function getDescription() {
        return $this->description;
    }

    function setDescription($description) {
        $this->description = $description;
    }

    function getAdditionalInformation() {
        return $this->additionalInformation;
    }

    function setAdditionalInformation($additionalInformation) {
        $this->additionalInformation = $additionalInformation;
    }

    function getCategory() {
        return $this->category;
    }

    function setCategory($category) {
        $this->category = $category;
    }

    function getSortPrice() {
        return $this->sortPrice;
    }

    function setSortPrice($sortPrice) {
        $this->sortPrice = $sortPrice;
    }

    function getPrice() {
        return $this->price;
    }

    function setPrice($price) {
        $this->price = $price;
    }

    function getQuantity() {
        return $this->quantity;
    }

    function setQuantity($quantity) {
        $this->quantity = $quantity;
    }

    function getImage() {
        return $this->image;
    }

    function setImage($image) {
        $this->image = $image;
    }

    public function create($user){
        $user->products()->create([
                'name' => $this->name,
                'description' => $this->description,
                'additionalInformation' => $this->additionalInformation,
                'category' => $this->category,
                'price' => $this->price,
                'quantity' => $this->quantity,
                'image' => $this->image
        ]);
    }

    public function get($id, $user){
        $product = Product::findOrFail($id);

        if($user && $user->role=="SELLER"){
            if($product->user_id != $user->id){
                abort(403, "Unauthorized Access.");
            }
        }

        return $product;
    }

    public function getAllPaginatedProducts($user){

        if(!$user && !$this->category){
            abort(404);
        }

        if(!$user || ($this->category && $user->role != 'SELLER')){
            if($this->sortPrice == 'DESC'){
                $products = Product::where('name', 'like', $this->category.'%')->orWhere('category', 'like', $this->category.'%')->orderBy('price', $this->sortPrice)->paginate(10);
                return $products;
            }
        
            $products = Product::where('name', 'like', $this->category.'%')->orWhere('category', 'like', $this->category.'%')->orderBy('price')->paginate(10);
            return $products;
        }

        if($this->category && $user->role == 'SELLER'){
            abort(403, "Unauthorized Access!!");
        }

        if($this->sortPrice == 'DESC'){
            $products = $user->products()->orderBy('price', $this->sortPrice)->paginate(10);
            return $products;
        }
        
        $products = $user->products()->orderBy('price')->paginate(10);
        
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
