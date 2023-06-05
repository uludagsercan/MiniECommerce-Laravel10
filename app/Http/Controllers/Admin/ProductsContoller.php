<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class ProductsContoller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // //
        // $products = DB::table("products")->join("categories", "products.category_id", "=", "categories.id")
        //     ->select("categories.id as category_id", "categories.name as category_name", "categories.description as category_description", "products.*")
        //     ->get();
        $products = Product::with("category")->get();

        return view(
            "admin-components.product.index",
            ["products" => $products]
        );
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
        return view("admin-components.product.create", ["categories" => $categories]);
    }

    public function search(Request $request)
    {
        try {
            //code...
            $products = Product::with(
                "category"
            )->where("name", 'like', '%' . $request['search'] . '%')
                ->orWhere("description", 'like', '%' . $request['search'] . '%')
                ->orWhere("price", 'like', '%' . $request['search'] . '%')
                ->orWhere("stock", 'like', '%' . $request['search'] . '%')
                ->orWhereRelation("category", "name", 'like', '%' . $request['search'] . '%')
                ->get();
            return view("admin-components.product.index", ["products" => $products]);
        } catch (\Throwable $th) {
            //throw $th;
            return redirect()->back()->with("errorMessage", $th->getMessage());
        }
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
        $request->validate([
            'name' => ['required', 'max:255', 'min:3'],
            'description' => ['required'],
            'stock' => ['required'],
            'price' => ['required'],
            'category_id' => ['required'],
        ]);
        $product = new Product();
        $data = $request->only($product->getFillable());
        $product->fill($data);
        try {
            //code...
            if ($request->hasFile('picture')) {
                $destination_path = 'public/images/products';
                $image = $request->file('picture');
                $extension = $image->getClientOriginalExtension();
                $full_path = date("dym") . time() . "." . $extension;
                $path = $request->file('picture')->storeAs($destination_path, $full_path);
                $product["picture"] = $full_path;
                $product["user_id"]=Auth::getUser()->id;
                // $product->picture = $request->file('picture')->store('images');
            }
            $result =  $product->save();
            if ($result)
                return redirect()->back()->with("successMessage", "Ekleme işlemi başarılıdır");
            return redirect()->back()->with("errorMessage", "Ekleme işlemi başarısızdır.");
        } catch (\Throwable $th) {
            return redirect()->back()->with("successMessage", "Ekleme işlemi sırasında bir hata oluştu: " . $th->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        try {
            //code...
            $product = Product::with("category")->find($id);
            return view("admin-components.product.view", ["product" => $product]);
        } catch (\Throwable $th) {
            //throw $th;
            return redirect()->back()->with("errorMessage", $th->getMessage());
        }
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
        try {
            //code...
            $product = DB::table("products")->where("id", "=", $id)->first();
            $categories = Category::all();
            return view("admin-components.product.update", ["product" => $product, "categories" => $categories]);
        } catch (\Throwable $th) {
            //throw $th;
            return redirect()->back()->with("errorMessage", $th->getMessage());
        }
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

        $request->validate([
            'name' => ['required', 'max:255', 'min:3'],
            'description' => ['required'],
            'stock' => ['required'],
            'price' => ['required'],
            'category_id' => ['required'],
        ]);
        //
        try {
            //code...
            $data = $request->all();
            $product->fill($data);
            $previous_product = Product::find($product->id);
            if ($request->hasFile("picture")) {
                if (File::exists('storage/images/products/' . $previous_product->picture)) {
                    File::delete('storage/images/products/' . $previous_product->picture);
                }
                $destination_path = 'public/images/products';
                $image = $request->file('picture');
                $extension = $image->getClientOriginalExtension();
                $full_path = date("dym") . time() . "." . $extension;
                $path = $request->file('picture')->storeAs($destination_path, $full_path);
                $product["picture"] = $full_path;
            } else {
                $product["picture"] = $previous_product->picture;
            }
            $result = DB::table("products")->where("id", $request["id"])
                ->update([
                    "name" => $product["name"],
                    "description" => $product["description"],
                    "price" => $request->float("price"),
                    "stock" => $request->integer("stock"),
                    "picture" => $product["picture"],
                    "category_id" => $request->integer("category_id"),
                    "user_id"=>Auth::getUser()->id
                ]);
            if ($result > 0)
                return redirect()->back()->with("successMessage", "Güncelleme işlemi başarılıdır");
            return redirect()->back()->with("errorMessage", "Güncellenen satır sayısı" . $result);
        } catch (\Throwable $th) {
            //throw $th;
            return redirect()->back()->with("errorMessage", "Güncelleme işlemi sırasında bir hata oluşmuştur: " . $th->getMessage());
        }

        // if ($request->hasFile('picture') && $previous_product->picture !=$request->picture) {
        //     if (File::exists('storage/images/products/'.$previous_product->picture)) {
        //         File::delete('storage/images/products/'.$previous_product->picture);
        //    }
        //     $destination_path = 'public/images/products';
        //     $image = $request->file('picture');
        //     $extension = $image->getClientOriginalExtension();
        //     $full_path = date("dym") . time() . "." . $extension;
        //     $path = $request->file('picture')->storeAs($destination_path, $full_path);
        //     $product["picture"] = $full_path;
        //     // $product->picture = $request->file('picture')->store('images');
        // }



    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        try {
            //code...
            $product = Product::find($id);
            if (File::exists('storage/images/products/' . $product->picture)) {
                File::delete('storage/images/products/' . $product->picture);
            }
    
           $result =  $product->delete();
           if($result>0){
            return redirect()->back()->with("successMessage","Silme işlemi başarılıdır");
           }
           return redirect()->back()->with("errorMessage","Silme işlemi başarısızdır");

        } catch (\Throwable $th) {
            //throw $th;
            return redirect()->back()->with("errorMessage", $th->getMessage());
            
        }

        return redirect('admin/product');
    }
}
