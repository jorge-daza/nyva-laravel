<?php

use Illuminate\Support\Facades\Artisan;

Artisan::command('nyva:about', function () {
    $this->info('NYVA - Actividad 2 - Electiva Profesional II');
})->purpose('Muestra información breve del proyecto académico NYVA');
