<?php

namespace Webb\App\Models;

class Db
{
    /**
     * @var array The default driver settings
     */
    private static $settings = array(
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8",
        PDO::ATTR_EMULATE_PREPARES => false,
    );
    /**
     * @var PDO A database connection
     */
    private static $connection;

    /**
     * Connects to the database using given credentials
     * @param string $host Host name
     * @param string $user Username
     * @param string $password Password
     * @param string $database Database name
     */
    public static function connect($host, $user, $password, $database) {
        if (!isset(self::$connection)) {
            self::$connection = @new PDO(
                "mysql:host=$host;dbname=$database",
                $user,
                $password,
                self::$settings
            );
        }
    }

    /**
     * Executes a query and returns the first row of the result
     * @param string $query The query
     * @param array $params Parameters to be passed into the query
     * @return mixed An associative array representing the row or false in no data returned
     */
    public static function queryOne($query, $params = array())
    {
        $result = self::$connection->prepare($query);
        $result->execute($params);
        return $result->fetch();
    }

    /**
     * Executes a query and returns all resulting rows as an array of associative arrays
     * @param string $query The query
     * @param array $params Parameters to be passed into the query
     * @return mixed An array of associative arrays or false in no data returned
     */
    public static function queryAll($query, $params = array())
    {
        $result = self::$connection->prepare($query);
        $result->execute($params);
        return $result->fetchAll();
    }

    /**
     * Executes a query and returns the first value of the first row of the result
     * @param string $query The query
     * @param array $params Parameters to be passed into the query
     * @return mixed The first value of the first row or false if no data returned
     */
    public static function querySingle($query, $params = array())
    {
        $result = self::queryOne($query, $params);
        if (!$result)
            return false;
        return $result[0];
    }

    /**
     * Executes a query and returns the number of affected rows
     * @param string $query The query
     * @param array $params Parameters to be passed into the query
     * @return int The number of affected rows
     */
    public static function query($query, $params = array())
    {
        $result = self::$connection->prepare($query);
        $result->execute($params);
        return $result->rowCount();
    }

}