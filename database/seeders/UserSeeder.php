<?php

namespace Database\Seeders;

use App\Models\Address;
use App\Models\User;
use App\Models\UserAddress;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = User::factory()->afterCreating(function ($user) {
            Address::factory()->count(2)->create([
                'user_id' => $user['id'],
            ]);
        })
//            ->hasAddresses(2)
            ->count(19)->create();

//        Address::factory()->count(2)->create()
//        $users->each(function ($user) {
//            Address::factory()->count(2)->create([
//                'user_id' => $user['id'],
//            ]);
//        });

        User::create([
            'name' => 'Ahmed Maalawi',
            'email' => 'ahmedelmaalawi@gmail.com',
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
        ]);
    }
}
