<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
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
        return view("admin-components.user.index",["users"=>$users]);
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
        return view("admin-components.user.create",["roles"=>$roles]);
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
            'name' => ['required', 'max:255','min:3'],
            'email' => ['required', 'max:255','email'],
            'password' =>['required', 'min:8','max:255'],
            'role_id'=>['required']
        ]);
        $password = $request["password"];
        $hash_password = bcrypt($password);
        $user = new User();
        $data = $request->all();
        $user->fill($data);
        $user["password"]=$hash_password;
        $user->save();
        return redirect()->back()->with("successMessage","Ekleme İşlemi Başarılıdır");
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
        $user = User::with("role")->find($id);
        return view("admin-components.user.profile",["user"=>$user]);
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
        $user = User::with("role")->find($id);
        $roles = Role::all();
        return view("admin-components.user.update",["user"=>$user,"roles"=>$roles]);
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
            'name' => ['required', 'max:255','min:3'],
            'email' => ['required', 'max:255','email'],
        ]);
        $data = $request->all();
        $user->fill($data);
     
        DB::table("users")->where("id",$user->id)->update([
            "name"=>$user["name"],
       
            "email"=>$user["email"],
            "role_id"=>$user["role_id"]
        ]);
        return redirect("admin/user");
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
        $user = User::find($id);
        $user->delete();
        return redirect("admin/user");

    }
}
