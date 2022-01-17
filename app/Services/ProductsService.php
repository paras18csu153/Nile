<?php
namespace App\Services;

use Auth;

class ProductsService{
    private $id;
    private $name;
    private $description;
    private $additionalInformation;
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
                'price' => $this->price,
                'quantity' => $this->quantity,
                'image' => $this->image
        ]);
    }
}
?>