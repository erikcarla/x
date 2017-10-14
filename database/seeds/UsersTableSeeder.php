<?php

use Illuminate\Database\Seeder;
use App\Models\User;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('users')->truncate();

        factory(User::class)->create([
            'name' => "admin",
            'email' => 'admin@gmail.com',
        ]);
        factory(User::class, 2)->create();
    }

}
