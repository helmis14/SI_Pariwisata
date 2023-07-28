<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Hak_Akses;

class CreateAksesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = [
            [
                'id' => 1,
                'name' => 'Staff Operator',

            ],
            [
                'id' => 2,
                'name' => 'Staff Tiket',
            ],
            [
                'id' => 3,
                'name' => 'Pengunjung',
            ]
        ];

        foreach ($roles as $key => $role) {
            Hak_Akses::create($role);
        }
    }
}