<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class QuestionnaireSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $questionnaires = [
            ['user_id' => '1',
            'title' => 'Evaluasi Kinerja Alumni Akfar Yarsi Pontianak',
            'purpose' => 'Kuesioner ini bertujuan untuk mengumpulkan tanggapan pengguna alumni terhadap kinerja alumni AKFAR YARSI Pontianak',
            'period' => '2017',
            'due_date' => Carbon::tomorrow()->format('Y-m-d')],
            ['user_id' => '2',
            'title' => 'Evaluasi Kinerja Alumni Akfar Yarsi Pontianak',
            'purpose' => 'Kuesioner ini bertujuan untuk mengumpulkan tanggapan pengguna alumni terhadap kinerja alumni AKFAR YARSI Pontianak',
            'period' => '2018',
            'due_date' => Carbon::tomorrow()->format('Y-m-d')],
        ];

        DB::table('questionnaires')->insert($questionnaires);

    }
}
