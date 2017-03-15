<?php

/*
 * This file is part of the Сáша framework.
 *
 * (c) tchiotludo <http://github.com/tchiotludo>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare (strict_types=1);

namespace Cawa\Widget\Chart\Scales;

use Cawa\Widget\Chart\Chart;
use Cawa\Widget\Chart\Options\GridLine;
use Cawa\Widget\Chart\Options\Tick;

abstract class AbstractScale implements \JsonSerializable
{
    const TYPE_CATEGORY = 'category';
    const TYPE_LINEAR = 'linear';
    const TYPE_LOGARITHMIC = 'logarithmic';
    const TYPE_TIME = 'time';
    const TYPE_RADIALLINEAR = 'radialLinear';

    const POSITION_TOP = 'top';
    const POSITION_LEFT = 'left';
    const POSITION_BOTTOM = 'bottom';
    const POSITION_RIGHT = 'right';

    /**
     * @param string|null $id
     */
    public function __construct(string $id = null)
    {
        $this->id = $id;
    }

    /**
     * @var bool
     */
    private $display;

    /**
     * @return bool
     */
    public function isDisplay() : bool
    {
        return $this->display;
    }

    /**
     * @param bool $display
     *
     * @return $this|self
     */
    public function setDisplay(bool $display) : self
    {
        $this->display = $display;

        return $this;
    }

    /**
     * @var string
     */
    private $position;

    /**
     * @return string
     */
    public function getPosition() : string
    {
        return $this->position;
    }

    /**
     * @param string $position
     *
     * @return $this|self
     */
    public function setPosition(string $position) : self
    {
        $this->position = $position;

        return $this;
    }

    /**
     * @var string
     */
    protected $id;

    /**
     * @return string
     */
    public function getId() : string
    {
        return $this->id;
    }

    /**
     * @param string $id
     *
     * @return $this|self
     */
    public function setId(string $id) : self
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @var Tick
     */
    protected $ticks;

    /**
     * @return Tick
     */
    public function getTicks() : Tick
    {
        return $this->ticks;
    }

    /**
     * @param Tick $tick
     *
     * @return $this|self
     */
    public function setTicks(Tick $tick) : self
    {
        $this->ticks = $tick;

        return $this;
    }

    /**
     * @var GridLine
     */
    protected $gridLines;

    /**
     * @return GridLine
     */
    public function getGridLines() : GridLine
    {
        return $this->gridLines;
    }

    /**
     * @param GridLine $gridLines
     *
     * @return AbstractScale
     */
    public function setGridLines(GridLine $gridLines) : AbstractScale
    {
        $this->gridLines = $gridLines;

        return $this;
    }

    /**
     * @return string
     */
    abstract public function getType() : string;

    /**
     * {@inheritdoc}
     */
    public function jsonSerialize()
    {
        $return = get_object_vars($this);
        $return['type'] = $this->getType();

        return Chart::filterRecursive($return);
    }
}
