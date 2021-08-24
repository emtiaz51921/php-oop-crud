<?php
namespace App\Controllers\Form;
/**
 * Base form class
 *
 * PHP version 7.4
 */
class Form extends HtmlElement {

    public string $action;
    public string $method;

    /**
     * Input elements e.g text input, password, select etc
     *
     * @var array
     */
    private array $elements = [];

    /**
     * Form constructor
     *
     * @param string $action
     * @param string $method
     */
    public function __construct( string $action = '', string $method = '' ) {
        $this->action = $action;
        $this->method = $method;
    }

    /**
     * Add form input elements
     *
     * @param HtmlElement $el
     * @return void
     */
    public function addElement( HtmlElement $el ) {
        $this->elements[] = $el;
    }

    /**
     * Render the full form in front-end
     *
     * @return string
     */
    public function render(): string {
        $inputs = implode( PHP_EOL, array_map( fn( $el ) => $el->render(), $this->elements ) );

        return sprintf( "<form action='%s' method='%s'>%s</form> \n",
            $this->action, $this->method, $inputs );
    }
}