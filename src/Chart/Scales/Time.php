<?php

/*
 * This file is part of the Сáша framework.
 *
 * (c) tchiotludo <http://github.com/tchiotludo>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types = 1);

namespace Cawa\Widget\Chart\Scales;

use Cawa\Date\DateTime;

class Time extends AbstractScale
{
    const UNIT_MILLISECOND = 'millisecond';
    const UNIT_SECOND = 'second';
    const UNIT_MINUTE = 'minute';
    const UNIT_HOUR = 'hour';
    const UNIT_DAY = 'day';
    const UNIT_WEEK = 'week';
    const UNIT_MONTH = 'month';
    const UNIT_QUARTER = 'quarter';
    const UNIT_YEAR = 'year';

    /**
     * @return string
     */
    public function getType() : string
    {
        return self::TYPE_TIME;
    }

    /**
     * @var array
     */
    protected $time;

    /**
     * @return array
     */
    public function getDisplayFormats() : array
    {
        return $this->time['displayFormats'];
    }

    /**
     * @param array $displayFormats
     *
     * @return $this|self
     */
    public function setDisplayFormats(array $displayFormats) : self
    {
        $this->time['displayFormats'] = $displayFormats;

        return $this;
    }

    /**
     * @return bool
     */
    public function isIsoWeekday() : bool
    {
        return $this->time['isoWeekday'];
    }

    /**
     * @param bool $isoWeekday
     *
     * @return $this|self
     */
    public function setIsoWeekday(bool $isoWeekday) : self
    {
        $this->time['isoWeekday'] = $isoWeekday;

        return $this;
    }

    /**
     * @return DateTime
     */
    public function getMin() : DateTime
    {
        return $this->time['min'];
    }

    /**
     * @param DateTime $min
     *
     * @return $this|self
     */
    public function setMin(DateTime $min) : self
    {
        $this->time['min'] = $min;

        return $this;
    }

    /**
     * @return DateTime
     */
    public function getMax() : DateTime
    {
        return $this->time['max'];
    }

    /**
     * @param DateTime $max
     *
     * @return $this|self
     */
    public function setMax(DateTime $max) : self
    {
        $this->time['max'] = $max;

        return $this;
    }

    /**
     * @return string
     */
    public function getRound() : string
    {
        return $this->time['round'];
    }

    /**
     * @param string $round
     *
     * @return $this|self
     */
    public function setRound(string $round) : self
    {
        $this->time['round'] = $round;

        return $this;
    }

    /**
     * @return string
     */
    public function getUnit() : string
    {
        return $this->time['unit'];
    }

    /**
     * @param string $unit
     *
     * @return $this|self
     */
    public function setUnit(string $unit) : self
    {
        $this->time['unit'] = $unit;

        return $this;
    }

    /**
     * @return int
     */
    public function getUnitStepSize() : int
    {
        return $this->time['unitStepSize'];
    }

    /**
     * @param int $unitStepSize
     *
     * @return $this|self
     */
    public function setUnitStepSize(int $unitStepSize) : self
    {
        $this->time['unitStepSize'] = $unitStepSize;

        return $this;
    }

    /**
     * @return string
     */
    public function getMinUnit() : string
    {
        return $this->time['minUnit'];
    }

    /**
     * @param string $minUnit
     *
     * @return $this|self
     */
    public function setMinUnit(string $minUnit) : self
    {
        $this->time['minUnit'] = $minUnit;

        return $this;
    }
}
