<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [];



        $cPassword = '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi';
        $data[] = [
          'name' => 'Admin',
          'email' => 'admin@admin.com',
          'email_verified_at' => now(),
          'password' => $cPassword,
          'admin' => 1,
          'status' => 1,
          'remember_token' => Str::random(10),
        ];

        for ($i = 2; $i <= 10; $i++){
          $data[] = [
            'name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => $cPassword,
            'admin' => 0,
            'status' => 0,
            'remember_token' => Str::random(10),
          ];
        }

      DB::table('users')->insert($data);
    }
}
