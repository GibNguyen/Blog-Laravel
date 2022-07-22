<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class CreateUserTable extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('users')->insert([
            'name' => 'Admin ',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('123456'),
            'role_id' =>1,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('users')->insert([
            'name' => 'User',
            'email' => 'giabao04031993@gmail.com',
            'password' => Hash::make('123456'),
            'role_id' =>2,
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
