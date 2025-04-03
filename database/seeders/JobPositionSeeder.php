<?php

namespace Database\Seeders;

use App\Models\JobPosition;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class JobPositionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        JobPosition::insert([
            ['name' => 'Banquet HouseMan'],
            ['name' => 'Banquet Server'],
            ['name' => 'Barback'],
            ['name' => 'Barista'],
            ['name' => 'Bartender'],
            ['name' => 'Bellman'],
            ['name' => 'Busser'],
            ['name' => 'Cafeteria Attendant'],
            ['name' => 'Cook'],
            ['name' => 'Dishwasher'],
            ['name' => 'Event Cook'],
            ['name' => 'Food Runner'],
            ['name' => 'Front Desk Attendant'],
            ['name' => 'Guest Room Attendant'],
            ['name' => 'Host/Hostess'],
            ['name' => 'Housekeeper'],
            ['name' => 'HouseKeeping Inspector'],
            ['name' => 'Housekeeping Lead'],
            ['name' => 'Housekeeping Supervisor'],
            ['name' => 'Houseman'],
            ['name' => 'Laundry Attendant'],
            ['name' => 'Line Cook'],
            ['name' => 'Lobby Attendant'],
            ['name' => 'Lobby Runner'],
            ['name' => 'Maintenance'],
            ['name' => 'Night Auditor'],
            ['name' => 'Office Clerk'],
            ['name' => 'Pool Attendant'],
            ['name' => 'Prep Cook'],
            ['name' => 'Project Houseman'],
            ['name' => 'Public Area Attendant'],
            ['name' => 'Recreation Supervisor'],
            ['name' => 'Recreation/Towel Attendant'],
            ['name' => 'Runner Housekeeper'],
            ['name' => 'Security Officer'],
            ['name' => 'Server'],
            ['name' => 'Slide Attendant'],
            ['name' => 'Stewards'],
            ['name' => 'Stewards Lead'],
            ['name' => 'Turndown Attendant'],
            ['name' => 'Valet Attendant'],
        ]);
    }
}
