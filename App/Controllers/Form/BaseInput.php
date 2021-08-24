<?php
namespace App\Controllers\Form;
use App\Controllers\FormValidation;

/**
 * Class BaseInput
 */

abstract class BaseInput extends HtmlElement {

    public string $label;
    public string $name;
    public  ? string $value;
    public array $elements = [];

    /**
     * Base input constructor
     *
     * @param string $name
     * @param string $label
     * @param string $value
     * @param array $elements
     */
    public function __construct( string $name, string $label = '', $value = '', array $elements = [] ) {
        $this->name = $name;
        $this->label = $label;
        $this->value = $value;
        $this->elements = $elements;
    }

    abstract public function renderInput() : string;

    /**
     * Render the label & input box
     * e.g pass to Form class
     *
     * @return string
     */
    public function render(): string {
        return sprintf( '<div class="each-fields"><label>%s</label> %s </div>', $this->label, $this->renderInput() );
    }

}