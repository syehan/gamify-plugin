<?php

namespace Syehan\Gamify\Behaviors;

use October\Rain\Extension\ExtensionBase;

class UserGamifyBehavior extends ExtensionBase
{
    use \Syehan\Gamify\Traits\Gamify;
    
    protected $model;

    public function __construct($model)
    {
        $this->model = $model;
        $this->relationship($model);
    }

    protected function relationship($model)
    {
        $model->belongsToMany['badges'] = [
            config('gamify.badge_model'),
            'table' => 'syehan_gamify_user_badges'
        ];

        $model->hasMany['reputations'] = [
            config('gamify.reputation_model'),
            'key' => 'payee_id'
        ];
    }
}
