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

namespace Cawa\Widget\Sidenav;

use Cawa\Renderer\Container;
use Cawa\Renderer\Element;
use Cawa\Renderer\WidgetOption;

class Menu extends Sidenav
{
    /**
     * @var WidgetOption
     */
    protected $widgetOptions;

    /**
     *
     */
    public function __construct()
    {
        $this->addClass('cawa-sidenav-menu');
        $this->widgetOptions = new WidgetOption();

        parent::__construct();
    }

    /**
     * @param string $selector
     *
     * @return self
     */
    public function setSelectedSection(string $selector) : self
    {
        $this->widgetOptions->addData('selectedSection', $selector);

        return $this;
    }

    /**
     * @param string $selector
     *
     * @return self
     */
    public function setSelectedLink(string $selector) : self
    {
        $this->widgetOptions->addData('selectedLink', $selector);

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
