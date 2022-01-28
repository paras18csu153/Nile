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

        $data["name"] = $request['name'];
        $data["description"] = $request['description'];
        $data["additionalInformation"] = $request['additionalInformation'];
        $data["category"] = $request['category'];
        $data["price"] = $request['price'];
        $data["quantity"] = $request['quantity'];

        $imgPath = $request['image']->store('uploads', 'public');
        $data["image"] = $imgPath;

        $user = Auth::user();
        $product->create($user, $data);

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
        
        $data["sortPrice"] = $request["sort_price"];

        if($category){
            $data["category"] = $category;
        }
        else{
            $data["category"] = null;
        }

        $user = Auth::user();

        $products = $product->getAllPaginatedProducts($user, $data);

        if($request->ajax()){
            $products = $product->getAllProducts($user, $data);
            return $products;
        }

        return view('products.viewAll', [
            'products' => $products->appends(['sort_price' => $request["sort_price"], 'page' => $request["page"]]),
            'type' => $request["sort_price"]
        ]);
    }
}
