<?php
/**
 * Created by PhpStorm.
 * User: jesusslim
 * Date: 2017/10/26
 * Time: 下午2:55
 */

namespace sroute\src;


use sroute\src\exception\RouteException;

class Routes
{

    protected $routes;

    public function __construct()
    {
        $methods = ['GET','POST','PUT','PATCH','DELETE','HEAD','OPTIONS'];
        $this->routes = array_fill_keys($methods,[]);
    }

    /**
     * @param $uri
     * @param $handler
     * @param $methods
     * @param string $prefix
     * @return $this
     */
    public function addRoute($uri,$handler,$methods,$prefix = ''){
        $uri = trim($uri);
        if ($uri{0} !== '/') $uri = '/'.$uri;
        $prefix = trim($prefix);
        if (!empty($prefix) && $prefix{0} !== '/') $prefix = '/'.$prefix;
        $route = new Route($uri,$handler,$methods,$prefix);
        foreach ($methods as $method){
            if (isset($this->routes[$method])){
                $this->routes[$method][$uri] = $route;
            }
        }
        return $this;
    }

    /**
     * @param $uri
     * @param $handler
     * @param string $prefix
     * @return Routes
     */
    public function get($uri,$handler,$prefix = ''){
        return $this->addRoute($uri,$handler,['GET'],$prefix);
    }

    /**
     * @param $uri
     * @param $handler
     * @param string $prefix
     * @return Routes
     */
    public function post($uri,$handler,$prefix = ''){
        return $this->addRoute($uri,$handler,['POST'],$prefix);
    }

    /**
     * @param $uri
     * @param $handler
     * @param string $prefix
     * @return Routes
     */
    public function put($uri,$handler,$prefix = ''){
        return $this->addRoute($uri,$handler,['PUT'],$prefix);
    }

    /**
     * @param $uri
     * @param $handler
     * @param string $prefix
     * @return Routes
     */
    public function patch($uri,$handler,$prefix = ''){
        return $this->addRoute($uri,$handler,['PATCH'],$prefix);
    }

    /**
     * @param $uri
     * @param $handler
     * @param string $prefix
     * @return Routes
     */
    public function delete($uri,$handler,$prefix = ''){
        return $this->addRoute($uri,$handler,['DELETE'],$prefix);
    }

    /**
     * @param $uri
     * @param $handler
     * @param string $prefix
     * @return Routes
     */
    public function head($uri,$handler,$prefix = ''){
        return $this->addRoute($uri,$handler,['HEAD'],$prefix);
    }

    /**
     * @param $uri
     * @param $handler
     * @param string $prefix
     * @return Routes
     */
    public function options($uri,$handler,$prefix = ''){
        return $this->addRoute($uri,$handler,['OPTIONS'],$prefix);
    }

    /**
     * @param $method
     * @param $uri
     * @param bool $enable_prefix
     * @return Route
     * @throws RouteException
     */
    public function match($method,$uri,$enable_prefix = true){
        $uri = rawurldecode($uri);
        if (isset($this->routes[$method][$uri])){
            return $this->routes[$method][$uri];
        }
        if ($enable_prefix) {
            $routes = $this->routes[$method];
            foreach ($routes as $route){
                /* @var \sroute\src\Route $route */
                $prefix = $route->getPrefix();
                if (!empty($prefix) && strpos($uri,$prefix) === 0){
                    return $route;
                }
            }
        }
        throw new RouteException(sprintf('Route not found:[%s]%s',$method,$uri));
    }

    /**
     * @param $method
     * @param $uri
     * @param bool $enable_prefix
     * @return mixed
     */
    public function handler($method,$uri,$enable_prefix = true){
        $route = $this->match($method,$uri,$enable_prefix);
        return $route->getHandler();
    }
}