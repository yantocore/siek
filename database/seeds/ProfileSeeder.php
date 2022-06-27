<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProfileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $profiles = [
            ['user_id' => '1', 'phone' => '+6282123456789', 'position' => 'Staf Bidang Humas', 'gender' => 'Perempuan'],
            ['user_id' => '2', 'phone' => '+6282123456789', 'position' => 'Direktur Utama', 'gender' => 'Laki-Laki'],
            ['user_id' => '3', 'phone' => '+6282123456789', 'position' => 'Staf HRD', 'gender' => 'Perempuan'],
            ['user_id' => '4', 'phone' => '+6282123456789', 'position' => 'Web Developer', 'gender' => 'Laki-Laki'],
        ];

        DB::table('profiles')->insert($profiles);
    }
}
