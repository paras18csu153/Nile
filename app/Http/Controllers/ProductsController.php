<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\ProductsService;
use App\Http\Middleware\CheckIsSeller;

class ProductsController extends Controller
{
    public function __construct() {
        $this->middleware('auth')->except('get', 'getAll');
        $this->middleware(CheckIsSeller::class)->except('get', 'getAll');
    }

    public function create(){
        return view('products.create');
    }

    public function store(Request $request){
        $data = $this->validate($request, [
            'name' => 'required|string|min: 10|max:100',
            'description' => 'required|string|min:50',
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

    public function get(Request $request, $id){
        $productService = new ProductsService();
        $product = $productService->get($id);

        return view('products.view', [
            'product' => $product
        ]);
    }

    public function getAll(Request $request, $category = null){
        $productService = new ProductsService();
        
        $productService->setSortPrice($request["sort_price"]);

        if($category){
            $productService->setCategory($category);
        }

        $products = $productService->getAll();

        return view('products.viewAll', [
            'products' => $products->appends(['sort_price' => $request["sort_price"], 'page' => $request["page"]]),
            'type' => $request["sort_price"]
        ]);
    }
}
