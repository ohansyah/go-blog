<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use App\Mail\WelcomeMail;
use Illuminate\Support\Facades\Mail;

/*
|--------------------------------------------------------------------------
| Console Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of your Closure based console
| commands. Each Closure is bound to a command instance allowing a
| simple approach to interacting with each command's IO methods.
|
*/

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

// php artisan send-welcome-mail
Artisan::command('send-welcome-mail', function () {
    // Mail::to('yourmail@gmail.com')->send(new WelcomeMail("Jon"));
    Mail::mailer('mailtrap')->to('yourmail@gmail.com')->send(new WelcomeMail("Jon"));
})->purpose('Send welcome mail');