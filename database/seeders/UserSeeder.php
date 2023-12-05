<?php
 
namespace Database\Seeders;
 
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
 
class UserSeeder extends Seeder
{
    /**
     * Run the database seeders.
     */
    public function run(): void
    {
        $usersData = [
            [
                'name' => 'Diome',
                'short_name' => 'Dion', 
                'email' => 'admin@gmail.com',
                'role_id' => 1,
                'address' => 1, 
                'password' => Hash::make('1'),
            ],
            [
                'name' => 'Sponsor',
                'short_name' => 'mcdo', 
                'email' => 'sponsor@sponsor.com',
                'role_id' => 2,
                'address' => 1, 
                'password' => Hash::make('1'),
            ],
            [
                'name' => 'Volunteer',
                'short_name' => 'volunteer', 
                'email' => 'volunteer@volunteer.com',
                'role_id' => 3,
                'address' => 1, 
                'password' => Hash::make('1'),
            ] 
        ];

        DB::table('users')->insert($usersData);
    }
}