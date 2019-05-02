<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //factory(\App\User::class, 30)->create();
        $user = new App\User;
        $user->email = "benjielenteria@yahoo.com";
        $user->lname = "Lenteria";
        $user->fname = "Benjie";
        $user->gender = "M";
        $user->school = "Mater Dei College";
        $user->school_address = "Tubigon, Bohol";
        $user->designation = "Faculty";
        $user->admin = 1;
        $user->password = bcrypt('password123');
        $user->save();
    }
}
