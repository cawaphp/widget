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

namespace Cawa\Widget\GoogleMap\Shapes;

class Circle extends AbstractShape
{
    /**
     * @return string
     */
    protected function getType() : string
    {
        return 'Circle';
    }

    /**
     * @param float $lat
     * @param float $long
     * @param float $radius
     */
    public function __construct(float $lat, float $long, float $radius)
    {
        $this->center['lat'] = $lat;
        $this->center['lng'] = $long;
        $this->radius = $radius;
    }

    /**
     * @var array
     */
    protected $center = ['lat' => null, 'lng' => null];

    /**
     * @return float
     */
    public function getLatitude() : float
    {
        return $this->center['lat'];
    }

    /**
     * @return float
     */
    public function getLongitude() : float
    {
        return $this->center['lng'];
    }

    /**
     * @param float $lat
     * @param float $long
     *
     * @return $this|self
     */
    public function setCoordinates(float $lat, float $long) : self
    {
        $this->center['lat'] = $lat;
        $this->center['lng'] = $long;

        return $this;
    }

    /**
     * @var float
     */
    protected $radius;

    /**
     * The radius in meters on the Earth's surface
     *
     * @return float
     */
    public function getRadius() : float
    {
        return $this->radius;
    }

    /**
     * The radius in meters on the Earth's surface
     *
     * @param float $radius
     *
     * @return $this|self
     */
    public function setRadius(float $radius) : self
    {
        $this->radius = $radius;

        return $this;
    }

    /**
     * @var string
     */
    protected $fillColor = '#FF0000';

    /**
     * @return string
     */
    public function getFillColor() : string
    {
        return $this->fillColor;
    }

    /**
     * @var float
     */
    protected $fillOpacity = 0.25;

    /**
     * @return float
     */
    public function getFillOpacity() : float
    {
        return $this->fillOpacity;
    }

    /**
     * @param string $fillColor
     * @param float $opacity
     *
     * @return $this|self
     */
    public function setFill(string $fillColor, float $opacity = 0.25) : self
    {
        $this->fillColor = $fillColor;
        $this->fillOpacity = $opacity;

        return $this;
    }

    /**
     * @var string
     */
    protected $strokeColor = '#FF0000';

    /**
     * @return string
     */
    public function getStrokeColor() : string
    {
        return $this->strokeColor;
    }

    /**
     * @var float
     */
    protected $strokeOpacity = 0.6;

    /**
     * @return float
     */
    public function getStrokeOpacity() : float
    {
        return $this->strokeOpacity;
    }

    /**
     * @var int
     */
    protected $strokeWeight = 1;

    /**
     * @return int
     */
    public function getStrokeWeight() : int
    {
        return $this->strokeWeight;
    }

    /**
     * @param string $color
     * @param float $opacity
     * @param int $weight
     *
     * @return $this|self
     */
    public function setStroke(string $color, float $opacity = 0.6, int $weight = 1) : self
    {
        $this->strokeColor = $color;
        $this->strokeOpacity = $opacity;
        $this->strokeWeight = $weight;

        return $this;
    }
}
