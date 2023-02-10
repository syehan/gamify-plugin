<?php

namespace Syehan\Gamify\Models;

use Model;

class Reputation extends Model
{
    /**
     * @var string The database table used by the model.
     */
    protected $table = 'syehan_gamify_reputations';

    protected $guarded = ['id', 'created_at', 'updated_at'];

    public function __construct()
    {
        parent::__construct();

        /**
         * Payee User
         * 
         * @return October\Rain\Database\Relations\BelongsToMany
         */
        $this->belongsTo['payee'] = [
            config('gamify.payee_model'),
            'key' => 'payee_id',
        ];

        /**
         * Get the owning subject model
         * 
         * @return October\Rain\Database\Relations\MorphTo
         */
        $this->morphTo['subject'] = [];
    }

    /**
     * Undo last point
     *
     * @throws \Exception
     */
    public function undo()
    {
        if ($this->exists) {
            $this->payee->reducePoint($this->point);
            $this->delete();
        }
    }
}
