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

namespace Cawa\Widget\Chart\Datasets;

use Cawa\Widget\Chart\Chart;

class Bar extends AbstractDataset
{
    use HoverTrait;
    use AxisTrait;

    /**
     * @return string
     */
    public function getType() : string
    {
        return Chart::TYPE_BAR;
    }

    /**
     * @var array|string|string[]
     */
    protected $borderSkipped;

    /**
     * @return array|string|\string[]
     */
    public function getBorderSkipped()
    {
        return $this->borderSkipped;
    }

    /**
     * @param array|string|\string[] $borderSkipped
     *
     * @return $this|self
     */
    public function setBorderSkipped($borderSkipped) : self
    {
        $this->borderSkipped = $borderSkipped;

        return $this;
    }

    /**
     * @var string
     */
    protected $stack;

    /**
     * @return string
     */
    public function getStack() : string
    {
        return $this->stack;
    }

    /**
     * @param string $stack
     *
     * @return $this|self
     */
    public function setStack(string $stack) : self
    {
        $this->stack = $stack;

        return $this;
    }
}
