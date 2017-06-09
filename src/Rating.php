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

namespace Cawa\Widget;

use Cawa\Controller\ViewDataTrait;
use Cawa\Renderer\Phtml;
use Cawa\Renderer\WidgetOption;

class Rating extends Phtml
{
    use ViewDataTrait;

    /**
     * @var WidgetOption
     */
    private $widgetOptions;

    /**
     * @param int $note
     * @param int $count
     * @param bool $readOnly
     */
    public function __construct(int $note, int $count = 5, bool $readOnly = true)
    {
        $this->widgetOptions = new WidgetOption();

        $this->data['note'] = $note;
        $this->data['count'] = $count;
        $this->data['readOnly'] = $readOnly;
    }

    /**
     * @return int
     */
    public function getNote() : int
    {
        return $this->data['note'];
    }

    /**
     * @param int $note
     *
     * @return $this|self
     */
    public function setNote(int $note) : self
    {
        $this->data['note'] = $note;

        return $this;
    }

    /**
     * @return bool
     */
    public function isReadOnly() : bool
    {
        return $this->data['readOnly'];
    }

    /**
     * @param bool $readOnly
     *
     * @return $this|self
     */
    public function setReadOnly(bool $readOnly) : self
    {
        $this->data['readOnly'] = $readOnly;

        return $this;
    }

    /**
     */
    public function getUrl()
    {
        return $this->widgetOptions->getData()['ajax']['url'] ?? null;
    }

    /**
     * @param string $url
     *
     * @return $this|self
     */
    public function setUrl(string $url) : self
    {
        $this->widgetOptions->addData('ajax', ['url' => $url]);

        return $this;
    }

    /**
     */
    public function getMethod()
    {
        return $this->widgetOptions->getData()['ajax']['type'] ?? null;
    }

    /**
     * @param string $method
     *
     * @return $this|self
     */
    public function setMethod(string $method) : self
    {
        $this->widgetOptions->addData('ajax', ['type' => $method]);

        return $this;
    }

    /**
     */
    public function getQuery()
    {
        return $this->widgetOptions->getData()['query'] ?? null;
    }

    /**
     * @param string $query
     *
     * @return $this|self
     */
    public function setQuery(string $query) : self
    {
        $this->widgetOptions->addData('query', $query);

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function render()
    {
        $this->data['widgetOptions'] = $this->widgetOptions->count() ? $this->widgetOptions->render() : null;

        return parent::render();
    }
}
