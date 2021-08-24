<?php
namespace Core;
/**
 * View class
 * PHP version 7.4
 */

class View {

    /**
     * Render a view file
     *
     * @param string  $view The view file
     * @return void
     */
    public static function render( $view, $args = [] ) {

        if ( $args ) {
            extract( $args, EXTR_SKIP );
        }

        //relative to core directory
        $file = "../App/Views/$view";

        if ( is_readable( $file ) ) {
            require $file;
        } else {
            throw new \Exception( $file . " not found!" );
        }

    }

}