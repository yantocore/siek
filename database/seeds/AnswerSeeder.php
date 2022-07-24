<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AnswerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $answers = [
            ['question_id' => '1', 'name' => 'Sangat Baik', 'value' => '4'],
            ['question_id' => '1', 'name' => 'Baik', 'value' => '3'],
            ['question_id' => '1', 'name' => 'Cukup', 'value' => '2'],
            ['question_id' => '1', 'name' => 'Kurang', 'value' => '1'],
            ['question_id' => '2', 'name' => 'Sangat Baik', 'value' => '4'],
            ['question_id' => '2', 'name' => 'Baik', 'value' => '3'],
            ['question_id' => '2', 'name' => 'Cukup', 'value' => '2'],
            ['question_id' => '2', 'name' => 'Kurang', 'value' => '1'],
            ['question_id' => '3', 'name' => 'Sangat Baik', 'value' => '4'],
            ['question_id' => '3', 'name' => 'Baik', 'value' => '3'],
            ['question_id' => '3', 'name' => 'Cukup', 'value' => '2'],
            ['question_id' => '3', 'name' => 'Kurang', 'value' => '1'],
            ['question_id' => '4', 'name' => 'Sangat Baik', 'value' => '4'],
            ['question_id' => '4', 'name' => 'Baik', 'value' => '3'],
            ['question_id' => '4', 'name' => 'Cukup', 'value' => '2'],
            ['question_id' => '4', 'name' => 'Kurang', 'value' => '1'],
            ['question_id' => '5', 'name' => 'Sangat Baik', 'value' => '4'],
            ['question_id' => '5', 'name' => 'Baik', 'value' => '3'],
            ['question_id' => '5', 'name' => 'Cukup', 'value' => '2'],
            ['question_id' => '5', 'name' => 'Kurang', 'value' => '1'],
            ['question_id' => '6', 'name' => 'Sangat Baik', 'value' => '4'],
            ['question_id' => '6', 'name' => 'Baik', 'value' => '3'],
            ['question_id' => '6', 'name' => 'Cukup', 'value' => '2'],
            ['question_id' => '6', 'name' => 'Kurang', 'value' => '1'],
            ['question_id' => '7', 'name' => 'Sangat Baik', 'value' => '4'],
            ['question_id' => '7', 'name' => 'Baik', 'value' => '3'],
            ['question_id' => '7', 'name' => 'Cukup', 'value' => '2'],
            ['question_id' => '7', 'name' => 'Kurang', 'value' => '1'],
            ['question_id' => '8', 'name' => 'Sangat Baik', 'value' => '4'],
            ['question_id' => '8', 'name' => 'Baik', 'value' => '3'],
            ['question_id' => '8', 'name' => 'Cukup', 'value' => '2'],
            ['question_id' => '8', 'name' => 'Kurang', 'value' => '1'],
            ['question_id' => '9', 'name' => 'Sangat Baik', 'value' => '4'],
            ['question_id' => '9', 'name' => 'Baik', 'value' => '3'],
            ['question_id' => '9', 'name' => 'Cukup', 'value' => '2'],
            ['question_id' => '9', 'name' => 'Kurang', 'value' => '1'],
            ['question_id' => '10', 'name' => 'Sangat Baik', 'value' => '4'],
            ['question_id' => '10', 'name' => 'Baik', 'value' => '3'],
            ['question_id' => '10', 'name' => 'Cukup', 'value' => '2'],
            ['question_id' => '10', 'name' => 'Kurang', 'value' => '1'],
            ['question_id' => '11', 'name' => 'Sangat Baik', 'value' => '4'],
            ['question_id' => '11', 'name' => 'Baik', 'value' => '3'],
            ['question_id' => '11', 'name' => 'Cukup', 'value' => '2'],
            ['question_id' => '11', 'name' => 'Kurang', 'value' => '1'],
            ['question_id' => '12', 'name' => 'Sangat Baik', 'value' => '4'],
            ['question_id' => '12', 'name' => 'Baik', 'value' => '3'],
            ['question_id' => '12', 'name' => 'Cukup', 'value' => '2'],
            ['question_id' => '12', 'name' => 'Kurang', 'value' => '1'],
            ['question_id' => '13', 'name' => 'Sangat Baik', 'value' => '4'],
            ['question_id' => '13', 'name' => 'Baik', 'value' => '3'],
            ['question_id' => '13', 'name' => 'Cukup', 'value' => '2'],
            ['question_id' => '13', 'name' => 'Kurang', 'value' => '1'],
            ['question_id' => '14', 'name' => 'Sangat Baik', 'value' => '4'],
            ['question_id' => '14', 'name' => 'Baik', 'value' => '3'],
            ['question_id' => '14', 'name' => 'Cukup', 'value' => '2'],
            ['question_id' => '14', 'name' => 'Kurang', 'value' => '1'],
        ];

        DB::table('answers')->insert($answers);

    }
}
