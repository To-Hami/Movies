<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class users_table_seeder extends Seeder
{

    public function run()
    {
        $user = User::create([
            'name' => 'super_admin',
            'email' => 'super_admin@app.com',
            'password' => bcrypt('password'),
            'type' => 'super_admin',
        ]);

        $user->attachRole('super_admin');
    }
}
