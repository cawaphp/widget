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

use Cawa\Controller\ViewController;
use Cawa\Renderer\HtmlContainer;
use Cawa\Renderer\HtmlElement;

class Section extends HtmlContainer
{
    /**
     * @var HtmlElement
     */
    private $title;

    /**
     * @var HtmlContainer
     */
    private $ul;

    /**
     * @param string $title
     */
    public function __construct(string $title)
    {
        parent::__construct('<section>');
        $this->addClass('cawa-sidenav-section');

        parent::add($this->title = new HtmlElement('<h4>', $title));
        parent::add((new HtmlContainer('<div>'))
            ->add($this->ul = new HtmlContainer('<ul>', $title))
        );
    }

    /**
     * @param Link|Link[]|ViewController ...$link
     *
     * @return $this|self
     */
    public function add(ViewController ...$link)
    {
        $this->ul->add(...$link);

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
            return $this->addClass('active');
        } else {
            return $this->removeClass('active');
        }
    }
}
