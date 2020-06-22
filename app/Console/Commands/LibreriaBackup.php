<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class LibreriaBackup extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'mysql:backup';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'genera una copia de seguridad';

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
     * @return mixed
     */
    public function handle()
    {
        //$username = \Config::get('database.connections.mysql.username');
        $username = env('DB_USERNAME');
        //$password = \Config::get('database.connections.mysql.password');
        $password = env('DB_PASSWORD');
        //$dbname = \Config::get('database.connections.mysql.database');
        $dbname = env('DB_DATABASE');
        $filename = $dbname . \Carbon\Carbon::now()->toDateString() . '.sql';

        exec('mysqldump -u'.$username.' -p'.$password.' '.$dbname.' > '.$filename);

        $this->info('Tu backup a sido salvado con exito como: '.$filename);
    }
}
