<?php

/*
 * This file is part of the Сáша framework.
 *
 * (c) tchiotludo <http://github.com/tchiotludo>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare (strict_types=1);

namespace Cawa\Widget\Chart;

use Cawa\Controller\ViewController;
use Cawa\Renderer\HtmlElement;
use Cawa\Renderer\WidgetElement;
use Cawa\Widget\Chart\Options\GlobalOption;

class Chart extends ViewController implements \JsonSerializable
{
    const TYPE_LINE = 'line';
    const TYPE_BAR = 'bar';
    const TYPE_RADAR = 'radar';
    const TYPE_POLARAREA = 'polarArea';
    const TYPE_PIE = 'pie';
    const TYPE_DOUGHNUT = 'doughnut';
    const TYPE_BUBBLE = 'bubble';

    /**
     * @var WidgetElement
     */
    private $element;

    /**
     * @param string $type
     * @param Data $data
     */
    public function __construct(string $type = self::TYPE_LINE, Data $data = null)
    {
        $this->type = $type;
        $this->data = $data;
        $this->options = new Option();

        $this->element = new WidgetElement((new HtmlElement('<canvas>'))
            ->addClass('cawa-charts')
        );
    }

    /**
     * @var GlobalOption
     */
    protected $globalOptions;

    /**
     * @return GlobalOption
     */
    public function getGlobalOptions() : GlobalOption
    {
        return $this->globalOptions;
    }

    /**
     * @param GlobalOption $globalOptions
     *
     * @return Chart
     */
    public function setGlobalOptions(GlobalOption $globalOptions) : Chart
    {
        $this->globalOptions = $globalOptions;

        return $this;
    }

    /**
     * @var string
     */
    protected $type;

    /**
     * @return string
     */
    public function getType() : string
    {
        return $this->type;
    }

    /**
     * @var Data
     */
    protected $data;

    /**
     * @return Data
     */
    public function getData() : Data
    {
        return $this->data;
    }

    /**
     * @param Data $data
     *
     * @return $this|self
     */
    public function setData(Data $data) : self
    {
        $this->data = $data;

        return $this;
    }

    /**
     * @var Option
     */
    protected $options = [];

    /**
     * @return Option
     */
    public function getOptions() : Option
    {
        return $this->options;
    }

    /**
     * {@inheritdoc}
     */
    public function render()
    {
        $data = [
            'globalOptions' => $this->globalOptions,
            'plugin' => [
                'type' => $this->type,
                'data' => $this->data,
                'options' => $this->options,
            ],
        ];

        $this->element->getOptions()->setData($data);

        return $this->element->render();
    }

    /**
     * @param $array
     *
     * @return array
     */
    public static function filterRecursive($array) : array
    {
        foreach ($array as $key => $item) {
            if (is_array($item)) {
                $array[$key] = self::filterRecursive($item);
            } elseif (is_null($item)) {
                unset($array[$key]);
            }
        }

        return $array;
    }

    /**
     * {@inheritdoc}
     */
    public function jsonSerialize()
    {
        $return = get_object_vars($this);

        return self::filterRecursive($return);
    }
}
