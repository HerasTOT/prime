<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\EntryFormatImport;

class ImportEntryFormats extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:entryformats';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Importa datos del CSV a la tabla entry_formats';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        Excel::import(new EntryFormatImport, storage_path('app/imports/prueba1.csv'));
        $this->info('Importación completa');
    }
}
