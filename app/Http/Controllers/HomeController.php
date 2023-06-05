<?php

namespace App\Http\Controllers;

use App\Models\Announcement;
use App\Models\Product;
use ErrorException;
use Exception;
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
        return view('ui.index', ['products' => $products, 'announcements' => $announcements]);
    }

    public function detail($id)
    {
        try {
            //code...
            if (!Auth::check())
                return redirect("login")->with("errorMessage", "Detay sayfasını görmek için üye girişi yapmalısınız");

            $product = Product::with("category")->find($id);
            if (!$product)
                return redirect("/");
            return view("ui.detail", ['product' => $product]);
        } catch (\Throwable $th) {
            //throw $th;
            return redirect()->back()->with("errorMessage", $th->getMessage());
        }
    }
}
