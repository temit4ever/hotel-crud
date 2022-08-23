<?php

namespace App\Console\Commands;

use App\Actions\Import\ProcessImport;
use Illuminate\Console\Command;
use Maatwebsite\Excel\Facades\Excel;

class ImportHotel extends Command
{

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:hotels';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Imports list of hotels from csv';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $path = public_path('hotels.csv');
        Excel::import(new ProcessImport, $path);
        $this->info('Import was successful');
    }
}
