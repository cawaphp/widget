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

class Tick extends AbstractOption
{
    /**
     * @var string
     */
    protected $backdropColor;

    /**
     * @return string
     */
    public function getBackdropColor() : string
    {
        return $this->backdropColor;
    }

    /**
     * @param string $backdropColor
     *
     * @return $this|self
     */
    public function setBackdropColor(string $backdropColor) : self
    {
        $this->backdropColor = $backdropColor;

        return $this;
    }

    /**
     * @var int
     */
    protected $backdropPaddingX;

    /**
     * @return int
     */
    public function getBackdropPaddingX() : int
    {
        return $this->backdropPaddingX;
    }

    /**
     * @param int $backdropPaddingX
     *
     * @return $this|self
     */
    public function setBackdropPaddingX(int $backdropPaddingX) : self
    {
        $this->backdropPaddingX = $backdropPaddingX;

        return $this;
    }

    /**
     * @var int
     */
    protected $backdropPaddingY;

    /**
     * @return int
     */
    public function getBackdropPaddingY() : int
    {
        return $this->backdropPaddingY;
    }

    /**
     * @param int $backdropPaddingY
     *
     * @return $this|self
     */
    public function setBackdropPaddingY(int $backdropPaddingY) : self
    {
        $this->backdropPaddingY = $backdropPaddingY;

        return $this;
    }

    /**
     * @var int
     */
    protected $min;

    /**
     * @return int
     */
    public function getMin() : int
    {
        return $this->min;
    }

    /**
     * @param int $min
     *
     * @return $this|self
     */
    public function setMin(int $min) : self
    {
        $this->min = $min;

        return $this;
    }

    /**
     * @var int
     */
    protected $max;

    /**
     * @return int
     */
    public function getMax() : int
    {
        return $this->max;
    }

    /**
     * @param int $max
     *
     * @return $this|self
     */
    public function setMax(int $max) : self
    {
        $this->max = $max;

        return $this;
    }

    /**
     * @var int
     */
    protected $maxTicksLimit;

    /**
     * @return int
     */
    public function getMaxTicksLimit() : int
    {
        return $this->maxTicksLimit;
    }

    /**
     * @param int $maxTicksLimit
     *
     * @return $this|self
     */
    public function setMaxTicksLimit(int $maxTicksLimit) : self
    {
        $this->maxTicksLimit = $maxTicksLimit;

        return $this;
    }

    /**
     * @var bool
     */
    protected $showLabelBackdrop;

    /**
     * @return bool
     */
    public function isShowLabelBackdrop() : bool
    {
        return $this->showLabelBackdrop;
    }

    /**
     * @param bool $showLabelBackdrop
     *
     * @return $this|self
     */
    public function setShowLabelBackdrop(bool $showLabelBackdrop) : self
    {
        $this->showLabelBackdrop = $showLabelBackdrop;

        return $this;
    }

    /**
     * @var int
     */
    protected $fixedStepSize;

    /**
     * @return int
     */
    public function getFixedStepSize() : int
    {
        return $this->fixedStepSize;
    }

    /**
     * @param int $fixedStepSize
     *
     * @return $this|self
     */
    public function setFixedStepSize(int $fixedStepSize) : self
    {
        $this->fixedStepSize = $fixedStepSize;

        return $this;
    }

    /**
     * @var int
     */
    protected $stepSize;

    /**
     * @return int
     */
    public function getStepSize() : int
    {
        return $this->stepSize;
    }

    /**
     * @param int $stepSize
     *
     * @return $this|self
     */
    public function setStepSize(int $stepSize) : self
    {
        $this->stepSize = $stepSize;

        return $this;
    }

    /**
     * @var int
     */
    protected $suggestedMax;

    /**
     * @return int
     */
    public function getSuggestedMax() : int
    {
        return $this->suggestedMax;
    }

    /**
     * @param int $suggestedMax
     *
     * @return $this|self
     */
    public function setSuggestedMax(int $suggestedMax) : self
    {
        $this->suggestedMax = $suggestedMax;

        return $this;
    }

    /**
     * @var
     */
    protected $suggestedMin;

    /**
     * @return mixed
     */
    public function getSuggestedMin()
    {
        return $this->suggestedMin;
    }

    /**
     * @param mixed $suggestedMin
     *
     * @return $this|self
     */
    public function setSuggestedMin($suggestedMin)
    {
        $this->suggestedMin = $suggestedMin;

        return $this;
    }

    /**
     * @var bool
     */
    protected $beginAtZero;

    /**
     * @return bool
     */
    public function isBeginAtZero() : bool
    {
        return $this->beginAtZero;
    }

    /**
     * @param bool $beginAtZero
     *
     * @return $this|self
     */
    public function setBeginAtZero(bool $beginAtZero) : self
    {
        $this->beginAtZero = $beginAtZero;

        return $this;
    }
}
