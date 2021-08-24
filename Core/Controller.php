<?php
namespace Core;
/**
 * Controller class
 *
 * PHP version 7.4
 */

abstract class Controller {

    /**
     * Parameters from the matched route
     *
     * @var array
     */
    protected $route_params = [];

    /**
     * Class construction
     * @param array $route_params Parameters from the route
     *
     */
    public function __construct( $route_params ) {
        $this->route_params = $route_params;
    }

    public function __call( $name, $arguments ) {
        $method = $name . 'Action';

        if ( method_exists( $this, $method ) ) {

            if ( $this->before() !== false ) {
                call_user_func_array( [$this, $method], $arguments );
                $this->after();
            }

        } else {
            throw new \Exception( "Method $method not found in the controller" . get_class( $this ) . "\n" );
        }

    }

}