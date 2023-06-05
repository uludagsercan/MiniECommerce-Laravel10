<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RolesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $roles = Role::all();
        return view("admin-components.role.index", ["roles" => $roles]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view("admin-components.role.create");
    }

    public function search(Request $request)
    {
        try {
            //code...
            $roles = Role::query()->where("name", 'like', '%' . $request['search'] . '%')->get();
            return view("admin-components.role.index", ["roles" => $roles]);
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
            'name' => ['required', 'max:20', 'min:3'],
        ]);

        try {
            //code...
            $role = new Role();
            $data = $request->all();
            $role->fill($data);
            $result = $role->save();
            if ($result)
                return redirect()->back()->with("successMessage", "Ekleme İşlemi Başarılıdır");
            return redirect()->back()->with("errorMessage", "Ekleme İşlemi Başarısızdır ");
        } catch (\Throwable $th) {
            return redirect()->back()->with("errorMessage", "Ekleme İşlemi Sırasında Bir Hata Oluştu: " . $th->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function show(Role $role)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        try {
            //code...
            $role = Role::find($id);
            return view("admin-components.role.update", ["role" => $role]);
        } catch (\Throwable $th) {
            //throw $th;
            return redirect()->back()->with("errorMessage", $th->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Role $role)
    {
        //
        $request->validate([
            'name' => ['required', 'max:20', 'min:3'],
        ]);

        try {
            //code...
            $data = $request->all();
            $role->fill($data);
            $result = DB::table("roles")->where("id", $request->id)->update([
                "name" => $role["name"]
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
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        try {
            //code...
            $role = Role::find($id);
            $result = $role->delete();
            if ($result > 0)
                return redirect()->back()->with("successMessage", "Silme işlemi başarılıdır");
            return redirect()->back()->with("successMessage", "Silme işlemi başarısızdır");
        } catch (\Throwable $th) {
            //throw $th;
            return redirect()->back()->with("errorMessage", $th->getMessage());
        }
    }
}
