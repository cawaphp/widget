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

use Cawa\Net\Uri;
use Cawa\Renderer\HtmlContainer;
use Cawa\Renderer\HtmlElement;

class Link extends HtmlContainer
{
    /**
     * @param string $title
     * @param string $url
     */
    public function __construct(string $title = null, string $url = null)
    {
        parent::__construct('<li>');

        $this->add(($this->link = new HtmlContainer('<a>'))
            ->add($this->icon = (new HtmlElement('<span>'))
                ->addClass('icon')
            )
            ->add($this->title = (new HtmlElement('<span>'))
                ->addClass('title')
            )
            ->add((new HtmlContainer('<span>'))
                ->addClass('counter')
                ->add($this->badge = (new HtmlElement('<span>'))
                    ->addClass('badge')
                )
            )
        );

        $this
            ->setTitle($title)
            ->setUrl($url);
    }

    /**
     * @var HtmlElement
     */
    private $icon;

    /**
     * @param string $title
     *
     * @return $this
     */
    public function setIcon(string $title = null) : self
    {
        $this->icon->setContent($title);

        return $this;
    }

    /**
     * @var HtmlContainer
     */
    private $title;

    /**
     * @param string $title
     *
     * @return $this
     */
    public function setTitle(string $title = null) : self
    {
        $this->title->setContent($title);

        return $this;
    }

    /**
     * @var HtmlElement
     */
    private $badge;

    /**
     * @param string|int $count
     *
     * @return $this
     */
    public function setCount($count = null) : self
    {
        $this->badge->setContent($count);

        return $this;
    }

    /**
     * @var HtmlContainer
     */
    private $link;

    /**
     * @return HtmlContainer
     */
    public function getLink() : HtmlContainer
    {
        return $this->link;
    }

    /**
     * @param string|Uri $url
     *
     * @return $this
     */
    public function setUrl($url) : self
    {
        if ($url) {
            $this->link->addAttribute('href', (string) $url);
        } else {
            $this->link->removeAttribute('href');
        }


        return $this;
    }

    /**
     * @param bool $active
     *
     * @return $this
     */
    public function setActive(bool $active) : self
    {
        if ($active) {
            $this->link->addClass('active');
        } else {
            $this->link->removeClass('active');
        }

        return $this;
    }

    /**
     * @param bool $active
     *
     * @return $this
     */
    public function setBack(bool $active) : self
    {
        if ($active) {
            $this->link->addClass('arrow left');
        } else {
            $this->link->removeClass('arrow left');
        }

        return $this;
    }


    /**
     * @var Section
     */
    private $childSection;

    /**
     * @param Section $childSection
     *
     * @return $this
     */
    public function setTargetSection(Section $childSection) : self
    {
        if (!$childSection->getId()) {
            $childSection->generateId();
        }

        $this->link->addAttribute('data-section-target', $childSection->getId());

        $this->childSection = $childSection;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function render()
    {
        if ($this->childSection && !$this->link->hasClass('arrow')) {
            $this->link->addClass('arrow right');
        }

        return parent::render();
    }
}
