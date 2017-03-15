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

namespace Cawa\Widget\Chart\Datasets;

trait HoverTrait
{
    /**
     * @var string[]|array|string
     */
    protected $hoverBackgroundColor;

    /**
     * @return array|string|string[]
     */
    public function getHoverBackgroundColor()
    {
        return $this->hoverBackgroundColor;
    }

    /**
     * @param array|string|string[] $hoverBackgroundColor
     *
     * @return $this|self
     */
    public function setHoverBackgroundColor($hoverBackgroundColor) : self
    {
        $this->hoverBackgroundColor = $hoverBackgroundColor;

        return $this;
    }

    /**
     * @var string[]|array|string
     */
    protected $hoverBorderColor;

    /**
     * @return array|string|string[]
     */
    public function getHoverBorderColor()
    {
        return $this->hoverBorderColor;
    }

    /**
     * @param array|string|string[] $hoverBackgroundColor
     *
     * @return $this|self
     */
    public function setHoverBorderColor($hoverBackgroundColor) : self
    {
        $this->hoverBorderColor = $hoverBackgroundColor;

        return $this;
    }

    /**
     * @var int[]|array|int
     */
    protected $hoverBorderWidth;

    /**
     * @return array|int|int[]
     */
    public function getHoverBorderWidth()
    {
        return $this->hoverBorderWidth;
    }

    /**
     * @param array|int|int[] $hoverBackgroundColor
     *
     * @return $this|self
     */
    public function setHoverBorderWidth($hoverBackgroundColor) : self
    {
        $this->hoverBorderWidth = $hoverBackgroundColor;

        return $this;
    }
}
