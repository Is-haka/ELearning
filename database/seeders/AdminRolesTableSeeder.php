<?php

namespace Database\Seeders;

use App\Models\AdminRole;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminRolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        AdminRole::updateOrCreate(['name' => 'Administrator','slug' =>'Administrator']);
        AdminRole::updateOrCreate(['name' => 'instructor','slug' =>'instructor']);
        AdminRole::updateOrCreate(['name' => 'user','slug' =>'user']);
    }
}
