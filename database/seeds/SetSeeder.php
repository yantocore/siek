<?php

use App\Set;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SetSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $sets = [
            ['name' => 'Kurang', 'left_down' => '0', 'left_up' => '0', 'right_up' => '60', 'right_down' => '70'],
            ['name' => 'Cukup', 'left_down' => '50', 'left_up' => '60', 'right_up' => '80', 'right_down' => '90'],
            ['name' => 'Baik', 'left_down' => '70', 'left_up' => '80', 'right_up' => '100', 'right_down' => '100'],
        ];

        DB::table('sets')->insert($sets);
    }
}
