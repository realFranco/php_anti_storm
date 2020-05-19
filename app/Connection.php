<?php

// namespace PostgreSQLTutorial;

/**
 * Represent the Connection
 */
class Connection {

    /**
     * Connection
     * @var type 
     */
    private static $conn;
    // private $pdo;

    /**
     * Connect to the database and return an instance of \PDO object
     * @return \PDO
     * @throws \Exception
     */
    public function connect() {

        // read parameters in the ini configuration file
        $params = parse_ini_file('database.ini');
        if ($params === false) {
            throw new \Exception("Error reading database configuration file");
        }
        // connect to the postgresql database
        $conStr = sprintf("pgsql:host=%s;port=%d;dbname=%s;user=%s;password=%s", 
                $params['DB_HOST'], 
                $params['DB_PORT'], 
                $params['DB_DATABASE'], 
                $params['DB_USER'], 
                $params['DB_PASSWORD']);

        $pdo = new \PDO($conStr);
        $pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        // $this->$pdo = $pdo;

        return $pdo;
    }

    /**
     * return an instance of the Connection object
     * @return type
     */
    public static function get() {
        if (null === static::$conn) {
            static::$conn = new static();
        }

        return static::$conn;
    }
    

    protected function __construct() {
        
    }

    private function __clone() {
        
    }

    private function __wakeup() {
        
    }

}