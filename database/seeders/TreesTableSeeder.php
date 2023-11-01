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
        Tree::factory()
            ->count(20) // Change the count to the desired number of random trees
            ->create();
    }
} 