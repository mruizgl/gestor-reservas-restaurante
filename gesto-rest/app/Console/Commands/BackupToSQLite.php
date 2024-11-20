<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class BackupToSQLite extends Command
{
    protected $signature = 'backup:sqlite';
    protected $description = 'Backup MySQL data to SQLite database';

    public function handle()
    {
        try {
            // Tablas a sincronizar
            $tables = ['users', 'reservations', 'spaces', 'tables'];

            foreach ($tables as $table) {
                // Obtener datos de MySQL
                $mysqlData = DB::connection('mysql')->table($table)->get();

                // Limpia la tabla SQLite
                DB::connection('sqlite')->table($table)->truncate();

                // Inserta datos en SQLite
                DB::connection('sqlite')->table($table)->insert(
                    $mysqlData->map(fn($item) => (array) $item)->toArray()
                );
            }

            $this->info('Backup completed successfully!');
        } catch (\Exception $e) {
            Log::error('Backup failed: ' . $e->getMessage());
            $this->error('Backup failed: ' . $e->getMessage());
        }
    }
}
