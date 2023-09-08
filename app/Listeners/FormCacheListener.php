<?php

namespace App\Listeners;

use App\Models\Form;
use Illuminate\Support\Facades\Cache;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class FormCacheListener
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(object $event)
    {
        Cache::forget('forms');

        Cache::forever('forms', Form::orderBy('created_at', 'desc')->get());

    }
}
