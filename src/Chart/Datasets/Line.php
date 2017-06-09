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

class Line extends AbstractDataset
{
    use HoverTrait;
    use AxisTrait;

    /**
     * @return string
     */
    public function getType() : string
    {
        return Chart::TYPE_LINE;
    }

    /**
     * @var bool
     */
    protected $fill;

    /**
     * @return bool
     */
    public function isFill() : bool
    {
        return $this->fill;
    }

    /**
     * @param bool $fill
     *
     * @return $this|self
     */
    public function setFill(bool $fill) : self
    {
        $this->fill = $fill;

        return $this;
    }

    /**
     * @var string
     */
    protected $cubicInterpolationMode;

    /**
     * @return string
     */
    public function getCubicInterpolationMode() : string
    {
        return $this->cubicInterpolationMode;
    }

    /**
     * @param string $cubicInterpolationMode
     *
     * @return $this|self
     */
    public function setCubicInterpolationMode(string $cubicInterpolationMode) : self
    {
        $this->cubicInterpolationMode = $cubicInterpolationMode;

        return $this;
    }

    /**
     * @var float
     */
    protected $lineTension;

    /**
     * @return float
     */
    public function getLineTension() : float
    {
        return $this->lineTension;
    }

    /**
     * @param float $lineTension
     *
     * @return $this|self
     */
    public function setLineTension(float $lineTension) : self
    {
        $this->lineTension = $lineTension;

        return $this;
    }

    /**
     * @var string
     */
    protected $borderCapStyle;

    /**
     * @return string
     */
    public function getBorderCapStyle() : string
    {
        return $this->borderCapStyle;
    }

    /**
     * @param string $borderCapStyle
     *
     * @return $this|self
     */
    public function setBorderCapStyle(string $borderCapStyle) : self
    {
        $this->borderCapStyle = $borderCapStyle;

        return $this;
    }

    /**
     * @var int[]|array|int
     */
    protected $borderDash;

    /**
     * @return array|int|int[]
     */
    public function getBorderDash()
    {
        return $this->borderDash;
    }

    /**
     * @param array|int|int[] $borderDash
     *
     * @return $this|self
     */
    public function setBorderDash($borderDash) : self
    {
        $this->borderDash = $borderDash;

        return $this;
    }

    /**
     * @var int
     */
    protected $borderDashOffset;

    /**
     * @return int
     */
    public function getBorderDashOffset() : int
    {
        return $this->borderDashOffset;
    }

    /**
     * @param int $borderDashOffset
     *
     * @return $this|self
     */
    public function setBorderDashOffset(int $borderDashOffset) : self
    {
        $this->borderDashOffset = $borderDashOffset;

        return $this;
    }

    /**
     * @var string
     */
    protected $borderJoinStyle;

    /**
     * @return string
     */
    public function getBorderJoinStyle() : string
    {
        return $this->borderJoinStyle;
    }

    /**
     * @param string $borderJoinStyle
     *
     * @return $this|self
     */
    public function setBorderJoinStyle(string $borderJoinStyle) : self
    {
        $this->borderJoinStyle = $borderJoinStyle;

        return $this;
    }

    /**
     * @var string[]|array|string
     */
    protected $pointBackgroundColor;

    /**
     * @return array|string|string[]
     */
    public function getPointBackgroundColor()
    {
        return $this->pointBackgroundColor;
    }

    /**
     * @param array|string|string[] $pointBackgroundColor
     *
     * @return $this|self
     */
    public function setPointBackgroundColor($pointBackgroundColor) : self
    {
        $this->pointBackgroundColor = $pointBackgroundColor;

        return $this;
    }

    /**
     * @var string[]|array|string
     */
    protected $pointBorderColor;

    /**
     * @return array|string|string[]
     */
    public function getPointBorderColor()
    {
        return $this->pointBorderColor;
    }

    /**
     * @param array|string|string[] $pointBackgroundColor
     *
     * @return $this|self
     */
    public function setPointBorderColor($pointBackgroundColor) : self
    {
        $this->pointBorderColor = $pointBackgroundColor;

        return $this;
    }

    /**
     * @var int[]|array|int
     */
    protected $pointBorderWidth;

    /**
     * @return array|int|int[]
     */
    public function getPointBorderWidth()
    {
        return $this->pointBorderWidth;
    }

    /**
     * @param array|int|int[] $pointBackgroundColor
     *
     * @return $this|self
     */
    public function setPointBorderWidth($pointBackgroundColor) : self
    {
        $this->pointBorderWidth = $pointBackgroundColor;

        return $this;
    }

    /**
     * @var string[]|array|string
     */
    protected $pointHoverBackgroundColor;

    /**
     * @return array|string|string[]
     */
    public function getPointHoverBackgroundColor()
    {
        return $this->pointHoverBackgroundColor;
    }

    /**
     * @param array|string|string[] $pointHoverBackgroundColor
     *
     * @return $this|self
     */
    public function setPointHoverBackgroundColor($pointHoverBackgroundColor) : self
    {
        $this->pointHoverBackgroundColor = $pointHoverBackgroundColor;

        return $this;
    }

    /**
     * @var string[]|array|string
     */
    protected $pointHoverBorderColor;

    /**
     * @return array|string|string[]
     */
    public function getPointHoverBorderColor()
    {
        return $this->pointHoverBorderColor;
    }

    /**
     * @param array|string|string[] $pointHoverBackgroundColor
     *
     * @return $this|self
     */
    public function setPointHoverBorderColor($pointHoverBackgroundColor) : self
    {
        $this->pointHoverBorderColor = $pointHoverBackgroundColor;

        return $this;
    }

    /**
     * @var int[]|array|int
     */
    protected $pointHoverBorderWidth;

    /**
     * @return array|int|int[]
     */
    public function getPointHoverBorderWidth()
    {
        return $this->pointHoverBorderWidth;
    }

    /**
     * @param array|int|int[] $pointHoverBackgroundColor
     *
     * @return $this|self
     */
    public function setPointHoverBorderWidth($pointHoverBackgroundColor) : self
    {
        $this->pointHoverBorderWidth = $pointHoverBackgroundColor;

        return $this;
    }

    /**
     * @var int[]|array|int
     */
    protected $pointRadius;

    /**
     * @return array|int|int[]
     */
    public function getPointRadius()
    {
        return $this->pointRadius;
    }

    /**
     * @param array|int|int[] $pointRadius
     *
     * @return $this|self
     */
    public function setPointRadius($pointRadius) : self
    {
        $this->pointRadius = $pointRadius;

        return $this;
    }

    /**
     * @var int[]|array|int
     */
    protected $pointHoverRadius;

    /**
     * @return array|int|int[]
     */
    public function getPointHoverRadius()
    {
        return $this->pointHoverRadius;
    }

    /**
     * @param array|int|int[] $pointHoverRadius
     *
     * @return $this|self
     */
    public function setPointHoverRadius($pointHoverRadius) : self
    {
        $this->pointHoverRadius = $pointHoverRadius;

        return $this;
    }

    /**
     * @var int[]|array|int
     */
    protected $pointHitRadius;

    /**
     * @return array|int|int[]
     */
    public function getPointHitRadius()
    {
        return $this->pointHitRadius;
    }

    /**
     * @param array|int|int[] $pointHitRadius
     *
     * @return $this|self
     */
    public function setPointHitRadius($pointHitRadius) : self
    {
        $this->pointHitRadius = $pointHitRadius;

        return $this;
    }

    /**
     * @var string[]|array|string
     */
    protected $pointStyle;

    /**
     * @return array|string|\string[]
     */
    public function getPointStyle()
    {
        return $this->pointStyle;
    }

    /**
     * @param array|string|\string[] $pointStyle
     *
     * @return $this|self
     */
    public function setPointStyle($pointStyle) : self
    {
        $this->pointStyle = $pointStyle;

        return $this;
    }

    /**
     * @var bool
     */
    protected $showLine = true;

    /**
     * @return bool
     */
    public function isShowLine() : bool
    {
        return $this->showLine;
    }

    /**
     * @param bool $showLine
     *
     * @return $this|self
     */
    public function setShowLine(bool $showLine) : self
    {
        $this->showLine = $showLine;

        return $this;
    }

    /**
     * @var bool
     */
    protected $spanGaps;

    /**
     * @return bool
     */
    public function isSpanGaps() : bool
    {
        return $this->spanGaps;
    }

    /**
     * @param bool $spanGaps
     *
     * @return $this|self
     */
    public function setSpanGaps(bool $spanGaps) : self
    {
        $this->spanGaps = $spanGaps;

        return $this;
    }

    /**
     * @var bool
     */
    protected $steppedLine;

    /**
     * @return bool
     */
    public function isSteppedLine() : bool
    {
        return $this->steppedLine;
    }

    /**
     * @param bool $steppedLine
     *
     * @return $this|self
     */
    public function setSteppedLine(bool $steppedLine) : self
    {
        $this->steppedLine = $steppedLine;

        return $this;
    }
}
