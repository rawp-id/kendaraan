<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use App\Models\Driver;
use App\Models\Booking;
use App\Models\Vehicle;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use PhpParser\Node\Expr\Cast\Bool_;
use Illuminate\Support\Facades\Hash;

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
            'role' => 'superadmin'
        ]);

        // User::factory(10)->create();

        for ($i = 0; $i < 5; $i++) {
            Driver::create([
                'name' => fake()->name(),
                'license' => fake()->randomElement([fake()->title(), null])
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

        // for ($i = 0; $i < 5; $i++) {
        //     Booking::create([
        //         'user_id' => fake()->numberBetween(1,5),
        //         'vehicle_id' => fake()->numberBetween(1,5),
        //         'driver_id' => fake()->numberBetween(1,5),
        //         'start_date' => now(),
        //         'end_date' => fake()->dateTime(),
        //     ]);
        // }

        User::factory()->create([
            'name' => 'apep',
            'email' => 'asep@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'remember_token' => Str::random(10),
            'role_id' => 2,
        ]);

        User::factory()->create([
            'name' => 'jono',
            'email' => 'jono@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'remember_token' => Str::random(10),
            'role_id' => 1,
        ]);
    }
}
