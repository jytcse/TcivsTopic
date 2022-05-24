<?php

namespace App\Listeners;

use App\Events\TopicEdit;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class TopicEditListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  \App\Events\TopicEdit  $event
     * @return void
     */
    public function handle(TopicEdit $event)
    {
        //
    }
}
