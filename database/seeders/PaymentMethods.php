<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;

class PaymentMethods extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('payment_methods')->insert([
            [
                'title' => 'Gcash',
                'instruction' => 'Send your payment to 0912345678.',
            ],
            [
                'title' => 'Maya',
                'instruction' => 'Send your payment to 0912345678.',
            ],
        ]);
    }
}
