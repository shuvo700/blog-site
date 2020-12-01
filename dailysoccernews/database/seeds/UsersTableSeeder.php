<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // For Admin Data
        DB::table('users')->insert([
            [
                // For Admin Data
                'name'=>'Admin',
                'role_id'=>'1',
                'username'=>'admin',
                'email'=>'admin@gmail.com',
                'image'=>'default.png',
                'about'=>'About Admin',
                'password'=>bcrypt('rootadmin'),
                ],
            [
                // For Author Data
                'name'=>'Author',
                'role_id'=>'2',
                'user_name'=>'author',
                'email'=>'author@gmail.com',
                'image'=>'default.png',
                'image'=>'default.png',
                'about'=>'About Author',
                'password'=>bcrypt('rootauthor'),
            ]
    ]);
    }
}
