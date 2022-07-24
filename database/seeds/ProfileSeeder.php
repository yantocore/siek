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
            ['user_id' => '3', 'phone' => '+6282123456789', 'position' => 'Kepala Apoteker', 'gender' => 'Perempuan'],
            ['user_id' => '4', 'phone' => '+6282123456789', 'position' => 'Web Developer', 'gender' => 'Laki-Laki'],
            ['user_id' => '5', 'phone' => '+6282123456789', 'position' => 'Kepala RS', 'gender' => 'Perempuan'],
            ['user_id' => '6', 'phone' => '+6282123456789', 'position' => 'Kepala RS', 'gender' => 'Perempuan'],
            ['user_id' => '7', 'phone' => '+6282123456789', 'position' => 'Kepala Puskesmas', 'gender' => 'Perempuan'],
            ['user_id' => '8', 'phone' => '+6282123456789', 'position' => 'Kepala Apoteker', 'gender' => 'Perempuan'],
            ['user_id' => '9', 'phone' => '+6282123456789', 'position' => 'Kepala Apoteker', 'gender' => 'Perempuan'],
            ['user_id' => '10', 'phone' => '+6282123456789', 'position' => 'Kepala Apoteker', 'gender' => 'Perempuan'],
            ['user_id' => '11', 'phone' => '+6282123456789', 'position' => 'Kepala Apoteker', 'gender' => 'Perempuan'],
            ['user_id' => '12', 'phone' => '+6282123456789', 'position' => 'Kepala Apoteker', 'gender' => 'Perempuan'],
            ['user_id' => '13', 'phone' => '+6282123456789', 'position' => 'Kepala Apoteker', 'gender' => 'Perempuan'],
            ['user_id' => '14', 'phone' => '+6282123456789', 'position' => 'Kepala Puskesmas', 'gender' => 'Perempuan'],
            ['user_id' => '15', 'phone' => '+6282123456789', 'position' => 'Kepala Puskesmas', 'gender' => 'Perempuan'],
            ['user_id' => '16', 'phone' => '+6282123456789', 'position' => 'Kepala Apoteker', 'gender' => 'Perempuan'],
            ['user_id' => '17', 'phone' => '+6282123456789', 'position' => 'Kepala Apoteker', 'gender' => 'Perempuan'],
            ['user_id' => '18', 'phone' => '+6282123456789', 'position' => 'Kepala Apoteker', 'gender' => 'Perempuan'],
            ['user_id' => '19', 'phone' => '+6282123456789', 'position' => 'Kepala Apoteker', 'gender' => 'Perempuan'],
            ['user_id' => '20', 'phone' => '+6282123456789', 'position' => 'Kepala Apoteker', 'gender' => 'Perempuan'],
            ['user_id' => '21', 'phone' => '+6282123456789', 'position' => 'Kepala Apoteker', 'gender' => 'Perempuan'],
        ];

        DB::table('profiles')->insert($profiles);
    }
}
