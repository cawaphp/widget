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

use Cawa\Controller\ViewDataTrait;
use Cawa\Date\DateTime;
use Cawa\Renderer\ContainerTrait;
use Cawa\Renderer\HtmlElement;
use Cawa\Renderer\PhtmlHtmlElement;

/**
 * @see http://bootsnipp.com/snippets/featured/single-column-responsive-timeline
 */
class Timeline extends PhtmlHtmlElement
{
    use ContainerTrait;
    use ViewDataTrait;

    const SIZE_LG = 'cawa-timeline-lg';
    const SIZE_SM = 'cawa-timeline-sm';

    /**
     * @param string|null $size
     */
    public function __construct(string $size = null)
    {
        parent::__construct('<div>');
        $this->addClass('cawa-timeline');

        if ($size) {
            $this->addClass($size);
        }
    }

    private $sortDesc = true;

    /**
     * @return bool
     */
    public function isSortDesc() : bool
    {
        return $this->sortDesc;
    }

    /**
     * @param bool $sortDesc
     *
     * @return Timeline
     */
    public function setSortDesc(bool $sortDesc) : Timeline
    {
        $this->sortDesc = $sortDesc;

        return $this;
    }

    /**
     * @param bool $enabled
     *
     * @return $this|self
     */
    public function setTopRound(bool $enabled) : self
    {
        if ($enabled) {
            $this->removeClass('no-top-round');
        } else {
            $this->addClass('no-top-round');
        }

        return $this;
    }

    /**
     * @param bool $enabled
     *
     * @return $this|self
     */
    public function setBottomRound(bool $enabled) : self
    {
        if ($enabled) {
            $this->removeClass('no-bottom-round');
        } else {
            $this->addClass('no-bottom-round');
        }

        return $this;
    }

    /**
     * @return string
     */
    public function render()
    {
        usort($this->elements, function (Panel $a, Panel $b) {
            return $a->getDate()->getTimestamp() == $b->getDate()->getTimestamp() ? 0 :
                ($a->getDate()->getTimestamp() > $b->getDate()->getTimestamp() ? 1 : -1);
        });

        if ($this->sortDesc) {
            $this->elements = array_reverse($this->elements);
        }

        $content = '';
        $previousDate = null;

        /** @var Panel $element */
        foreach ($this->elements as $element) {
            if (is_null($previousDate) || !$element->getDate()->isSameDay($previousDate)) {
                $content .= (new HtmlElement('<div>'))
                    ->addClass('date')
                    ->setContent($element->getDate()->display([DateTime::DISPLAY_SHORT]))
                    ->render();
            }

            $previousDate = $element->getDate();

            $content .= $element->render();
        }

        $this->data['content'] = $content;

        return parent::render();
    }
}
