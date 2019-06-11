<?php

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
        \App\User::create([
            'email' => 'admin@test.loc',
            'password' => \Illuminate\Support\Facades\Hash::make('password'),
            'name' => 'Admin'
        ]);
       // factory(\App\User::class, 15)->create();
    }
}
