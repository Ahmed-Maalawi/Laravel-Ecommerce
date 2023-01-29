<?php

namespace Database\Seeders;

use App\Models\paymentType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PaymentTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $types = ['cash', 'gift card', 'credit card', 'prepaid card', 'debit cards'];

        foreach ($types as $type) {
            paymentType::create([
                'value' => $type
            ]);
        }
    }
}
