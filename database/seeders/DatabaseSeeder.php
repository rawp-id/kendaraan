<?php

namespace Database\Seeders;

use App\Models\Booking;
use App\Models\Driver;
use App\Models\Role;
use App\Models\User;
use App\Models\Vehicle;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use PhpParser\Node\Expr\Cast\Bool_;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Role::create([
            'role' => 'admin'
        ]);

        Role::create([
            'role' => 'superisor'
        ]);

        Role::create([
            'role' => 'direktur'
        ]);

        User::factory(10)->create();

        for ($i = 0; $i < 5; $i++) {
            Driver::create([
                'name' => fake()->name()
            ]);
        }

        $brands = ['Toyota', 'Ford', 'Chevrolet', 'Honda', 'Mercedes-Benz', 'BMW', 'Audi', 'Volkswagen', 'Hyundai', 'Nissan'];
        $types = ['personnel', 'cargo'];
        
        for ($i = 0; $i < 5; $i++) {
            Vehicle::create([
                'merk' => $brands[array_rand($brands)],
                'type' => $types[array_rand($types)]
            ]);
        }

        for ($i = 0; $i < 5; $i++) {
            Booking::create([
                'user_id' => fake()->numberBetween(1,5),
                'vehicle_id' => fake()->numberBetween(1,5),
                'driver_id' => fake()->numberBetween(1,5),
            ]);
        }

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
