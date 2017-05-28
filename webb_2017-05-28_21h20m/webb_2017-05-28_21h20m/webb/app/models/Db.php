<?php

namespace Webb\App\Models;

class Db
{
    protected $db;
    private $settings = array(
        \PDO::ATTR_ERRMODE            => \PDO::ERRMODE_EXCEPTION,
        \PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
        \PDO::ATTR_EMULATE_PREPARES   => false,
        \PDO::ATTR_PERSISTENT         => true,
    );

    public function __construct($host, $user, $password, $database)
    {
        $this->db = new \PDO(
            "mysql:host=$host;dbname=$database", $user, $password,
            $this->settings
        );
    }

    public function run($sql, $params = NULL)
    {
        $stmt = $this->db->prepare($sql);
        $stmt->execute($params);
        return $stmt;
    }

}
