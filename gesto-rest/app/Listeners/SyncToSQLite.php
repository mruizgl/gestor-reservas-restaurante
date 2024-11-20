<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class SyncToSQLite
{
    public function handle($event): void
    {
        Log::info('Syncing to SQLite:', $event->model->toArray());

        $model = $event->model;
        $table = $model->getTable();
        $data = $model->toArray();

        // Inserta o actualiza el registro en SQLite
        DB::connection('sqlite')
            ->table($table)
            ->updateOrInsert(['id' => $data['id']], $data);
    }
}
