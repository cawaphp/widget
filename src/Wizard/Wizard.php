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

namespace Cawa\Widget\Wizard;

use Cawa\Controller\ViewDataTrait;
use Cawa\Renderer\PhtmlContainer;

class Wizard extends PhtmlContainer
{
    use ViewDataTrait;

    public function __construct()
    {
        $this->data['current'] = 1;
        $this->data['forward'] = false;
        $this->data['backward'] = true;
    }

    /**
     * @param int $step
     *
     * @return $this|self
     */
    public function setCurrent(int $step) : self
    {
        $this->data['current'] = $step;

        return $this;
    }

    /**
     * @param bool $enabled
     *
     * @return $this|self
     */
    public function setBackward(bool $enabled) : self
    {
        $this->data['backward'] = $enabled;

        return $this;
    }

    /**
     * @param bool $enabled
     *
     * @return $this|self
     */
    public function setForward(bool $enabled) : self
    {
        $this->data['forward'] = $enabled;

        return $this;
    }

    /**
     * @param string $name
     * @param string $url
     *
     * @return $this|self
     */
    public function addStep(string $name, string $url = null) : self
    {
        $this->data['steps'][] = [
            'name' => $name,
            'url' => $url,
        ];

        return $this;
    }
}
