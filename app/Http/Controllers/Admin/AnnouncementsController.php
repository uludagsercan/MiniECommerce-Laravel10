<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Announcement;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AnnouncementsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $announcements = Announcement::with("product")->get();
        return view("admin-components.announcement.index", ["announcements" => $announcements]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $products = Product::all();
        return view("admin-components.announcement.create", ["products" => $products]);
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
            'product_id' => ['required'],
            'announcement_title' => ['required', 'min:3', 'max:255'],
            'announcement_description' => ['required', 'min:3'],
        ]);
        $announcement = new Announcement();
        $data = $request->only($announcement->getFillable());
        $announcement->fill($data);
        $result = $announcement->save();
        if ($result == true)
            return redirect()->back()->with("successMessage", "Ekleme işlemi başarılıdır");
        else
            return redirect()->back()->with("errorMessage", "Ekleme işlemi başarısızdır");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Announcement  $announcement
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $announcement = Announcement::with("product")->find($id);
        return view("admin-components.announcement.view", ['announcement' => $announcement]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Announcement  $announcement
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $products = Product::all();
        $announcement = Announcement::with("product")->find($id);
        return view("admin-components.announcement.update", ["announcement" => $announcement, "products" => $products]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Announcement  $announcement
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Announcement $announcement)
    {
        //
        $request->validate([
            'product_id' => ['required'],
            'announcement_title' => ['required', 'min:3', 'max:255'],
            'announcement_description' => ['required', 'min:3'],
        ]);
        $data = $request->all();
        $announcement->fill($data);
        try {
            //code...
            $result =  DB::table("announcements")->where("id", $announcement->id)->update([
                "product_id" => $announcement->product_id,
                "announcement_title" => $announcement->announcement_title,
                "announcement_description" => $announcement->announcement_description
            ]);
            if ($result > 0)
                return redirect()->back()->with("successMessage", "Güncelleme işlemi başarılıdır");
            return redirect()->back()->with("errorMessage", "Güncelleme işlemi başarısızdır. Lütfen verilerinizi değiştirerek güncelleme işlemi yapınız");
        } catch (\Throwable $th) {
            return redirect()->back()->with("errorMessage", "Güncelleme işlemi sırasında bir hata oluştu" . $th->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Announcement  $announcement
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $announcement = Announcement::find($id);
        try {
            $announcement->delete();
        } catch (\Throwable $th) {
            return redirect()->back()->with("errorMessage", "Silme işlemi başarısız");
        }
        return redirect()->back()->with("successMessage", "Silme işlemi başarılıdır");


        // return redirect("admin/announcement");

    }
}
