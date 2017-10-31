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

namespace Cawa\Widget;

use Cawa\Controller\ViewController;
use Cawa\Renderer\Container;
use Cawa\Renderer\Element;
use Cawa\Renderer\HtmlContainer;
use Cawa\Renderer\HtmlElement;
use Cawa\Renderer\WidgetOption;

class Carousel extends HtmlContainer
{
    const PAGINATION_TYPE_BULLETS = 'bullets';
    const PAGINATION_TYPE_FRACTION = 'fraction';
    const PAGINATION_TYPE_PROGRESSBAR = 'progressbar';
    const SLIDEPERVIEW_AUTO = 'auto';

    /**
     * @var WidgetOption
     */
    private $widgetOptions;

    /**
     * @var HtmlContainer
     */
    protected $wrapper;

    /**
     * {@inheritdoc}
     */
    public function __construct()
    {
        parent::__construct('<div>');
        $this->addClass('cawa-carousel swiper-container');
        $this->widgetOptions = new WidgetOption();

        parent::add($this->wrapper = (new HtmlContainer('<div>'))
            ->addClass('swiper-wrapper')
        );
    }

    /**
     * Display Prev/Next Arrows.
     *
     * @param bool $arrows
     *
     * @return $this|self
     */
    public function setArrows(bool $arrows = true) : self
    {
        if ($arrows) {
            parent::add((new HtmlElement('<div>'))
                ->addClass('swiper-button-prev')
            );

            parent::add((new HtmlElement('<div>'))
                ->addClass('swiper-button-next')
            );
        } else {
            /** @var HtmlElement $element */
            foreach ($this->elements as $index => $element) {
                if ($element->hasClass('swiper-button-prev') || $element->hasClass('swiper-button-next')) {
                    unset($this->elements[$index]);
                }
            }
        }

        return $this;
    }

    /**
     * Display Pagination
     *
     * @param bool $value
     *
     * @return $this|self
     */
    public function setPagination(bool $value = true) : self
    {
        if ($value) {
            parent::add((new HtmlElement('<div>'))
                ->addClass('swiper-pagination')
            );

        } else {
            /** @var HtmlElement $element */
            foreach ($this->elements as $index => $element) {
                if ($element->hasClass('swiper-pagination')) {
                    unset($this->elements[$index]);
                }
            }
        }

        return $this;
    }

    /**
     * @param bool $value
     *
     * @return $this|self
     */
    public function setPaginationClickable(bool $value = true) : self
    {
        $this->widgetOptions->addData('plugin', ['pagination' => ['clickable' => $value]]);

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this|self
     */
    public function setPaginationType(string $value) : self
    {
        $this->widgetOptions->addData('plugin', ['pagination' => ['type' => $value]]);

        return $this;
    }

    /**
     * Display Pagination
     *
     * @param bool $value
     *
     * @return $this|self
     */
    public function setScrollbar(bool $value = true) : self
    {
        if ($value) {
            parent::add((new HtmlElement('<div>'))
                ->addClass('swiper-scrollbar')
            );

        } else {
            /** @var HtmlElement $element */
            foreach ($this->elements as $index => $element) {
                if ($element->hasClass('swiper-scrollbar')) {
                    unset($this->elements[$index]);
                }
            }
        }

        return $this;
    }

    /**
     * Enables Autoplay.
     *
     * @param bool $autoplay
     *
     * @return $this|self
     */
    public function setAutoplay(bool $autoplay = true) : self
    {
        $this->widgetOptions->addData('plugin', ['autoplay' => $autoplay]);

        return $this;
    }


    /**
     * @param int $value
     *
     * @return $this|self
     */
    public function setAutoplayDelay(int $value) : self
    {
        $this->widgetOptions->addData('plugin', ['autoplay' => ["delay" => $value]]);

        return $this;
    }


    /**
     * Infinite loop sliding.
     *
     * @param bool $loop
     *
     * @return $this|self
     */
    public function setLoop(bool $loop = true) : self
    {
        $this->widgetOptions->addData('plugin', ['loop' => $loop]);

        return $this;
    }

    /**
     * @param int $value
     *
     * @return $this|self
     */
    public function setSpaceBetween(int $value) : self
    {
        $this->widgetOptions->addData('plugin', ['spaceBetween' => $value]);

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this|self
     */
    public function setSlidesPerView(string $value) : self
    {
        $this->widgetOptions->addData('plugin', ['slidesPerView' => $value == self::SLIDEPERVIEW_AUTO ? $value : (int) $value]);

        return $this;
    }

    /**
     * @param int $value
     *
     * @return $this|self
     */
    public function setSlidePerGroup(int $value) : self
    {
        $this->widgetOptions->addData('plugin', ['slidesPerGroup' => $value]);

        return $this;
    }

    /**
     * @param bool $value
     *
     * @return $this|self
     */
    public function setCenteredSlides(bool $value) : self
    {
        $this->widgetOptions->addData('plugin', ['centeredSlides' => $value]);

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function add(ViewController ...$elements)
    {
        foreach ($elements as $element) {
            $this->wrapper->add((new HtmlContainer('<div>'))
                ->addClass('swiper-slide')
                ->add($element)
            );
        }

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function addFirst(ViewController ...$elements)
    {
        foreach ($elements as $element) {
            $this->wrapper->addFirst((new HtmlContainer('<div>'))
                ->addClass('swiper-slide')
                ->add($element)
            );
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
