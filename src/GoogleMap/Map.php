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

namespace Cawa\Widget\GoogleMap;

use Cawa\Core\DI;
use Cawa\Renderer\Container;
use Cawa\Renderer\Element;
use Cawa\Renderer\HtmlContainer;
use Cawa\Renderer\HtmlElement;
use Cawa\Renderer\WidgetOption;
use Cawa\Widget\GoogleMap\Shapes\AbstractShape;

class Map extends HtmlContainer
{
    const TYPE_ROADMAP = 'roadmap';
    const TYPE_SATELLITE = 'satellite';
    const TYPE_HYBRID = 'hybrid';
    const TYPE_TERRAIN = 'terrain';

    /**
     * @var WidgetOption
     */
    protected $widgetOptions;

    /**
     * {@inheritdoc}
     */
    public function __construct()
    {
        parent::__construct('<div>');
        $this->addClass('cawa-google-map');
        $this->add((new HtmlElement('<div>')));

        $this->widgetOptions = new WidgetOption(['key' => DI::config()->get('googlemaps/apikey')]);
        $this->setZoom(15);
    }

    /**
     * @param string $ratio
     *
     * @return $this
     */
    public function setRatio(string $ratio) : self
    {
        $this->addClass('ratio-' . str_replace('/', '-', $ratio));

        return $this;
    }

    /**
     * @param float $lat
     * @param float $long
     *
     * @return $this
     */
    public function setCoordinates(float $lat, float $long) : self
    {
        $this->widgetOptions->addData('map', ['center' => ['lat' => $lat, 'lng' => $long]]);

        return $this;
    }

    /**
     * @param int $zoom
     *
     * @return $this
     */
    public function setZoom(int $zoom) : self
    {
        $this->widgetOptions->addData('map', ['zoom' => $zoom]);

        return $this;
    }

    /**
     * @param string $type
     *
     * @return $this
     */
    public function setMapType(string $type) : self
    {
        $this->widgetOptions->addData('map', ['mapTypeId' => $type]);

        return $this;
    }

    /**
     * @param bool $defaultUi
     *
     * @return $this
     */
    public function setDefaultUi(bool $defaultUi = false) : self
    {
        $this->widgetOptions->addData('map', ['disableDefaultUI' => !$defaultUi]);

        return $this;
    }

    /**
     * @param bool $clickableIcons
     *
     * @return $this
     */
    public function setClickableIcons(bool $clickableIcons) : self
    {
        $this->widgetOptions->addData('map', ['clickableIcons' => $clickableIcons]);

        return $this;
    }

    /**
     * @param bool $draggable
     *
     * @return $this
     */
    public function setDraggable(int $draggable) : self
    {
        $this->widgetOptions->addData('map', ['draggable' => $draggable]);

        return $this;
    }

    /**
     * @param AbstractShape $shape
     *
     * @return $this
     */
    public function addShape(AbstractShape $shape)
    {
        $this->widgetOptions->addData('shapes', [$shape]);

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function render()
    {
        $container = new Container();
        $container->add(new Element(parent::render()));
        $container->add($this->widgetOptions);

        return $container->render();
    }
}
