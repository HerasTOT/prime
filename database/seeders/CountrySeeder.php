<?php

namespace Database\Seeders;

use App\Models\Country;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\SimpleExcel\SimpleExcelReader;


class CountrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $reader = SimpleExcelReader::create(database_path('seeders/files/paises_estandar.xlsx'))
            ->fromSheet(1)
            ->trimHeaderRow();

        $reader->getRows()
            ->each(function (array $rowProperties) {
                $model = new Country();
                $model->name = $rowProperties['pais'];
                $model->code = $rowProperties['codigo'];
                $model->save();
            });
    }
}
