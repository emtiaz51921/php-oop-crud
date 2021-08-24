<?php
namespace App\Controllers;

use App\Models\Students;
use Core\Controller;
use Core\View;
use App\Controllers\ValidateForm;

/**
 * Home controller
 *
 * PHP version 7.4
 */

class Home extends Controller {

    public function indexAction() {

        if ( 'POST' == $_SERVER['REQUEST_METHOD'] ) {

            Students::addNewStudent( $_POST );
        }

        if ( 'GET' == $_SERVER['REQUEST_METHOD'] ) {

            if ( isset( $_GET['action'] ) ) {

                if ( 'delete' == $_GET['action'] ) {
                    Students::deleteStudents( $_GET['id'] );
                } elseif ( 'edit' == $_GET['action'] ) {
                    $dataStudent = Students::getStudentById( $_GET['id'] );
                }

            }

        }

        $students = Students::getAllStudents();
        View::render( 'Home/index.php', [
            'students'    => $students,
            'dataStudent' => $dataStudent ?? '',
        ] );

    }

    /**
     * Before filter
     *
     * @return void
     */
    public function before() {
        //echo "(Before) \n";
        View::render( 'Layout/header.php' );
    }

    /**
     * After Filter
     *
     * @return void
     */
    public function after() {
        //echo "(After) \n";
        View::render( 'Layout/footer.php' );
    }

}