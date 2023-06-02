<?php

namespace Database\Seeders;

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
        
        $users = [[
            'name' => "sercan",
            'email' => "sercan@hotmail.com",
            'password' => bcrypt("12345")

        ]];

        $s = new User();
        
        foreach ($users as $user) {
            User::create($user);
        }
    }
}
