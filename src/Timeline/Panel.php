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

namespace Cawa\Widget\Timeline;

use Cawa\Date\DateTime;
use Cawa\Renderer\Element;
use Cawa\Renderer\HtmlContainer;
use Cawa\Renderer\HtmlElement;

class Panel extends \Cawa\Bootstrap\Components\Panel
{
    /**
     * @param DateTime $date
     * @param null $content
     * @param string $type
     */
    public function __construct(DateTime $date, $content = null, $type = \Cawa\Bootstrap\Components\Panel::TYPE_DEFAULT)
    {
        parent::__construct(null, $content, $type);

        $this->date = $date;
    }

    /**
     * @var DateTime
     */
    private $date;

    /**
     * @return DateTime
     */
    public function getDate() : DateTime
    {
        return $this->date;
    }

    /**
     * @param DateTime $date
     *
     * @return $this|self
     */
    public function setDate(DateTime $date) : self
    {
        $this->date = $date;

        return $this;
    }

    /**
     * @var bool
     */
    private $displayTime = true;

    /**
     * @return bool
     */
    public function isDisplayTime() : bool
    {
        return $this->displayTime;
    }

    /**
     * @param bool $displayTime
     *
     * @return Panel
     */
    public function setDisplayTime(bool $displayTime) : Panel
    {
        $this->displayTime = $displayTime;

        return $this;
    }

    /**
     * @var string
     */
    private $icon;

    /**
     * @return string|null
     */
    public function getIcon()
    {
        return $this->icon;
    }

    /**
     * @param string $icon
     *
     * @return Panel
     */
    public function setIcon(string $icon) : Panel
    {
        $this->icon = $icon;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function render()
    {
        if ($this->icon) {
            HtmlContainer::addFirst((new HtmlElement('<div>', $this->icon))
                ->addClass('panel-heading icon')
            );
        }

        if (!$this->getTitle()) {
            $this->addClass('panel-outline');
        }

        if ($this->displayTime) {
            $time = (new HtmlElement('<span>', $this->date->display([null, DateTime::DISPLAY_SHORT])))
                ->addClass('time')
                ->render();

            if ($this->getTitle()) {
                $this->setTitle($time . $this->getTitle());
            } elseif ($this->getContent()) {
                $this->setContent($time . $this->getContent());
            } else {
                $this->container->addFirst(new Element($time));
            }
        }

        return parent::render();
    }
}
