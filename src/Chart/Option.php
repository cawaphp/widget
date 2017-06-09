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

namespace Cawa\Widget\Chart;

use Cawa\Widget\Chart\Options\Title;
use Cawa\Widget\Chart\Scales\AbstractScale;

class Option implements \JsonSerializable
{
    /**
     * @var AbstractScale[][]
     */
    protected $scales;

    /**
     * @return AbstractScale[][]
     */
    public function getScales() : array
    {
        return $this->scales;
    }

    /**
     * @param bool $xAxes
     * @param AbstractScale $scale
     *
     * @return $this|self
     */
    public function addScales(bool $xAxes, AbstractScale $scale) : self
    {
        $this->scales[$xAxes ? 'xAxes' : 'yAxes'][] = $scale;

        return $this;
    }

    /**
     * @var Title
     */
    protected $title;

    /**
     * @return Title
     */
    public function getTitle() : Title
    {
        return $this->title;
    }

    /**
     * @param Title $title
     *
     * @return $this|self
     */
    public function setTitle(Title $title) : self
    {
        $this->title = $title;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function jsonSerialize()
    {
        $return = get_object_vars($this);

        return Chart::filterRecursive($return);
    }
}
