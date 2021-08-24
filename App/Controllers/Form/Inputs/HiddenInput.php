<?php
namespace App\Controllers\Form\Inputs;

use App\Controllers\Form\BaseInput;

class HiddenInput extends BaseInput {

    public function renderInput(): string {
        return sprintf( '<input type="hidden" name="%s" value="%s"> ', $this->name, $this->value );
    }

}