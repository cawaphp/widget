<?php

/*
 * This file is part of the Сáша framework.
 *
 * (c) tchiotludo <http://github.com/tchiotludo>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare (strict_types = 1);

namespace Cawa\Widget\Chart\Datasets;

use Cawa\Widget\Chart\Chart;

class Bubble extends AbstractDataset
{
    use HoverTrait;

    /**
     * @return string
     */
    public function getType() : string
    {
        return Chart::TYPE_BUBBLE;
    }

    /**
     * @var int[]|array|int
     */
    protected $hoverRadius;

    /**
     * @return array|int|int[]
     */
    public function getHoverRadius()
    {
        return $this->hoverRadius;
    }

    /**
     * @param array|int|int[] $hoverRadius
     *
     * @return $this|self
     */
    public function setHoverRadius($hoverRadius) : self
    {
        $this->hoverRadius = $hoverRadius;

        return $this;
    }
}
