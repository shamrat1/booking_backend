<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class MechanicSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $mechanics = [
            'Mechanic One',
            'Mechanic Two',
            'Mechanic Three',
            'Mechanic Four',
            'Mechanic Five',
            'Mechanic Six',
            'Mechanic Seven',
            'Mechanic Eight',
            'Mechanic Nine',
            'Mechanic Ten',
        ];

        foreach ($mechanics as $mechanicName) {
            User::create([
                'name' => $mechanicName,
                'email' => strtolower(str_replace(' ', '', $mechanicName)) . '@gmail.com',
                'password' => Hash::make('password'), // You can replace with a more secure password.
                'role' => 'mechanic',
            ]);
        }
    }
}
