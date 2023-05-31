<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductsContoller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $products = DB::table("products")->join("categories","products.category_id","=","categories.id")
            ->select("categories.id as category_id","categories.name as category_name","categories.description as category_description","products.*")
            ->get();


          return view("admin-components.product.index",
        ["products"=>$products]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $categories = Category::all();
        return view("admin-components.product.create",["categories"=>$categories]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $product = new Product();
        $data= $request->only($product->getFillable());
        $product->fill($data)->save();
        return redirect("admin/product");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $product =DB::table("products")->where("id","=",$id)->first();
        $categories = Category::all();
        return view("admin-components.product.update",["product"=>$product,"categories"=>$categories]);


    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        //
        $data= $request->all();
        $product->fill($data);

        DB::table("products")->where("id",$request["id"])
            ->update(["name"=>$product["name"],
                "description"=>$product["description"],
                "price"=>$request->float("price"),
                "stock"=>$request->integer("stock"),
                "picture"=>$product["picture"],
                "category_id"=>$request->integer("category_id")
            ]);
        return redirect("admin/product");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        //
    }
}
