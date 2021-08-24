<?php
namespace App\Controllers\Form\Inputs;

use App\Controllers\Form\HtmlElement;

/**
 * Button class
 */

class Button extends HtmlElement {

    public string $buttonValue = 'Submit';

    public function __construct( string $buttonValue ) {
        $this->buttonValue = $buttonValue;
    }

    /**
     * Render button
     *
     * @return string
     */
    public function render(): string {
        return sprintf( '<input class="button-primary" type="submit" value="%s">', $this->buttonValue );
    }
}