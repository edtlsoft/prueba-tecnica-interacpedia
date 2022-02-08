<?php

namespace Database\Seeders;

use App\Models\User;
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
        User::factory()->create([
            'name'   => 'Administrator',
            'email'      => 'admin@admin.com',
            'password'   => \bcrypt('password')
        ]);
    }
}
