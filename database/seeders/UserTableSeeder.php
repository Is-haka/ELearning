<?php

namespace Database\Seeders;

use App\Models\AdminRole;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         //
         $adminRole = AdminRole::where('name', 'Administrator')->first();
         $instructorRole = AdminRole::where('name', 'instructor')->first();
         $userRole = AdminRole::where('name', 'user')->first();

         if (!$adminRole || !$userRole || !$instructorRole) {
             $this->command->info('Please ensure that roles are seeded before seeding users.');
             return;
         }

         User::updateOrCreate(
             ['email' => 'admin@gmail.com'], // Unique email
             [
                 'name' => 'admin',
                 'username' => 'admin',
                 'profile' =>'',
                 'role_id' => $adminRole->id,
                 'password' => Hash::make('admin'),
             ]
         );
         User::updateOrCreate(
             ['email' => 'user@gmail.com'], // Unique email
             [
                 'name' => 'user',
                 'username' => 'user',
                 'profile' =>'',
                 'role_id' => $userRole->id,
                 'password' => Hash::make('user'),
             ]
         );
         User::updateOrCreate(
             ['email' => 'instructor@gmail.com'], // Unique email
             [
                 'name' => 'instructor',
                 'username' => 'instructor',
                 'profile' =>'',
                 'role_id' => $instructorRole->id,
                 'password' => Hash::make('instructor'),
             ]
         );

         $this->command->info('Users table seeded with admin, user, and instructor roles.');

    }
}
