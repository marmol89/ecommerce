<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role = Role::create(['name' => 'admin']);
        User::factory()->create([
            'name' => 'Carlos Abrisqueta',
            'email' => 'carlos@test.com',
        ])->assignRole('admin');

        User::factory()->create([
            'name' => 'Jose Manuel Marmol Alofea',
            'email' => 'marmol89@mail.com',
            'password' => bcrypt('123'),
        ])->assignRole('admin');

        User::factory(100)->create();
    }
}
