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

trait FontTrait
{
    /**
     * @var string
     */
    protected $fontColor;

    /**
     * @return string
     */
    public function getFontColor() : string
    {
        return $this->fontColor;
    }

    /**
     * @param string $fontColor
     *
     * @return $this|self
     */
    public function setFontColor(string $fontColor) : self
    {
        $this->fontColor = $fontColor;

        return $this;
    }

    /**
     * @var string
     */
    protected $fontFamily;

    /**
     * @return string
     */
    public function getFontFamily() : string
    {
        return $this->fontFamily;
    }

    /**
     * @param string $fontFamily
     *
     * @return $this|self
     */
    public function setFontFamily(string $fontFamily) : self
    {
        $this->fontFamily = $fontFamily;

        return $this;
    }

    /**
     * @var int
     */
    protected $fontSize;

    /**
     * @return int
     */
    public function getFontSize() : int
    {
        return $this->fontSize;
    }

    /**
     * @param int $fontSize
     *
     * @return $this|self
     */
    public function setFontSize(int $fontSize) : self
    {
        $this->fontSize = $fontSize;

        return $this;
    }

    /**
     * @var string
     */
    protected $fontStyle;

    /**
     * @return string
     */
    public function getFontStyle() : string
    {
        return $this->fontStyle;
    }

    /**
     * @param string $fontStyle
     *
     * @return $this|self
     */
    public function setFontStyle(string $fontStyle) : self
    {
        $this->fontStyle = $fontStyle;

        return $this;
    }
}
