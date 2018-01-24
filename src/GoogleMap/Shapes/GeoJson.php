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

namespace Cawa\Widget\GoogleMap\Shapes;

class GeoJson extends AbstractShape
{
    /**
     * @return string
     */
    protected function getType() : string
    {
        return 'GeoJson';
    }

    /**
     * @param array $geoJson
     */
    public function __construct(array $geoJson)
    {
        $this->geoJson = $geoJson;
    }

    /**
     * @var array
     */
    protected $geoJson;
}
