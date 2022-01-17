<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\ProductsService;
use App\Http\Middleware\CheckIsSeller;

class ProductsController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
        $this->middleware(CheckIsSeller::class);
    }

    public function create(){
        return view('products.create');
    }

    public function store(Request $request){
        $data = $this->validate($request, [
            'name' => 'required|string|max:100',
            'description' => 'required|string',
            'additionalInformation' => '',
            'category' => 'required|string',
            'price' => 'required|numeric|max:999999',
            'quantity' => 'required|numeric',
            'image' => 'required|image'
        ]);

        $productService = new ProductsService();

        $productService->setName($request['name']);
        $productService->setDescription($request['description']);
        $productService->setAdditionalInformation($request['additionalInformation']);
        $productService->setCategory($request['category']);
        $productService->setPrice($request['price']);
        $productService->setQuantity($request['quantity']);

        $imgPath = $request['image']->store('uploads', 'public');
        $productService->setImage($imgPath);

        $productService->create();

        return redirect('/home');
    }
}
