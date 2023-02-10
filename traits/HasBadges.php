<?php

namespace Syehan\Gamify\Traits;

trait HasBadges
{
    /**
     * Boot the Has Badges trait for a model
     *
     * @return void
     */
    public static function bootHasBadges()
    {
        static::extend(function($model) {

            /**
             * Badges user relation
             *
             * @return October\Rain\Database\Relations\BelongsToMany
             */
            $model->belongsToMany['badges'] = [
                config('gamify.badge_model'),
                'table' => 'syehan_gamify_user_badges',
                'timestamps' => true
            ];
        });
    }

    /**
     * Sync badges for qiven user
     *
     * @param $user
     */
    public function syncBadges($user = null)
    {
        $user = is_null($user) ? $this : $user;

        $badgeIds = app('badges')->filter
            ->qualifier($user)
            ->map->getBadgeId();

        $user->badges()->sync($badgeIds);
    }
}
