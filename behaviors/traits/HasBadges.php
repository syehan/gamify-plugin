<?php

namespace Syehan\Gamify\Behaviors\Traits;

trait HasBadges
{
    /**
     * Sync badges for qiven user
     *
     * @param $user
     */
    public function syncBadges($user = null)
    {
        $user = is_null($user) ? $this->model : $user;

        $badgeIds = app('badges')->filter
            ->qualifier($user)
            ->map->getBadgeId();

        $user->badges()->sync($badgeIds);
    }
}
