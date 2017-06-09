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

namespace Cawa\Widget\Tour;

use Cawa\Renderer\WidgetOption;
use Cawa\Session\SessionFactory;

class Tour extends WidgetOption
{
    use SessionFactory;

    /**
     * @var string
     */
    private $name;

    /**
     * @param string $name
     */
    public function __construct(string $name)
    {
        parent::__construct();
        $this->addProp('data-tour');
        $this->name = $name;
    }

    /**
     * @var bool
     */
    private $displayOnce = true;

    /**
     * @return bool
     */
    public function isDisplayOnce() : bool
    {
        return $this->displayOnce;
    }

    /**
     * @param bool $displayOnce
     *
     * @return Tour
     */
    public function setDisplayOnce(bool $displayOnce) : Tour
    {
        $this->displayOnce = $displayOnce;

        return $this;
    }

    /**
     * @param Step $step
     *
     * @return $this|self
     */
    public function addStep(Step $step) : self
    {
        $this->data['steps'][$step->getName()] = $step;

        return $this;
    }

    /**
     * @param Button $button
     *
     * @return Tour
     */
    public function addButtons(Button $button) : self
    {
        $this->data['buttons'][] = $button;

        return $this;
    }

    /**
     * @return string
     */
    public function render()
    {
        if ($this->displayOnce) {
            if (self::session()->get('TOUR_' . strtoupper($this->name))) {
                $this->setRenderable(false);
            } else {
                self::session()->set('TOUR_' . strtoupper($this->name), true);
            }
        }

        return parent::render();
    }
}
