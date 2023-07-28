<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CreateUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = [
            [
                'name'      => 'Staff Tiket',
                'username'  => 'Staff Tiket',
                'email'     => 'ST@gmail.com',
                'password'  => bcrypt('12345'),
                'hak__akses_id'  => 2
            ],
            [
                'name'      => 'Pengunjung',
                'username'  => 'Pengunjung',
                'email'     => 'png@gmail.com',
                'password'  => bcrypt('12345'),
                'hak__akses_id'  => 3
            ],
            [
                'name'      => 'Staff Operator',
                'username'  => 'Staff Operator',
                'email'     => 'SO@gmail.com',
                'password'  => bcrypt('12345'),
                'hak__akses_id'  => 1
            ]
        ];

        foreach ($user as $key => $value) {
            User::create($value);
        }
    }
}