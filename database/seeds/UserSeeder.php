<?php

use App\User;
use Illuminate\Database\Seeder;

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

        // $ujibug = User::create([
        //     'name' => 'User Test',
        //     'email' => 'test@sieka.id',
        //     'password' => bcrypt('ujisieka')
        // ]);

    }
}
