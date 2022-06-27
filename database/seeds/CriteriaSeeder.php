<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CriteriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $criterias = [
            ['name' => 'Softskill'],
            ['name' => 'Hardskill'],
        ];

        DB::table('criterias')->insert($criterias);
    }
}
