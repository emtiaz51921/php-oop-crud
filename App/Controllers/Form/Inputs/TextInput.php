<?php
namespace App\Controllers\Form\Inputs;

use App\Controllers\Form\BaseInput;

/**
 * Class Text Input
 */
class TextInput extends BaseInput {

    public function renderInput(): string {
        return sprintf( '<input type="text" name="%s" value="%s"> ', $this->name, $this->value );
    }
}