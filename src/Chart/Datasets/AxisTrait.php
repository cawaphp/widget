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

trait AxisTrait
{
    /**
     * @var string
     */
    protected $xAxisID;

    /**
     * @return string
     */
    public function getXAxisID() : string
    {
        return $this->xAxisID;
    }

    /**
     * @param string $xAxisID
     *
     * @return $this|self
     */
    public function setXAxisID(string $xAxisID) : self
    {
        $this->xAxisID = $xAxisID;

        return $this;
    }

    /**
     * @var string
     */
    protected $yAxisID;

    /**
     * @return string
     */
    public function getYAxisID() : string
    {
        return $this->yAxisID;
    }

    /**
     * @param string $yAxisID
     *
     * @return $this|self
     */
    public function setYAxisID(string $yAxisID) : self
    {
        $this->yAxisID = $yAxisID;

        return $this;
    }
}
