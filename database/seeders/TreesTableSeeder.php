<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Models\Tree; 

class TreesTableSeeder extends Seeder
{
    public function run()
    {
        $currentTimestamp = Carbon::now();

        $trees = [
            ['name' => 'Narra', 'tree_value' => rand(1, 100), 'created_at' => $currentTimestamp, 'updated_at' => $currentTimestamp],
            ['name' => 'Mangrove', 'tree_value' => rand(1, 100), 'created_at' => $currentTimestamp, 'updated_at' => $currentTimestamp],
            ['name' => 'Balete', 'tree_value' => rand(1, 100), 'created_at' => $currentTimestamp, 'updated_at' => $currentTimestamp],
            ['name' => 'Acacia', 'tree_value' => rand(1, 100), 'created_at' => $currentTimestamp, 'updated_at' => $currentTimestamp],
            ['name' => 'Banaba', 'tree_value' => rand(1, 100), 'created_at' => $currentTimestamp, 'updated_at' => $currentTimestamp],
            ['name' => 'Dama de Noche', 'tree_value' => rand(1, 100), 'created_at' => $currentTimestamp, 'updated_at' => $currentTimestamp],
            ['name' => 'Yakal', 'tree_value' => rand(1, 100), 'created_at' => $currentTimestamp, 'updated_at' => $currentTimestamp],
            ['name' => 'Nipa Palm', 'tree_value' => rand(1, 100), 'created_at' => $currentTimestamp, 'updated_at' => $currentTimestamp],
            ['name' => 'Lanzones', 'tree_value' => rand(1, 100), 'created_at' => $currentTimestamp, 'updated_at' => $currentTimestamp],
            ['name' => 'Molave', 'tree_value' => rand(1, 100), 'created_at' => $currentTimestamp, 'updated_at' => $currentTimestamp],
            ['name' => 'Bamboo', 'tree_value' => rand(1, 100), 'created_at' => $currentTimestamp, 'updated_at' => $currentTimestamp],
            ['name' => 'Mango', 'tree_value' => rand(1, 100), 'created_at' => $currentTimestamp, 'updated_at' => $currentTimestamp],
            ['name' => 'Guava', 'tree_value' => rand(1, 100), 'created_at' => $currentTimestamp, 'updated_at' => $currentTimestamp],
            ['name' => 'Niyog', 'tree_value' => rand(1, 100), 'created_at' => $currentTimestamp, 'updated_at' => $currentTimestamp],
            ['name' => 'Tangisang Bayawak', 'tree_value' => rand(1, 100), 'created_at' => $currentTimestamp, 'updated_at' => $currentTimestamp],
            ['name' => 'Santol', 'tree_value' => rand(1, 100), 'created_at' => $currentTimestamp, 'updated_at' => $currentTimestamp],
            ['name' => 'Balimbing', 'tree_value' => rand(1, 100), 'created_at' => $currentTimestamp, 'updated_at' => $currentTimestamp],
            ['name' => 'Lumbayao', 'tree_value' => rand(1, 100), 'created_at' => $currentTimestamp, 'updated_at' => $currentTimestamp],
            ['name' => 'Almaciga', 'tree_value' => rand(1, 100), 'created_at' => $currentTimestamp, 'updated_at' => $currentTimestamp],
        ];

        DB::table('trees')->insert($trees); 
    }
} 