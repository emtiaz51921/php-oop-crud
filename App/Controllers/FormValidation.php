<?php
namespace App\Controllers;
/**
 * Form validation class
 */

class FormValidation {

    /**
     * Form inputs
     *
     * @var array
     */
    public array $inputs = [];

    /**
     * Handle all errors
     *
     * @var array
     */
    public array $errors = [];

    /**
     * Constructor
     *
     * @param array $inputs
     */
    public function __construct( array $inputs ) {
        $this->inputs = $inputs;
    }

    /**
     * Validate for empty form field
     *
     * @return void
     */
    public function validateMandatory() {

        foreach ( $this->inputs as $key => $input ) {

            if ( empty( $input ) ) {
                $this->errors[$key] = 'This field is mandatory.';
            }

        }

    }

    /**
     * Get form erros if available
     *
     * @return void
     */
    public function getFormErrors() {

        $this->validateMandatory();

        return $this->errors;
    }

}