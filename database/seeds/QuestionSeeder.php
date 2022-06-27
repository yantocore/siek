<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class QuestionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $questions = [
            ['questionnaire_id' => '1', 'criteria_id' => '1', 'name' => 'Etika'],
            ['questionnaire_id' => '1', 'criteria_id' => '2', 'name' => 'Keahlian pada bidang ilmu (kompetensi utama)'],
            ['questionnaire_id' => '1', 'criteria_id' => '2', 'name' => 'Kemampuan berbahasa asing'],
            ['questionnaire_id' => '1', 'criteria_id' => '2', 'name' => 'Penggunaan teknologi informasi'],
            ['questionnaire_id' => '1', 'criteria_id' => '1', 'name' => 'Kemampuan berkomunikasi'],
            ['questionnaire_id' => '1', 'criteria_id' => '1', 'name' => 'Kerjasama tim'],
            ['questionnaire_id' => '1', 'criteria_id' => '1', 'name' => 'Pengembangan diri'],
        ];

        DB::table('questions')->insert($questions);
    }
}
