<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CreateUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $roles=[[
            'id'=>1,
            'name'=>"admin"
        ]];

        $users = [[
            'role_id'=>1,
            'name' => "sercan",
            'email' => "sercan@hotmail.com",
            'password' => bcrypt("12345")

        ]];

        $s = new User();
        $r =new Role();
        foreach ($roles as $role) {
            # code...
            Role::create($role);
        }

        foreach ($users as $user) {
            User::create($user);
        }
    }
}
