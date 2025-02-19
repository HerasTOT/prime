<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Catalog; // Importa el modelo

class CatalogSeeder extends Seeder
{
    public function run(): void
    {
        $jobs = [
            'Banquet HouseMan',
            'Banquet Server',
            'Barback',
            'Barista',
            'Bartender',
            'Bellman',
            'Busser',
            'Cafeteria Attendant',
            'Cook',
            'Dishwasher',
            'Event Cook',
            'Food Runner',
            'Front Desk Attendant',
            'Guest Room Attendant',
            'Host/Hostess',
            'Housekeeper',
            'HouseKeeping Inspector',
            'Housekeeping Lead',
            'Housekeeping Supervisor',
            'Houseman',
            'Laundry Attendant',
            'Line Cook',
            'Lobby Attendant',
            'Lobby Runner',
            'Maintenance',
            'Night Auditor',
            'Office Clerk',
            'Pool Attendant',
            'Prep Cook',
            'Project Houseman',
            'Public Area Attendant',
            'Recreation Supervisor',
            'Recreation/Towel Attendant',
            'Runner Housekeeper',
            'Security Officer',
            'Server',
            'Slide Attendant',
            'Stewards',
            'Stewards Lead',
            'Turndown Attendant',
            'Valet Attendant',
        ];

        foreach ($jobs as $job) {
            Catalog::create(['name' => $job]);
        }
    }
}
