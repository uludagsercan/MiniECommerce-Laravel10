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
        return view("admin-components.announcement.index",["announcements"=>$announcements]);
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
        return view("admin-components.announcement.create",["products"=>$products]);
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
       
        $announcement = new Announcement();
        $data = $request->only($announcement->getFillable());
        $announcement->fill($data);
        $announcement->save();
        return redirect("admin/announcement");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Announcement  $announcement
     * @return \Illuminate\Http\Response
     */
    public function show(Announcement $announcement)
    {
        //

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
        $products=Product::all();
        $announcement = Announcement::with("product")->find($id);
        return view("admin-components.announcement.update",["announcement"=>$announcement,"products"=>$products]);
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
        $data = $request->all();
        $announcement->fill($data);
        echo $announcement;
        DB::table("announcements")->where("id",$announcement->id)->update([
            "product_id"=>$announcement->product_id,
            "announcement_title"=>$announcement->announcement_title,
            "announcement_description"=>$announcement->announcement_description
        ]);
        return redirect("admin/announcement");
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
        $announcement->delete();
        return redirect("admin/announcement");

    }
}
