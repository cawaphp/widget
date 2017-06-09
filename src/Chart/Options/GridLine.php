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

namespace Cawa\Widget\Chart\Options;

class GridLine extends AbstractOption
{
    /**
     * @var bool
     */
    protected $display;

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
     * @var string[]|array|string
     */
    protected $color;

    /**
     * @return array|string|\string[]
     */
    public function getColor()
    {
        return $this->color;
    }

    /**
     * @param array|string|\string[] $color
     *
     * @return $this|self
     */
    public function setColor($color) : self
    {
        $this->color = $color;

        return $this;
    }

    /**
     * @var int[]|array|int
     */
    protected $borderDash;

    /**
     * @return array|int|\int[]
     */
    public function getBorderDash()
    {
        return $this->borderDash;
    }

    /**
     * @param array|int|\int[] $borderDash
     *
     * @return $this|self
     */
    public function setBorderDash($borderDash) : self
    {
        $this->borderDash = $borderDash;

        return $this;
    }

    /**
     * @var float
     */
    protected $borderDashOffset;

    /**
     * @return float
     */
    public function getBorderDashOffset() : float
    {
        return $this->borderDashOffset;
    }

    /**
     * @param float $borderDashOffset
     *
     * @return $this|self
     */
    public function setBorderDashOffset(float $borderDashOffset) : self
    {
        $this->borderDashOffset = $borderDashOffset;

        return $this;
    }

    /**
     * @var int[]|array|int
     */
    protected $lineWidth;

    /**
     * @return array|int|\int[]
     */
    public function getLineWidth()
    {
        return $this->lineWidth;
    }

    /**
     * @param array|int|\int[] $lineWidth
     *
     * @return $this|self
     */
    public function setLineWidth($lineWidth) : self
    {
        $this->lineWidth = $lineWidth;

        return $this;
    }

    /**
     * @var bool
     */
    protected $drawBorder;

    /**
     * @return bool
     */
    public function isDrawBorder() : bool
    {
        return $this->drawBorder;
    }

    /**
     * @param bool $drawBorder
     *
     * @return $this|self
     */
    public function setDrawBorder(bool $drawBorder) : self
    {
        $this->drawBorder = $drawBorder;

        return $this;
    }

    /**
     * @var bool
     */
    protected $drawOnChartArea;

    /**
     * @return bool
     */
    public function isDrawOnChartArea() : bool
    {
        return $this->drawOnChartArea;
    }

    /**
     * @param bool $drawOnChartArea
     *
     * @return $this|self
     */
    public function setDrawOnChartArea(bool $drawOnChartArea) : self
    {
        $this->drawOnChartArea = $drawOnChartArea;

        return $this;
    }

    /**
     * @var bool
     */
    protected $drawTicks;

    /**
     * @return bool
     */
    public function isDrawTicks() : bool
    {
        return $this->drawTicks;
    }

    /**
     * @param bool $drawTicks
     *
     * @return $this|self
     */
    public function setDrawTicks(bool $drawTicks) : self
    {
        $this->drawTicks = $drawTicks;

        return $this;
    }

    /**
     * @var int
     */
    protected $tickMarkLength;

    /**
     * @return int
     */
    public function getTickMarkLength() : int
    {
        return $this->tickMarkLength;
    }

    /**
     * @param int $tickMarkLength
     *
     * @return $this|self
     */
    public function setTickMarkLength(int $tickMarkLength) : self
    {
        $this->tickMarkLength = $tickMarkLength;

        return $this;
    }

    /**
     * @var int
     */
    protected $zeroLineWidth;

    /**
     * @return int
     */
    public function getZeroLineWidth() : int
    {
        return $this->zeroLineWidth;
    }

    /**
     * @param int $zeroLineWidth
     *
     * @return $this|self
     */
    public function setZeroLineWidth(int $zeroLineWidth) : self
    {
        $this->zeroLineWidth = $zeroLineWidth;

        return $this;
    }

    /**
     * @var string
     */
    protected $zeroLineColor;

    /**
     * @return string
     */
    public function getZeroLineColor() : string
    {
        return $this->zeroLineColor;
    }

    /**
     * @param string $zeroLineColor
     *
     * @return $this|self
     */
    public function setZeroLineColor(string $zeroLineColor) : self
    {
        $this->zeroLineColor = $zeroLineColor;

        return $this;
    }

    /**
     * @var bool
     */
    protected $offsetGridLines;

    /**
     * @return bool
     */
    public function isOffsetGridLines() : bool
    {
        return $this->offsetGridLines;
    }

    /**
     * @param bool $offsetGridLines
     *
     * @return $this|self
     */
    public function setOffsetGridLines(bool $offsetGridLines) : self
    {
        $this->offsetGridLines = $offsetGridLines;

        return $this;
    }
}
