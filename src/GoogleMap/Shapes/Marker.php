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

class Marker extends AbstractShape implements \JsonSerializable
{
    /**
     * @return string
     */
    protected function getType() : string
    {
        return 'Marker';
    }

    /**
     * @param float $lat
     * @param float $long
     */
    public function __construct(float $lat, float $long)
    {
        $this->position['lat'] = $lat;
        $this->position['lng'] = $long;
    }

    /**
     * @var array
     */
    protected $position = ['lat' => null, 'lng' => null];

    /**
     * @return float
     */
    public function getLatitude() : float
    {
        return $this->position['lat'];
    }

    /**
     * @return float
     */
    public function getLongitude() : float
    {
        return $this->position['lng'];
    }

    /**
     * @param float $lat
     * @param float $long
     *
     * @return $this|self
     */
    public function setCoordinates(float $lat, float $long) : self
    {
        $this->position['lat'] = $lat;
        $this->position['lng'] = $long;

        return $this;
    }

    /**
     * @var string
     */
    protected $label;

    /**
     * @return string
     */
    public function getLabel()
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
     * @var string
     */
    protected $title;

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param string $title
     *
     * @return $this|self
     */
    public function setTitle(string $title) : self
    {
        $this->title = $title;

        return $this;
    }

    /**
     * @var string
     */
    protected $content;

    /**
     * @return string
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * @param string $content
     *
     * @return $this|self
     */
    public function setContent(string $content) : self
    {
        $this->content = $content;

        return $this;
    }
}
