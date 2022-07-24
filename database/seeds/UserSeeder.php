<?php

use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = User::create([
            'name' => 'Admin',
            'email' => 'admin@sieka.id',
            'password' => bcrypt('adminsieka')
        ]);

        $admin->assignRole('admin');

        $director = User::create([
            'name' => 'Pimpinan',
            'email' => 'pimpinan@sieka.id',
            'password' => bcrypt('pimpinansieka')
        ]);

        $director->assignRole('director');

        $user = User::create([
            'name' => 'Pengguna Alumni',
            'email' => 'user@sieka.id',
            'password' => bcrypt('usersieka')
        ]);

        $user->assignRole('user');

        $superadmin = User::create([
            'name' => 'Super Admin',
            'email' => 'super@sieka.id',
            'password' => bcrypt('surootsieka')
            ]);

        $superadmin->assignRole('super admin');

        $surveyusers = [
            ['name' => 'RS Yarsi Pontianak', 'email' => 'yarsiptk@rumahsakit.id', 'password' => bcrypt('tester')],
            ['name' => 'RS Bhayangkara', 'email' => 'bhayangkara@rumahsakit.id', 'password' => bcrypt('tester')],
            ['name' => 'Puskesmas Jungkat', 'email' => 'jungkat@puskesmas.id', 'password' => bcrypt('tester')],
            ['name' => 'Apotek Kencana II', 'email' => 'kencana@apotek.id', 'password' => bcrypt('tester')],
            ['name' => 'Apotek Batara', 'email' => 'batara@apotek.id', 'password' => bcrypt('tester')],
            ['name' => 'Apotek Damai', 'email' => 'damai@apotek.id', 'password' => bcrypt('tester')],
            ['name' => 'Apotek Patent Farma', 'email' => 'patentfarma@apotek.id', 'password' => bcrypt('tester')],
            ['name' => 'Apotek Ambawang Farma', 'email' => 'ambawangfarma@apotek.id', 'password' => bcrypt('tester')],
            ['name' => 'Apotek Pretty', 'email' => 'pretty@apotek.id', 'password' => bcrypt('tester')],
            ['name' => 'UPTD Puskesmas Pontianak Utara', 'email' => 'ptkutara@puskesmas.id', 'password' => bcrypt('tester')],
            ['name' => 'UPTD Puskesmas Kecamatan Pontianak Kota', 'email' => 'ptkkota@puskesmas.id', 'password' => bcrypt('tester')],
            ['name' => 'Apotek Makmur II', 'email' => 'makmur@apotek.id', 'password' => bcrypt('tester')],
            ['name' => 'Apotek Lestari Farma', 'email' => 'lestarifarma@apotek.id', 'password' => bcrypt('tester')],
            ['name' => 'Apotek Jaya', 'email' => 'jaya@apotek.id', 'password' => bcrypt('tester')],
            ['name' => 'Apotek Merdeka Timur', 'email' => 'merdekatimur@apotek.id', 'password' => bcrypt('tester')],
            ['name' => 'Apotek Cemara', 'email' => 'cemara@apotek.id', 'password' => bcrypt('tester')],
            ['name' => 'Apotek Kimia Farma Seruni', 'email' => 'kimiafarmaseruni@apotek.id', 'password' => bcrypt('tester')],
        ];

        DB::table('users')->insert($surveyusers);

        $existdata = User::whereBetween('id', [5,21])->get();
        foreach($existdata as $existuser){
            $existuser->assignRole('user');
        }

    }
}
