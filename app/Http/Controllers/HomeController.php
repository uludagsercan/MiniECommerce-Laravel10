<?php

namespace App\Http\Controllers;

use App\Models\Announcement;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $products = Product::with("category")->get();
        $announcements = Announcement::with("product")->get();
        return view('ui.index',['products'=>$products,'announcements'=>$announcements]);
    }

    public function detail($id){
        if(!Auth::check())
            return redirect("login")->with("errorMessage","Detay sayfasını görmek için üye girişi yapmalısınız");
        $product = Product::with("category")->find($id);
        return view("ui.detail",['product'=>$product]);
    }
}
