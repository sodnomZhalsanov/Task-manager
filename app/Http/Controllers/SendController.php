<?php

namespace App\Http\Controllers;

use App\Jobs\SendEmailJob;
use Illuminate\Http\Request;

class SendController extends Controller
{
    //
    public function sendText()
    {
        SendEmailJob::dispatch()->onQueue('text');
    }

}
