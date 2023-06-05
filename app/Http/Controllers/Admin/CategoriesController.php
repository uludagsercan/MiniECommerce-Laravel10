<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $categories = Category::all();
        return view('admin-components.category.index', ["categories" => $categories]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view("admin-components.category.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'max:255', 'min:3'],
            'description' => ['required'],
        ]);

        try {
            //code...
            $category = new Category();
            $data = $request->only($category->getFillable());
            $category->fill($data);
            $category["user_id"]=Auth::getUser()->id;
            $result =$category->save();
            if ($result)
                return redirect()->back()->with("successMessage", "Ekleme İşlemi Başarılıdır");
            return redirect()->back()->with("errorMessage", "Ekleme İşlemi Başarısızdır ");
        } catch (\Throwable $th) {
            //throw $th;
            return redirect()->back()->with("errorMessage", "Ekleme İşlemi Sırasında Bir Hata Oluştu: " . $th->getMessage());
        }
    }

    public function search(Request $request)
    {
        try {
            //code...
            $categories = Category::query()
                ->where("name", 'like', '%' . $request['search'] . '%')
                ->orWhere("description", 'like', '%' . $request['search'] . '%')
                ->get();
            return view('admin-components.category.index', ["categories" => $categories]);
        } catch (\Throwable $th) {
            //throw $th;
            return redirect()->back()->with("errorMessage", $th->getMessage());
        }
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        try {
            //code...
            $category = Category::all()->where("id", "=", $id)->first();
            return view("admin-components.category.update", ["category" => $category]);
        } catch (\Throwable $th) {
            //throw $th;
            return redirect()->back()->with("errorMessage", $th->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        //
        $request->validate([
            'name' => ['required', 'max:255', 'min:3'],
            'description' => ['required'],
        ]);
        try {
            //code...
            $data = $request->all();
            $category->fill($data);
            $result = DB::table("categories")->where("id", $category["id"])
                ->update(["name" => $category["name"], "description" => $category["description"],"user_id"=>Auth::getUser()->id]);
            if ($result > 0)
                return redirect()->back()->with("successMessage", "Güncelleme işlemi başarılıdır");
            return redirect()->back()->with("errorMessage", "Güncellenen satır sayısı" . $result);
        } catch (\Throwable $th) {
            return redirect()->back()->with("errorMessage", "Güncelleme işlemi sırasında bir hata oluşmuştur: " . $th->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //

        try {
            $category = Category::find($id);

            $category->delete();
            return redirect()->back()->with("successMessage", "Silme işlemi başarılıdır");
        } catch (\Throwable $th) {
            return redirect()->back()->with("errorMessage", "Silme işlemi başarısız: " . $th->getMessage());
        }
    }
}
