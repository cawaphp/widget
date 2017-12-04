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
     * @var array
     */
    protected $label;

    /**
     * @return array
     */
    public function getLabel() : ?array
    {
        return $this->label;
    }

    /**
     * @param string $text
     * @param string|null $color
     *
     * @return $this|self
     */
    public function setLabel(string $text = null, string $color = null) : self
    {
        if (!$text) {
            $this->label = null;
        } else {
            $this->label = ['text' => $text, 'color' => $color];
        }

        return $this;
    }

    /**
     * @var array
     */
    protected $iconColor;

    /**
     * @return array
     */
    public function getIconColor() : ?array
    {
        return $this->iconColor;
    }

    /**
     * @param string|null $fillColor
     * @param string|null $strokeColor
     *
     * @return $this|self
     */
    public function setIconColor(string $fillColor = null, string $strokeColor = null) : self
    {
        if (!$fillColor) {
            $this->iconColor = null;
        } else {
            $this->iconColor = ['fillColor' => $fillColor, 'strokeColor' => $strokeColor];
        }

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
    public function getContent() : ?string
    {
        return $this->content;
    }

    /**
     * @param string $content
     *
     * @return $this|self
     */
    public function setContent(string $content = null) : self
    {
        $this->content = $content;

        return $this;
    }
    
    /**
     * @var array
     */
    protected $data = [];

    /**
     * @return array
     */
    public function getData() : array
    {
        return $this->data;
    }

    /**
     * @param array $data
     *
     * @return $this|self
     */
    public function setData(array $data = []) : self
    {
        $this->data = $data;

        return $this;
    }
}
