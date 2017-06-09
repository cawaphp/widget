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

abstract class AbstractShape implements \JsonSerializable
{
    /**
     * @return string
     */
    abstract protected function getType() : string;

    /**
     * {@inheritdoc}
     */
    public function jsonSerialize()
    {
        return get_object_vars($this) + ['type' => $this->getType()];
    }
}
