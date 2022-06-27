<?php

use App\Rule;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RuleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $rules = [
            ['name' => 'R1', 'first_set_id' => '1', 'second_set_id' => '1', 'performance' => '60'],
            ['name' => 'R2', 'first_set_id' => '1', 'second_set_id' => '2', 'performance' => '80'],
            ['name' => 'R3', 'first_set_id' => '1', 'second_set_id' => '3', 'performance' => '80'],
            ['name' => 'R4', 'first_set_id' => '2', 'second_set_id' => '1', 'performance' => '60'],
            ['name' => 'R5', 'first_set_id' => '2', 'second_set_id' => '2', 'performance' => '80'],
            ['name' => 'R6', 'first_set_id' => '2', 'second_set_id' => '3', 'performance' => '100'],
            ['name' => 'R7', 'first_set_id' => '3', 'second_set_id' => '1', 'performance' => '80'],
            ['name' => 'R8', 'first_set_id' => '3', 'second_set_id' => '2', 'performance' => '100'],
            ['name' => 'R9', 'first_set_id' => '3', 'second_set_id' => '3', 'performance' => '100'],
        ];
        DB::table('rules')->insert($rules);
    }
}
