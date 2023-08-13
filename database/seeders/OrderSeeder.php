<?php

namespace Database\Seeders;

use App\Models\Order;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
      $data = [];

      $title = ['Low', 'Medium', 'High'];

      for($i = 0; $i <= 2; ++$i){
        $data[] = [
            'title' => $title[$i],
        ];
      }

      DB::table('orders')->insert($data);
    }
}
