<?php
namespace Core;
use PDO;
use PDOException;
use App\Config;

/**
 * Model core class
 */

class Model {

    protected static function getDb() {
        static $db = null;

        if ( null === $db ) {
            $db = new PDO( "mysql:host=" . Config::DB_HOST . ";dbname=" . Config::DB_NAME . "", Config::DB_USER, Config::DB_PASSWORD );
            $db->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
        }

        return $db;

    }

}