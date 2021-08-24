<?php
namespace App\Controllers\Form\Inputs;

use App\Controllers\Form\BaseInput;

/**
 * Number input class
 */

class NumberInput extends BaseInput {

    public function getMinValue() {
        return min( $this->elements );
    }

    public function getMaxValue() {
        return max( $this->elements );
    }

    public function renderInput(): string {
        return sprintf( '<input type="number" name="%s" min="%s" max="%s" value="%s">', $this->name, $this->getMinValue(), $this->getMaxValue(), $this->value );
    }
}