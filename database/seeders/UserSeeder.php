<?php

namespace Database\Seeders;

use App\Models\Role;
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
        $user=User::create([
            'email' => 'admin@mobillium.com',
            'password' => 'mobillium',
            'name' => 'Admin'
        ]);
        $user->roles()->save(Role::where('name','admin')->first());

        $user=User::create([
            'email' => 'writer1@mobillium.com',
            'password' => 'mobillium',
            'name' => 'Writer'
        ]);
        $user->roles()->save(Role::where('name','writer')->first());
    }
}
