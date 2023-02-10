<?php

namespace Syehan\Gamify\Listeners;

use Syehan\Gamify\Events\ReputationChanged;

class SyncBadges
{
    /**
     * Handle the event.
     *
     * @param  ReputationChanged  $event
     * @return void
     */
    public function handle(ReputationChanged $event)
    {
        $event->user->syncBadges();
    }
}
