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

use Cawa\Widget\Chart\Datasets\AbstractDataset;

class Data implements \JsonSerializable
{
    /**
     * @var array
     */
    private static $defaultColors = [
        'rgba(54, 162, 235, {{opacity}})',
        'rgba(255, 99, 132, {{opacity}})',
        'rgba(255, 159, 64, {{opacity}})',
        'rgba(255, 205, 86, {{opacity}})',
        'rgba(75, 192, 192, {{opacity}})',
        'rgba(153, 102, 255, {{opacity}})',
        'rgba(231,233,237, {{opacity}})',
    ];

    /**
     * @return array
     */
    public static function getDefaultColors() : array
    {
        return self::$defaultColors;
    }

    /**
     * @param array $defaultColors
     */
    public static function setDefaultColors(array $defaultColors)
    {
        self::$defaultColors = $defaultColors;
    }

    /**
     * @param array $labels
     * @param array $datasets
     */
    public function __construct(array $labels = [], array $datasets = [])
    {
        $this->labels = $labels;
        $this->datasets = $datasets;
    }

    /**
     * @var string[]|string|array
     */
    protected $labels;

    /**
     * @return array|string|string[]
     */
    public function getLabels()
    {
        return $this->labels;
    }

    /**
     * @param array|string|\string[] $labels
     *
     * @return $this|self
     */
    public function setLabels($labels) : self
    {
        $this->labels = $labels;

        return $this;
    }

    /**
     * @var AbstractDataset[]
     */
    protected $datasets;

    /**
     * @return AbstractDataset[]
     */
    public function getDatasets() : array
    {
        return $this->datasets;
    }

    /**
     * @param AbstractDataset $dataset
     *
     * @return $this|self
     */
    public function addDataset(AbstractDataset $dataset) : self
    {
        if (is_null($dataset->getBackgroundColor()) && is_null($dataset->getBorderColor())) {
            $index = sizeof($this->datasets);

            $dataset->setBackgroundColor(str_replace('{{opacity}}', 0.2, self::$defaultColors[$index]))
                ->setBorderColor(str_replace('{{opacity}}', 1, self::$defaultColors[$index]))
            ;
        }

        $this->datasets[] = $dataset;

        return $this;
    }

    /**
     * @param AbstractDataset[] $datasets
     *
     * @return $this|self
     */
    public function setDatasets(array $datasets) : self
    {
        $this->datasets = $datasets;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function jsonSerialize()
    {
        $data = get_object_vars($this);
        unset($data['defaultColors']);

        return $data;
    }
}
