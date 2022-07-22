<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\Hash;
use Database\Seeders\CreateRoleTable;
use Database\Seeders\CreateUserTable;
use Database\Seeders\CreateCategoryTable;



class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $this->call([CreateRoleTable::class]);

        $this->call([CreateUserTable::class]);

        $this->call([CreateCategoryTable::class]);

        $this->call([CreatePostTable::class]);


    }
}
