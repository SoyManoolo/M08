<?php

class DatabaseController {

    private static $host = "localhost";
    private static $username = "usuario";
    private static $password = "password";
    private static $dbname = "users";

    private static $options = array(
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"
    );

    public static function connect() {
        try {
            return new PDO(
                'mysql:host=' . self::$host . ';dbname=' . self::$dbname,
                self::$username,
                self::$password,
                self::$options
            );
        } catch (PDOException $error) {
            echo "Database connection failed: " . $error->getMessage();
            return null;
        }
    }
}
