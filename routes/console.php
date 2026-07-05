<?php

use Illuminate\Support\Facades\Artisan;

Artisan::command('about-localmart', function () {
    $this->info('LocalMart BD is ready.');
});
