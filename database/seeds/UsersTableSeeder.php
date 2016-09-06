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
        $user = new App\User();
        $user->email = 'admin@admin.com';
        $user->name = 'admin';
        $user->password = Hash::make('admin');
        $user->api_token = Hash::make('admin');
        $user->save();
    }
}
