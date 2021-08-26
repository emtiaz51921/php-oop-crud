<?php

namespace Core;

class Router {

    /**
     * Associative array of routes (the routing table)
     *
     * @var array
     */
    protected $routes = [];

    /**
     * Parameters from the matched route
     *
     * @var array
     */
    protected $params = [];

    /**
     * Add a route to the routing table
     *
     * @param string $route The route URL
     * @param array $params Parameters (controller, action)
     *
     * @return void
     */
    public function add( $route, $params = [] ) {
        // Convert the route to a regular expression: escape forward slashs
        $route = preg_replace( '/\//', '\\/', $route );

        // Convert variables e.g {controller}
        $route = preg_replace( '/\{([a-z]+)\}/', '(?P<\1>[a-z]+)', $route );

        // Convert variables with custom regular expression e.g {id:\d+}
        $route = preg_replace( '/\{([a-z]+):([^\}]+)\}/', '(?P<\1><\2>)', $route );

        // Add start and end delimiters and case insensitive flag
        $route = '/^' . $route . '$/i';

        $this->routes[$route] = $params;

    }

    /**
     * Get all the routes from the routing table
     *
     * @return array
     */
    public function getRoutes(): array{
        return $this->routes;
    }

    /**
     * Match the route to the routes in the routing table, setting the $params
     * property if the route is found
     *
     * @param string $url The route
     *
     * @return boolean true if a match found or false
     */

    public function match( $url ) {

        foreach ( $this->routes as $route => $params ) {

            if ( preg_match( $route, $url, $matches ) ) {

                foreach ( $matches as $key => $value ) {

                    if ( is_string( $key ) ) {
                        $params[$key] = $value;
                    }

                }

                $this->params = $params;

                return true;

            }

        }

        return false;

    }

    /**
     * Get the currently matched parameters
     *
     * @return array
     */
    public function getParams(): array{
        return $this->params;
    }

    /**
     * Dispatch the route, creating the controller object and runing the action method
     *
     * @param string $url The route URL
     * @return void
     */
    public function dispatch( $url ) {
        $url = $this->removeQueryStringVariable( $url );

        if ( $this->match( $url ) ) {

            $controller = $this->params['controller'];
            $controller = $this->convertToStudlyCaps( $controller );
            $controller = $this->getNamespace() . $controller;

            if ( class_exists( $controller ) ) {
                $controller_object = new $controller( $this->params );

                $action = $this->params['action'];
                $action = $this->converToCamelCase( $action );

                if ( is_callable( [$controller_object, $action] ) ) {
                    $controller_object->$action();
                } else {
                    throw new \Exception( " Method $action (in controller $controller) not found!" );
                }

            } else {
                throw new \Exception( "Controller class $controller not found!" );
            }

        } else {
            throw new \Exception( "No route matched" );
        }

    }

    /**
     * Convert the string with hypen to StudlyCaps
     * e.g post-author => PostAuthor
     *
     * @param string $string
     * @return string
     */
    public function convertToStudlyCaps( $string ): string {
        return str_replace( ' ', '', ucwords( str_replace( '-', '', $string ) ) );
    }

    /**
     * Convert the string with hypens to camelCase
     * e.g add-new = addNew
     *
     * @param string $string
     * @return string
     */
    public function converToCamelCase( $string ): string {
        return lcfirst( $this->convertToStudlyCaps( $string ) );
    }

    /**
     * Remove query string from url
     *
     * @param string  $url
     * @return string
     */
    protected function removeQueryStringVariable( $url ): string {

        if ( $url !== '' ) {
            $parts = explode( '?', $url, 2 );

            if ( strpos( $parts[0], '=' ) === false ) {
                $url = $parts[0];
            } else {
                $url = '';
            }

        }

        return $url;

    }

    /**
     * Get the namespace for the controller class. The namespace defined in the
     * route parameters is added if present
     *
     * @return string
     */
    protected function getNamespace(): string {
        $namespace = 'App\Controllers\\';

        if ( array_key_exists( 'namespace', $this->params ) ) {
            $namespace .= $this->params['namespace'] . '\\';
        }

        return $namespace;

    }

}