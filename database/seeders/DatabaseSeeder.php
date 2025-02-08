<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\CoveragePackage;
use App\Models\EmicatData;
use App\Models\Municipality;
use App\Models\Neighborhood;
use App\Models\PaymentType;
use App\Models\User;
use Faker\Provider\ar_EG\Payment;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            ModuleSeeder::class,
            PermissionSeeder::class,
            AdminSeeder::class,
        ]);
    }
}
