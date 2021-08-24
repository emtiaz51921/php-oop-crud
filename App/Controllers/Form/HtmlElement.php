<?php
namespace App\Controllers\Form;

/**
 * HTML element class
 * e.g all for classes will extend this element class
 */
abstract class HtmlElement {
    abstract public function render(): string;
}