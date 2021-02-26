<?php

namespace Database\Seeders;

use App\Models\Article;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(PointSeeder::class);
        $this->call(RoleSeeder::class);
        \App\Models\User::factory(10)->create()->each(function ($user) {
            $user->roles()->attach([4]);
            if (rand(0, 10) > 3) {
                $user->roles()->attach([3]);
                rand(0, 10) > 4 ? $user->roles()->attach([2]) : null;
                $user->articles()->saveMany(Article::factory()->count(rand(1, 4))->make());
            }
        });
    }
}
