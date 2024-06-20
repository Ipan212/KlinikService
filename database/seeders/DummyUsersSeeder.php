<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DummyUsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $userData = [
            [
                'name'=> 'Akang Pendaftaran',
                'email'=> 'pendaftaran@gmail.com',
                'role'=> 'pendaftaran',
                'password'=> bcrypt('123456')
            ],
            [
                'name'=> 'Akang Rekme',
                'email'=> 'rekme@gmail.com',
                'role'=> 'rekme',
                'password'=> bcrypt('123456')
            ],
            [
                'name'=> 'Akang Transaksi',
                'email'=> 'transaksi@gmail.com',
                'role'=> 'transaksi',
                'password'=> bcrypt('123456')
            ]
        ];
        foreach($userData as $key => $val){
            User::create($val);
        }
    }
}
