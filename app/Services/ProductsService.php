<?php
namespace App\Services;

use Auth;
use App\Models\Product;

class ProductsService{
    private $id;
    private $name;
    private $description;
    private $additionalInformation;
    private $category;
    private $price;
    private $quantity;
    private $image;

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

    public function create(){
        Auth::user()->products()->create([
                'name' => $this->name,
                'description' => $this->description,
                'additionalInformation' => $this->additionalInformation,
                'category' => $this->category,
                'price' => $this->price,
                'quantity' => $this->quantity,
                'image' => $this->image
        ]);
    }

    public function get($id){
        $product = Product::findOrFail($id);
        return $product;
    }

    public function getAll(){
        $user = Auth::user();

        if(!$user && !$this->category){
            abort(404);
        }

        if(!$user || ($this->category && $user->role != 'SELLER')){
            $products = Product::where('category', $this->category)->paginate(10);
            return $products;
        }

        if($this->category && $user->role == 'SELLER'){
            abort(403, "Unauthorized Access!!");
        }

        $products = $user->products()->paginate(10);
        return $products;
    }
}
?>