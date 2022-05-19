<?php

namespace App\Listeners;

use App\Events\Invite;
use App\Models\TeamInvite;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendInviteMessage
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
     * @param \App\Events\Invite $event
     * @return bool
     */
    public function handle(Invite $event)
    {
        $team_invite = new TeamInvite;
        $team_invite->team_id = $event->invite_info['team_id'];
        $team_invite->recipient = $event->invite_info['recipient'];
        return $team_invite->save();
    }
}
