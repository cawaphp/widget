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

namespace Cawa\Widget;

use Cawa\Controller\ViewController;
use Cawa\Renderer\Container;
use Cawa\Renderer\Element;
use Cawa\Renderer\HtmlContainer;
use Cawa\Renderer\WidgetOption;

class Carousel extends HtmlContainer
{
    /**
     * @var WidgetOption
     */
    private $widgetOptions;

    /**
     * {@inheritdoc}
     */
    public function __construct()
    {
        parent::__construct('<div>');
        $this->addClass('cawa-carousel');
        $this->widgetOptions = new WidgetOption();
    }

    /**
     * Setting this to more than 1 initializes grid mode.
     * Use setSlidesPerRow to set how many slides should be in each row.
     *
     * @param int $row
     *
     * @return $this|self
     */
    public function setRows(int $row) : self
    {
        $this->widgetOptions->addData('rows', $row);

        return $this;
    }

    /**
     * With grid mode intialized via the rows option, this sets how many slides are in each grid row.
     *
     * @param int $slide
     *
     * @return $this|self
     */
    public function setSlidesPerRow(int $slide) : self
    {
        $this->widgetOptions->addData('slidesPerRow', $slide);

        return $this;
    }

    /**
     * Show dot indicators
     *
     * @param bool $dots
     *
     * @return $this|self
     */
    public function setDots(bool $dots = false) : self
    {
        $this->widgetOptions->addData('slidesPerRow', $dots);

        return $this;
    }

    /**
     * Display Prev/Next Arrows
     *
     * @param bool $arrows
     *
     * @return $this|self
     */
    public function setArrows(bool $arrows = false) : self
    {
        $this->widgetOptions->addData('arrows', $arrows);

        return $this;
    }

    /**
     * Enables Autoplay
     *
     * @param bool $autoplay
     *
     * @return $this|self
     */
    public function setAutoplay(bool $autoplay = true) : self
    {
        $this->widgetOptions->addData('autoplay', $autoplay);

        return $this;
    }

    /**
     * Infinite loop sliding
     *
     * @param bool $infinite
     *
     * @return $this|self
     */
    public function setInfinite(bool $infinite = false) : self
    {
        $this->widgetOptions->addData('infinite', $infinite);

        return $this;
    }

    /**
     * Enables centered view with partial prev/next slides.
     * Use with odd numbered slidesToShow counts.
     *
     * @param bool $centerMode
     *
     * @return $this|self
     */
    public function setCenterMode(bool $centerMode = true) : self
    {
        $this->widgetOptions->addData('centerMode', $centerMode);

        return $this;
    }

    /**
     * Vertical slide mode
     *
     * @param bool $vertical
     *
     * @return $this|self
     */
    public function setVertical(bool $vertical = true) : self
    {
        $this->widgetOptions->addData('vertical', $vertical);

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function add(ViewController ...$elements)
    {
        foreach ($elements as $element) {
            parent::add((new HtmlContainer('<div>'))->add($element));
        }

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function addFirst(ViewController ...$elements)
    {
        foreach ($elements as $element) {
            parent::addFirst((new HtmlContainer('<div>'))->add($element));
        }

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function render()
    {
        if ($this->widgetOptions->count()) {
            $container = new Container();
            $container->add(new Element(parent::render()));
            $container->add($this->widgetOptions);

            return $container->render();
        } else {
            return parent::render();
        }
    }
}
