<?php
/**
 * Created by PhpStorm.
 * User: jesusslim
 * Date: 2017/10/26
 * Time: 下午2:43
 */

namespace sroute\src;


class Route
{

    protected $uri;
    protected $prefix;
    protected $handler;
    protected $methods;

    public function __construct($uri,$handler,$methods,$prefix = '')
    {
        $this->uri = $uri;
        $this->handler = $handler;
        $this->methods = $methods;
        $this->prefix = $prefix;
    }

    /**
     * @return string
     */
    public function getUri()
    {
        return $this->uri;
    }

    /**
     * @param string $uri
     */
    public function setUri($uri)
    {
        $this->uri = $uri;
    }

    /**
     * @return string
     */
    public function getPrefix()
    {
        return $this->prefix;
    }

    /**
     * @param string $prefix
     */
    public function setPrefix($prefix)
    {
        $this->prefix = $prefix;
    }

    /**
     * @return array
     */
    public function getMethods()
    {
        return $this->methods;
    }

    /**
     * @param array $methods
     */
    public function setMethods($methods)
    {
        $this->methods = $methods;
    }

    /**
     * @return mixed
     */
    public function getHandler()
    {
        return $this->handler;
    }

    /**
     * @param mixed $handler
     */
    public function setHandler($handler)
    {
        $this->handler = $handler;
    }
}