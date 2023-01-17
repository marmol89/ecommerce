<?php

namespace Database\Seeders;

use App\Models\User;
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
        User::factory()->create([
            'name' => 'Carlos Abrisqueta',
            'email' => 'carlos@test.com',
        ]);

        User::factory()->create([
            'name' => 'Jose Manuel Marmol Alofea',
            'email' => 'marmol89@mail.com',
            'password' => bcrypt('123'),
        ]);
    }
}
