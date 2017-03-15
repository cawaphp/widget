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

use Cawa\Widget\Chart\Chart;

abstract class AbstractDataset implements \JsonSerializable
{
    /**
     * @param string $label
     * @param array $data
     */
    public function __construct(string $label = null, array $data = [])
    {
        $this->label = $label;
        $this->data = $data;
    }

    /**
     * @var array|int[]
     */
    protected $data;

    /**
     * @return \int[]
     */
    public function getData() : array
    {
        return $this->data;
    }

    /**
     * @param array|int[] $data
     *
     * @return $this|self
     */
    public function setData(array $data) : self
    {
        $this->data = $data;

        return $this;
    }

    /**
     * @var string
     */
    protected $label;

    /**
     * @return string
     */
    public function getLabel() : string
    {
        return $this->label;
    }

    /**
     * @param string $label
     *
     * @return $this|self
     */
    public function setLabel(string $label) : self
    {
        $this->label = $label;

        return $this;
    }

    /**
     * @var string[]|array|string
     */
    protected $backgroundColor;

    /**
     * @return array|string|string[]
     */
    public function getBackgroundColor()
    {
        return $this->backgroundColor;
    }

    /**
     * @param array|string|string[] $backgroundColor
     *
     * @return $this|self
     */
    public function setBackgroundColor($backgroundColor)
    {
        $this->backgroundColor = $backgroundColor;

        return $this;
    }

    /**
     * @var string[]|array|string
     */
    protected $borderColor;

    /**
     * @return array|string|string[]
     */
    public function getBorderColor()
    {
        return $this->borderColor;
    }

    /**
     * @param array|string|string[] $backgroundColor
     *
     * @return $this|self
     */
    public function setBorderColor($backgroundColor)
    {
        $this->borderColor = $backgroundColor;

        return $this;
    }

    /**
     * @var int[]|array|int
     */
    protected $borderWidth;

    /**
     * @return array|int|int[]
     */
    public function getBorderWidth()
    {
        return $this->borderWidth;
    }

    /**
     * @param array|int|int[] $backgroundColor
     *
     * @return $this|self
     */
    public function setBorderWidth($backgroundColor)
    {
        $this->borderWidth = $backgroundColor;

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
