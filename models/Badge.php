<?php

namespace Syehan\Gamify\Models;

use Model;

class Badge extends Model
{
    /**
     * @var string The database table used by the model.
     */
    protected $table = 'syehan_gamify_badges';

    protected $guarded = ['id', 'created_at', 'updated_at'];

    public function __construct()
    {
        parent::__construct();

        /**
         * @return October\Rain\Database\Relations\BelongsToMany
         */
        $this->belongsToMany['users'] = [
            config('gamify.payee_model'),
            'table' => 'syehan_gamify_user_badges',
            'timestamps' => true
        ];
    }

    /**
     * Award badge to a user
     *
     * @param $user
     */
    public function awardTo($user)
    {
        $this->users()->attach($user);
    }

    /**
     * Remove badge from user
     *
     * @param $user
     */
    public function removeFrom($user)
    {
        $this->users()->detach($user);
    }
}
