<?php
require_once(__DIR__ . '/studyglobe.config');

class Database {
    public static $connection;

    public static function setUpConnection() {
        global $dbconfig;

        if (!isset(self::$connection)) {
            self::$connection = new mysqli(
                $dbconfig['db_host'],
                $dbconfig['db_username'],
                $dbconfig['db_password'],
                $dbconfig['db_name'],
                $dbconfig['db_port']
            );

            if (self::$connection->connect_error) {
                die("Connection failed: " . self::$connection->connect_error);
            }
        }
    }

    public static function iud($sql, ...$params) {
        self::setUpConnection();
        
        // Prepare the SQL statement
        $stmt = self::$connection->prepare($sql);

        if ($stmt === false) {
            return false; 
        }

        if (!empty($params)) {
            $types = str_repeat('s', count($params)); 
            $stmt->bind_param($types, ...$params);
        }

        // Execute the prepared statement
        $result = $stmt->execute();
        $stmt->close();
        return $result;
    }

    public static function search($sql, ...$params) {
        self::setUpConnection();

        // Prepare the SQL statement
        $stmt = self::$connection->prepare($sql);

        if ($stmt === false) {
            return false;
        }

        if (!empty($params)) {
            // Bind parameters dynamically
            $types = str_repeat('s', count($params));
            $stmt->bind_param($types, ...$params);
        }

        // Execute the prepared statement
        $stmt->execute();
        $result_set = $stmt->get_result();
        $stmt->close();
        return $result_set;
    }
}
?>
