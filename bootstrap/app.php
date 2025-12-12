<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->alias([
            'preventBackHistory' => \App\Http\Middleware\PreventBackHistory::class,
            'checkProfile' => \App\Http\Middleware\CekProfile::class,
            'checkDataSiswa' => \App\Http\Middleware\CekDataSiswa::class,
            'checkDataOrangTua' => \App\Http\Middleware\CekDataOrangTua::class,
            'checkDataPeriodik' => \App\Http\Middleware\CekDataPeriodik::class,
            'checkUploadBerkas' => \App\Http\Middleware\CekUploadBerkas::class,
            'checkNilaiRaport' => \App\Http\Middleware\CekNilaiRaport::class
        ]);

        $middleware->group('web', [
            \Illuminate\Cookie\Middleware\EncryptCookies::class,
            \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,
            \Illuminate\Session\Middleware\StartSession::class,
            \Illuminate\View\Middleware\ShareErrorsFromSession::class,

            // Pindahkan ke paling akhir!
            // \App\Http\Middleware\PreventBackHistory::class,
        ]);

    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
