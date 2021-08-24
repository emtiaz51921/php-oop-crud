<?php
namespace App\Controllers\Form\Inputs;

use App\Controllers\Form\BaseInput;

/**
 * Class SelectInput
 */

class SelectInput extends BaseInput {

    /**
     * Render individual options
     *
     * @param [type] $option
     * @return void
     */
    public function renderSelectOptions( $option ) {

        if ( $this->selectOptionBuilder( $option ) == $this->value ) {
            $selected = 'selected';
        } else {
            $selected = '';
        }

        return sprintf( '<option value="%s" %s>%s</option>', $this->selectOptionBuilder( $option ), $selected, $option );
    }

    /**
     * Convert spaced string to lower case dashed input
     * e.g Example name will be example-name
     *
     * @param string $option
     * @return string
     */
    public function selectOptionBuilder( $option ) {
        return strtolower( str_replace( ' ', '-', $option ) );
    }

    /**
     * Render the html select type
     *
     * @return string
     */
    public function renderInput(): string {

        return sprintf( '<select name="%s">%s</select>', $this->name, implode( PHP_EOL, array_map( array( $this, 'renderSelectOptions' ), $this->elements ) ) );
    }

}