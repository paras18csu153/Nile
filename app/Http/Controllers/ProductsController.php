<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Middleware\CheckIsSeller;

use App\Models\Product;
use App\Http\Requests\StoreProduct;
use Auth;
use App\Enum\Role;
use App\Http\Requests\SearchProduct;
use App\Http\Requests\ProductRequest;

class ProductsController extends Controller
{
    public function __construct() {
        $this->middleware('auth')->except('get', 'getAllProducts', 'getAllPaginatedProducts');
        $this->middleware(CheckIsSeller::class)->except('get', 'getAllProducts', 'getAllPaginatedProducts');
    }

    public function create(){
        return view('products.create');
    }

    public function store(StoreProduct $request){
        // $data = $this->validate($request, [
        //     'name' => 'required|string|min: 10|max:100',
        //     'description' => 'required|string|min:50',
        //     'additionalInformation' => '',
        //     'category' => 'required|string',
        //     'price' => 'required|numeric|max:999999',
        //     'quantity' => 'required|numeric',
        //     'image' => 'required|image'
        // ]);

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

        if($request->is('api/*')){
            return $product;
        }

        return view('products.view', [
            'product' => $product
        ]);
    }

    public function getAllPaginatedProducts(SearchProduct $request, $category = null){
        $product = new Product();
        $user = Auth::user();
        
        $data["sortPrice"] = $request["sort_price"];

        if($category){
            $data["category"] = $category;
            if($user->role == Role::seller){
                abort(403);
            }
        }
        else{
            $data["category"] = null;
        }

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

    public function getAllProducts(ProductRequest $request){
        $product = new Product();
        
        $data["offset"] = $request["page"] - 1;
        if($request["sort_price"]){
            $data["sortPrice"] = $request["sort_price"];
        }
        else{
            $data["sortPrice"] = "ASC";
        }

        if($request["category"]){
            $data["category"] = $request["category"];
        }
        else{
            $data["category"] = null;
        }

        $products = $product->getAll($data);

        return $products;
    }
}
