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

namespace Cawa\Widget\Chart\Options;

class Title extends AbstractOption
{
    use FontTrait;

    const POSITION_TOP = 'top';
    const POSITION_LEFT = 'left';
    const POSITION_BOTTOM = 'bottom';
    const POSITION_RIGHT = 'right';

    /**
     * @param string $text
     */
    public function __construct(string $text)
    {
        $this->text = $text;
    }

    /**
     * @var bool
     */
    protected $display = true;

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
     * @return Title
     */
    public function setDisplay(bool $display) : Title
    {
        $this->display = $display;

        return $this;
    }

    /**
     * @var bool
     */
    protected $fullWidth;

    /**
     * @return bool
     */
    public function isFullWidth() : bool
    {
        return $this->fullWidth;
    }

    /**
     * @param bool $fullWidth
     *
     * @return Title
     */
    public function setFullWidth(bool $fullWidth) : Title
    {
        $this->fullWidth = $fullWidth;

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
     * @var int
     */
    protected $padding;

    /**
     * @return int
     */
    public function getPadding() : int
    {
        return $this->padding;
    }

    /**
     * @param int $padding
     *
     * @return Title
     */
    public function setPadding(int $padding) : Title
    {
        $this->padding = $padding;

        return $this;
    }

    /**
     * @var string
     */
    protected $text;

    /**
     * @return string
     */
    public function getText() : string
    {
        return $this->text;
    }

    /**
     * @param string $text
     *
     * @return Title
     */
    public function setText(string $text) : Title
    {
        $this->text = $text;

        return $this;
    }
}
