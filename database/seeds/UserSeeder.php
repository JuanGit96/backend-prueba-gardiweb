<?php

use App\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            "name" => "Juan Admin",
            "email" => "admin@admin.com",
            "password" => bcrypt("12345"),
            "role_id" => 1,
        ]);
    }
}
