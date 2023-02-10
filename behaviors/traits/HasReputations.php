<?php

namespace Syehan\Gamify\Behaviors\Traits;

use Syehan\Gamify\Events\ReputationChanged;
use Syehan\Gamify\Classes\PointType;

trait HasReputations
{
    /**
     * Give reputation point to payee
     *
     * @param PointType $pointType
     * @return bool
     */
    public function givePoint(PointType $pointType)
    {
        if (!$pointType->qualifier()) {
            return false;
        }

        if ($this->storeReputation($pointType)) {
            return $pointType->payee()->addPoint($pointType->getPoints());
        }
    }

    /**
     * Undo last given point for a subject model
     *
     * @param PointType $pointType
     * @return bool
     */
    public function undoPoint(PointType $pointType)
    {
        $reputation = $pointType->firstReputation();

        if (!$reputation) {
            return false;
        }

        // undo reputation
        $reputation->undo();
    }

    /**
     * Store a reputation for point
     *
     * @param PointType $pointType
     * @param array $meta
     * @return mixed
     */
    public function storeReputation(PointType $pointType, array $meta = [])
    {
        if (!$this->isDuplicatePointAllowed($pointType) && $pointType->reputationExists()) {
            return false;
        }

        return $pointType->storeReputation($meta);
    }

    /**
     * Give point to a user
     *
     * @param int $point
     * @return HasReputations
     */
    public function addPoint($point = 1)
    {
        $this->model->increment($this->getReputationField(), $point);

        ReputationChanged::dispatch($this->model, $point, true);

        return $this->model;
    }

    /**
     * Reduce a user point
     *
     * @param int $point
     * @return HasReputations
     */
    public function reducePoint($point = 1)
    {
        $this->model->decrement($this->getReputationField(), $point);

        ReputationChanged::dispatch($this->model, $point, false);

        return $this->model;
    }

    /**
     * Reset a user point to zero
     *
     * @return mixed
     */
    public function resetPoint()
    {
        $this->model->forceFill([$this->getReputationField() => 0])->save();

        ReputationChanged::dispatch($this->model, 0, false);

        return $this->model;
    }

    /**
     * Get user reputation point
     *
     * @param bool $formatted
     * @return int|string
     */
    public function getPoints($formatted = false)
    {
        $point = $this->model->{$this->getReputationField()};

        if ($formatted) {
            return short_number($point);
        }

        return (int) $point;
    }

    /**
     * Get the reputation column name
     *
     * @return string
     */
    protected function getReputationField()
    {
        return property_exists($this->model, 'reputationColumn')
            ? $this->model->reputationColumn
            : 'syehan_gamify_reputation';
    }

    /**
     * Check for duplicate point allowed
     *
     * @param PointType $pointType
     * @return bool
     */
    protected function isDuplicatePointAllowed(PointType $pointType)
    {
        return property_exists($pointType, 'allowDuplicates')
            ? $pointType->allowDuplicates
            : config('gamify.allow_reputation_duplicate', true);
    }

    public function test()
    {
        return 'aja';
    }
}
