<?php

/**
 * @file
 * Contains \Triquanta\IziTravel\DataType\Map.
 */

namespace Triquanta\IziTravel\DataType;

/**
 * Provides a map data type.
 */
class Map implements MapInterface
{

    /**
     * The bounds.
     *
     * @var string
     *   The bounds are represented as WGS:84 in the OpenLayers Bounds format -
     *   left, bottom, right, top.
     *   Example: 36.0123075,122.0978486,36.0176986,122.0911837
     */
    protected $bounds;

    /**
     * The route.
     *
     * @var string|null
     *   The route coordinates in KML format.
     */
    protected $route;

    /**
     * Creates a new instance.
     *
     * @param string $bounds
     * @param string|null $route
     */
    public function __construct($bounds, $route)
    {
        $this->bounds = $bounds;
        $this->route = $route;
    }

    /**
     * {@inheritdoc}
     */
    public static function createFromJson($json)
    {
        $data = json_decode($json);
        if (is_null($data)) {
            throw new InvalidJsonFactoryException($json);
        }
        $data = (array) $data + [
            'route' => null,
          ];
        return new static($data['bounds'], $data['route']);
    }

    /**
     * Gets the bounds.
     *
     * @return string
     *   The bounds are represented as WGS:84 in the OpenLayers Bounds format -
     *   left, bottom, right, top.
     *   Example: 36.0123075,122.0978486,36.0176986,122.0911837
     */
    public function getBounds()
    {
        return $this->bounds;
    }

    /**
     * Gets the route.
     *
     * @return string|null
     *   The route coordinates in KML format.
     */
    public function getRoute()
    {
        return $this->route;
    }

}