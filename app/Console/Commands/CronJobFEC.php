<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class CronJobFEC extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'cronjobfec';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        // Llama a la función del controlador CheckBillController funcion CronJobFEC
        $resultado = app()->call('App\Http\Controllers\CheckBillController@CronJobFEC');

        // Puedes hacer algo con el resultado si es necesario
        $this->info('Resultado de la función del controlador: ' . $resultado);
    }
}
