<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Middleware\CheckIsSeller;

use App\Models\Product;
use Auth;

class ProductsController extends Controller
{
    public function __construct() {
        $this->middleware('auth')->except('get', 'getAllPaginatedProducts');
        $this->middleware(CheckIsSeller::class)->except('get', 'getAllPaginatedProducts');
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

        $product = new Product();

        $product->setName($request['name']);
        $product->setDescription($request['description']);
        $product->setAdditionalInformation($request['additionalInformation']);
        $product->setCategory($request['category']);
        $product->setPrice($request['price']);
        $product->setQuantity($request['quantity']);

        $imgPath = $request['image']->store('uploads', 'public');
        $product->setImage($imgPath);

        $user = Auth::user();
        $product->create($user);

        return redirect('/home');
    }

    public function get(Request $request, $id){
        $product = new Product();
        $user = Auth::user();
        $product = $product->get($id, $user);

        return view('products.view', [
            'product' => $product
        ]);
    }

    public function getAllPaginatedProducts(Request $request, $category = null){
        $product = new Product();
        
        $product->setSortPrice($request["sort_price"]);

        if($category){
            $product->setCategory($category);
        }

        $user = Auth::user();

        $products = $product->getAgetAllPaginatedProducts($user);

        return view('products.viewAll', [
            'products' => $products->appends(['sort_price' => $request["sort_price"], 'page' => $request["page"]]),
            'type' => $request["sort_price"]
        ]);
    }
}
