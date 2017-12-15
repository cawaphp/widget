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

use Cawa\Renderer\HtmlContainer;
use Cawa\Renderer\HtmlElement;

class Sidenav extends HtmlContainer
{
    const EDGE_LEFT = 'left';
    const EDGE_RIGHT = 'right';

    /**
     *
     */
    public function __construct()
    {
        $this->addClass('cawa-sidenav');
        $this->add((new HtmlElement('<button>'))
            ->addClass('close')
            ->setContent('×')
        );

        parent::__construct('<div>');
    }

    /**
     * @param string $type
     *
     * @return $this
     */
    public function setEdge(string $type) : self
    {
        return $this->addAttribute('data-edge', $type);
    }

    /**
     * @param bool $overlay
     *
     * @return $this
     */
    public function setOverlay(bool $overlay) : self
    {
        return $this->addAttribute('data-overlay', json_encode($overlay));
    }

    /**
     * @param bool $draggable
     *
     * @return $this
     */
    public function setDraggable(bool $draggable) : self
    {
        return $this->addAttribute('data-draggable', json_encode($draggable));
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
