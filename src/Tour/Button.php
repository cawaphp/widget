<?php

/*
 * This file is part of the Сáша framework.
 *
 * (c) tchiotludo <http://github.com/tchiotludo>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare (strict_types = 1);

namespace Cawa\Widget\Tour;

class Button implements \JsonSerializable
{
    const ACTION_NEXT = 'next';
    const ACTION_BACK = 'back';
    const ACTION_CANCEL = 'cancel';
    const ACTION_HIDE = 'hide';
    const ACTION_START = 'start';

    /**
     * @param string $text
     * @param string $action
     */
    public function __construct(string $text, string $action)
    {
        $this->text = $text;
        $this->action = $action;
    }

    /**
     * @var string
     */
    private $text;

    /**
     * @return string
     */
    public function getText() : string
    {
        return $this->text;
    }

    /**
     * @param string $text
     *
     * @return $this|self
     */
    public function setText(string $text) : self
    {
        $this->text = $text;

        return $this;
    }

    /**
     * @var string
     */
    private $action;

    /**
     * @return string
     */
    public function getAction() : string
    {
        return $this->action;
    }

    /**
     * @param string $action
     *
     * @return $this|self
     */
    public function setAction(string $action) : self
    {
        $this->action = $action;

        return $this;
    }

    /**
     * @var string
     */
    private $classes;

    /**
     * @return string
     */
    public function getClasses() : string
    {
        return $this->classes;
    }

    /**
     * @param string $classes
     *
     * @return $this|self
     */
    public function setClasses(string $classes) : self
    {
        $this->classes = $classes;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function jsonSerialize()
    {
        return get_object_vars($this);
    }
}
