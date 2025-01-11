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
                'name' => 'Imron Rosyadi',
                'username' => 'imronrosyadi',
                'role' => 'kepala',
                'password' => bcrypt('12345678'),
            ],
            [
                'name' => 'Bahrowi',
                'username' => 'bahrowi',
                'role' => 'satpam',
                'password' => bcrypt('12345678'),
            ],
            [
                'name' => 'Taufikurrahman',
                'username' => 'taufikurrahman',
                'role' => 'satpam',
                'password' => bcrypt('12345678'),
            ],
            [
                'name' => 'Riki Efendi',
                'username' => 'rikiefendi',
                'role' => 'satpam',
                'password' => bcrypt('12345678'),
            ],
            [
                'name' => 'Rohmatulloh',
                'username' => 'rohmatulloh',
                'role' => 'satpam',
                'password' => bcrypt('12345678'),
            ],
            [
                'name' => 'Dicky Lendi',
                'username' => 'dickylendi',
                'role' => 'satpam',
                'password' => bcrypt('12345678'),
            ],
            [
                'name' => 'Sulton Hadi',
                'username' => 'sultonhadi',
                'role' => 'satpam',
                'password' => bcrypt('12345678'),
            ],
            [
                'name' => 'Imron Fadillah',
                'username' => 'imronfadillah',
                'role' => 'satpam',
                'password' => bcrypt('12345678'),
            ],
            [
                'name' => 'Diki Khosy',
                'username' => 'dikikhosy',
                'role' => 'satpam',
                'password' => bcrypt('12345678'),
            ],
            [
                'name' => 'Helmi Wahyu',
                'username' => 'helmiwahyu',
                'role' => 'satpam',
                'password' => bcrypt('12345678'),
            ],
        ];
        foreach ($userData as $key => $val){
            User::create($val);
        }
    }
}
