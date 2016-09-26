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

        $this->widgetOptions = new WidgetOption(['key' => DI::config()->get('googleMaps/apikey')]);
        $this->setZoom(15);
    }

    /**
     * @return $this|self
     */
    public function resetRatio() : self
    {
        $this->addAttribute('class', preg_replace('/ratio-[0-9]+-[0-9]+/', '', $this->getAttribute('class')));

        return $this;
    }

    /**
     * @param string $ratio
     *
     * @return $this|self
     */
    public function setRatio(string $ratio) : self
    {
        $this->resetRatio();
        $this->addClass('ratio-' . str_replace('/', '-', $ratio));

        return $this;
    }

    /**
     * @param float $lat
     * @param float $long
     *
     * @return $this|self
     */
    public function setCoordinates(float $lat, float $long) : self
    {
        $this->widgetOptions->addData('map', ['center' => ['lat' => $lat, 'lng' => $long]]);

        return $this;
    }

    /**
     * @param int $zoom
     *
     * @return $this|self
     */
    public function setZoom(int $zoom) : self
    {
        $this->widgetOptions->addData('map', ['zoom' => $zoom]);

        return $this;
    }

    /**
     * @param string $type
     *
     * @return $this|self
     */
    public function setMapType(string $type) : self
    {
        $this->widgetOptions->addData('map', ['mapTypeId' => $type]);

        return $this;
    }

    /**
     * @param bool $defaultUi
     *
     * @return $this|self
     */
    public function setDefaultUi(bool $defaultUi = false) : self
    {
        $this->widgetOptions->addData('map', ['disableDefaultUI' => !$defaultUi]);

        return $this;
    }

    /**
     * @param bool $interaction
     *
     * @return $this|self
     */
    public function setInteraction(bool $interaction = false) : self
    {
        $this->widgetOptions->addData('map', [
            'draggable' => $interaction,
            'zoomControl' => $interaction,
            'scrollwheel' => $interaction,
            'disableDoubleClickZoom' => !$interaction,
        ]);

        return $this;
    }

    /**
     * @param bool $clickableIcons
     *
     * @return $this|self
     */
    public function setClickableIcons(bool $clickableIcons) : self
    {
        $this->widgetOptions->addData('map', ['clickableIcons' => $clickableIcons]);

        return $this;
    }

    /**
     * @param int $draggable
     *
     * @return $this|self
     */
    public function setDraggable(int $draggable) : self
    {
        $this->widgetOptions->addData('map', ['draggable' => $draggable]);

        return $this;
    }

    /**
     * @param AbstractShape $shape
     *
     * @return $this|self
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
