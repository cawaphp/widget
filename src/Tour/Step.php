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

class Step implements \JsonSerializable
{
    /**
     * @param string $name
     * @param string $text
     * @param string $attachTo
     */
    public function __construct(string $name, string $text, string $attachTo)
    {
        $this->name = $name;
        $this->text = $text;
        $this->attachTo = $attachTo;
    }

    /**
     * @var string
     */
    private $name;

    /**
     * @return string
     */
    public function getName() : string
    {
        return $this->name;
    }

    /**
     * @param string $name
     *
     * @return Step
     */
    public function setName(string $name) : Step
    {
        $this->name = $name;

        return $this;
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
     * @return Step
     */
    public function setText(string $text) : Step
    {
        $this->text = $text;

        return $this;
    }

    /**
     * @var string
     */
    private $title;

    /**
     * @return string
     */
    public function getTitle() : string
    {
        return $this->title;
    }

    /**
     * @param string $title
     *
     * @return Step
     */
    public function setTitle(string $title) : Step
    {
        $this->title = $title;

        return $this;
    }

    /**
     * @var string
     */
    private $attachTo;

    /**
     * @return string
     */
    public function getAttachTo() : string
    {
        return $this->attachTo;
    }

    /**
     * @param string $attachTo
     *
     * @return Step
     */
    public function setAttachTo(string $attachTo) : Step
    {
        $this->attachTo = $attachTo;

        return $this;
    }

    /**
     * @var string
     */
    private $advanceOn;

    /**
     * @return string
     */
    public function getAdvanceOn() : string
    {
        return $this->advanceOn;
    }

    /**
     * @param string $advanceOn
     *
     * @return Step
     */
    public function setAdvanceOn(string $advanceOn) : Step
    {
        $this->advanceOn = $advanceOn;

        return $this;
    }

    /**
     * @var array
     */
    private $buttons;

    /**
     * @return array
     */
    public function getButtons() : array
    {
        return $this->buttons;
    }

    /**
     * @param array $buttons
     *
     * @return Step
     */
    public function addButtons(array $buttons) : Step
    {
        $this->buttons[] = $buttons;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function jsonSerialize()
    {
        $return = get_object_vars($this);
        unset($return['name']);

        if (sizeof($return['buttons']) == 0) {
            unset($return['buttons']);
        }

        return $return;
    }
}
