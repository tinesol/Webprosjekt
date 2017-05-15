<?php

namespace Webb\App\Models;

abstract class Dao
{
    protected $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function getDb()
    {
        return $this->db;
    }

    public function setDb(PDO $db)
    {
        $this->db = $db;
    }
}
