<?php

use Carbon\Carbon;
use App\Questionnaire;
use Illuminate\Database\Seeder;

class QuestionnaireSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Questionnaire::create([
            'user_id' => '1',
            'title' => 'Evaluasi Kinerja Alumni Akfar Yarsi Pontianak',
            'purpose' => 'Kuesioner ini bertujuan untuk mengumpulkan data penilaian pengguna alumni terhadap kinerja alumni AKFAR YARSI Pontianak',
            'period' => '2017',
            'due_date' => Carbon::tomorrow()->format('Y-m-d')
        ]);
    }
}
