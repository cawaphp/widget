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

namespace Cawa\Widget\GoogleMap;

use Cawa\Core\DI;
use Cawa\Net\Uri;
use Cawa\Renderer\Container;
use Cawa\Renderer\Element;
use Cawa\Renderer\HtmlElement;
use Cawa\Renderer\WidgetOption;

class MapStatic extends HtmlElement
{
    const FORMAT_PNG8 = "png8";
    const FORMAT_PNG32 = "png32";
    const FORMAT_GIF = "gif";
    const FORMAT_JPG = "jpg";
    const FORMAT_JPGBASELINE = "jpg-baseline";

    /**
     * {@inheritdoc}
     */
    public function __construct()
    {
        parent::__construct("<img />");

        $this->queries['key'] = DI::config()->get('googlemaps/apikey');
    }

    /**
     * @var array
     */
    private $queries = [];

    /**
     * {@inheritdoc}
     */
    public function render()
    {
        if ($sign = DI::config()->getIfExists('googlemaps/secret')) {
            $binarySign = base64_decode(str_replace(['-', '_'], ['+', '/'] , $sign));
            $hmac = hash_hmac('sha1', $this->getUrl(true), $binarySign, true);
            $this->queries['signature'] = str_replace(['+', '/'],['-', '_'], base64_encode($hmac));
        }

        $this->addAttribute("src", $this->getUrl(false));

        return parent::render();
    }

    /**
     * @param bool $relative
     *
     * @return string
     */
    private function getUrl(bool $relative = true) : string
    {
        $uri = new Uri("https://maps.googleapis.com/maps/api/staticmap");
        $uri->addQueries($this->queries);
        $url = $uri->get($relative);

        // google maps expect markers=...&markers=...
        $url = preg_replace('/%5B(?:[0-9]|[1-9][0-9]+)%5D=/', '=', $url);

        return $url;
    }

    /**
     * @param float $lat
     * @param float $long
     *
     * @return $this
     */
    public function setCoordinates(float $lat, float $long) : self
    {
        $this->queries['center'] = $lat . 'x' . $long;

        return $this;
    }

    /**
     * @param int $zoom
     *
     * @return $this
     */
    public function setZoom(int $zoom) : self
    {
        $this->queries['zoom'] = $zoom;

        return $this;
    }

    /**
     * @param string $type
     *
     * @return $this
     */
    public function setMapType(string $type) : self
    {
        $this->queries['maptype'] = $type;

        return $this;
    }

    /**
     * Defines the rectangular dimensions of the map image
     *
     * @param int $width
     * @param int $height
     *
     * @return $this|MapStatic
     */
    public function setSize(int $width, int $height) : self
    {
        $this->queries['size'] = $width . "x" . $height;

        return $this;
    }

    /**
     *
     * @param int $scale
     *
     * @return $this|MapStatic
     */
    public function setScale(int $scale) : self
    {
        $this->queries['scale'] = $scale;

        return $this;
    }

    /**
     * Defines the format of the resulting image.
     *
     * By default, the Google Static Maps API creates PNG images.
     * There are several possible formats including GIF, JPEG and PNG types.
     * Which format you use depends on how you intend to present the image.
     * JPEG typically provides greater compression, while GIF and PNG provide greater detail
     *
     * @param string $format
     *
     * @return $this
     */
    public function setFormat(string $format) : self
    {
        $this->queries['format'] = $format;

        return $this;
    }

    /**
     * Defines the language to use for display of labels on map tiles.
     *
     * Note that this parameter is only supported for some country tiles;
     * if the specific language requested is not supported for the tile set,
     * then the default language for that tileset will be used.
     *
     * @param string $language
     *
     * @return $this
     */
    public function setLanguage(string $language) : self
    {
        $this->queries['language'] = $language;

        return $this;
    }

    /**
     * defines the appropriate borders to display, based on geo-political sensitivities.
     *
     * Accepts a region code specified as a two-character ccTLD ('top-level domain') value
     *
     * @param string $region
     *
     * @return $this
     */
    public function setRegion(string $region) : self
    {
        $this->queries['region'] = $region;

        return $this;
    }

    /**
     * @param Marker $marker
     *
     * @return $this
     */
    public function addMarker(Marker $marker)
    {
        if (!isset($this->queries['markers'])) {
            $this->queries['markers'] = [];
        }

        $markerQuery = [];

        if ($marker->getLabel()) {
            $markerQuery[] = "label:" . $marker->getLabel();
        }

        $markerQuery[] = $marker->getLatitude() . "," . $marker->getLongitude();

        $this->queries['markers'][] = implode("|", $markerQuery);

        return $this;
    }
}
