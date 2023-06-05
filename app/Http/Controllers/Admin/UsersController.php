<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $users = User::all();
        return view("admin-components.user.index", ["users" => $users]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $roles = Role::all();
        return view("admin-components.user.create", ["roles" => $roles]);
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
            'email' => ['required', 'max:255', 'email'],
            'password' => ['required', 'min:8', 'max:255'],
            'role_id' => ['required']
        ]);

        try {
            //code...
            $password = $request["password"];
            $hash_password = bcrypt($password);
            $user = new User();
            $data = $request->all();
            $user->fill($data);
            $user["password"] = $hash_password;
            $result = $user->save();
            if ($result)
                return redirect()->back()->with("successMessage", "Ekleme İşlemi Başarılıdır");
            return redirect()->back()->with("errorMessage", "Ekleme İşlemi Başarısızdır ");
        } catch (\Throwable $th) {
            //throw $th;
            return redirect()->back()->with("errorMessage", "Ekleme İşlemi Sırasında Bir Hata Oluştu: " . $th->getMessage());
        }

        return redirect()->back()->with("successMessage", "Ekleme İşlemi Başarılıdır");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        try {
            //code...
            $user = User::with("role")->find($id);
            return view("admin-components.user.profile", ["user" => $user]);
        } catch (\Throwable $th) {
            //throw $th;
            return redirect()->back()->with("errorMessage", $th->getMessage());
        }
    }

    public function changePasswordView()
    {
        return view("admin-components.user.change-password");
    }

    public function changePassword(Request $request)
    {
        $request->validate([
            'password' => ['required', 'min:8', 'max:255'],
        ]);
        try {
            //code...

            $user = User::find(Auth::getUser()->id);
            $hashed_password = bcrypt($request["password"]);
            $result = DB::table("users")->where("id", $user->id)->update([
                "password" => $hashed_password
            ]);
            if ($result > 0)
                return redirect()->back()->with("successMessage", "Şifre Güncelleme işlemi başarılıdır");
            return redirect()->back()->with("errorMessage", "Şifre Güncelleme işlemi başarısızdır");
        } catch (\Throwable $th) {
            //throw $th;
            return redirect()->back()->with("errorMessage", "Şifre Güncelleme İşlemi Sırasında Bir Hata Oluştu: " . $th->getMessage());
        }


        //burası kodlanıcak.

    }

    public function search(Request $request)
    {

        try {
            //code...
            $users = User::query()->where("name", 'like', '%' . $request['search'] . '%')->orWhere("email", 'like', '%' . $request['search'] . '%')->orWhere("id", 'like', '%' . $request['search'] . '%')->get();

            return view("admin-components.user.index", ["users" => $users]);
        } catch (\Throwable $th) {
            //throw $th;
            return redirect()->back()->with("errorMessage", $th->getMessage());
        }
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        try {
            //code...
            $user = User::with("role")->find($id);
            $roles = Role::all();
            return view("admin-components.user.update", ["user" => $user, "roles" => $roles]);
        } catch (\Throwable $th) {
            //throw $th;
            return redirect()->back()->with("errorMessage", $th->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        //
        $request->validate([
            'name' => ['required', 'max:255', 'min:3'],
            'email' => ['required', 'max:255', 'email'],
        ]);

        try {
            //code...
            $data = $request->all();
            $user->fill($data);

            $result =  DB::table("users")->where("id", $user->id)->update([
                "name" => $user["name"],

                "email" => $user["email"],
                "role_id" => $user["role_id"]
            ]);
            if ($result > 0)
                return redirect()->back()->with("successMessage", "Güncelleme işlemi başarılıdır");
            return redirect()->back()->with("errorMessage", "Güncellenen satır sayısı" . $result);
        } catch (\Throwable $th) {
            //throw $th;
            return redirect()->back()->with("errorMessage", "Güncelleme işlemi sırasında bir hata oluşmuştur: " . $th->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        try {
            //code...
            $user = User::find($id);
            $result = $user->delete();
            if ($result > 0)
                return redirect()->back()->with("successMessage", "Silme işlemi başarılıdır");
            return redirect()->back()->with("successMessage", "Silme işlemi başarısızdır");
        } catch (\Throwable $th) {
            return redirect()->back()->with("errorMessage", $th->getMessage());
        }
    }
}
