<?php
namespace App\Models;
use PDO;
use PDOException;
use Core\Model;

/**
 * Students Model
 * e.g. fetch all syudent info
 */

class Students extends Model {

    /**
     * Get all students
     *
     * @return mixed
     */
    public static function getAllStudents() {

        try {

            $db = static::getDb();
            $stmt = $db->query( " SELECT id, name, section, roll FROM students ORDER BY id DESC" );
            $result = $stmt->fetchAll( PDO::FETCH_ASSOC );

            return $result;

        } catch ( PDOException $e ) {
            echo $e->getMessage();
        }

    }

    public static function addNewStudent( array $inputs ) {

        $db = static::getDb();

        if ( empty( $inputs['id'] ) ) {
            $stmt = $db->prepare( "INSERT INTO students (name, section, roll) VALUES(:name, :section, :roll)" );

            foreach ( $inputs as $key => $input ) {
                $stmt->bindValue( ':' . $key, $input );
            }

            $stmt->execute();

            return $stmt;

        } else {
            $stmt = $db->prepare( "UPDATE students SET name=:name, section=:section, roll=:roll WHERE id=:id" );

            foreach ( $inputs as $key => $input ) {
                $stmt->bindValue( ':' . $key, $input );
            }

            $stmt->execute();

            return $stmt;

        }

    }

    public static function deleteStudents( $id ) {

        $db = static::getDb();
        $stmt = $db->prepare( "DELETE FROM students WHERE id=:id" );
        $stmt->bindParam( ':id', $id );
        $stmt->execute();

        return $stmt;
    }

    public static function getStudentById( int $id ) {

        $db = static::getDb();
        $stmt = $db->prepare( "SELECT * FROM students WHERE id=:id LIMIT 1" );
        $stmt->bindParam( ':id', $id );
        $stmt->execute();
        $result = $stmt->fetch( PDO::FETCH_OBJ );

        return $result;
    }

}