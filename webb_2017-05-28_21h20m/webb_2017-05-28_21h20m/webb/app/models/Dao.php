<?php

namespace Webb\App\Models;

abstract class Dao
{
    protected $db;
    protected $voClassName;

    public function __construct($db, $voClassName)
    {
        $this->db = $db;
        $this->voClassName = $voClassName;
    }

    public function setDb($db)
    {
        $this->db = $db;
    }

    public function getDb()
    {
        return $this->db;
    }

    public function setVoClassName($voClassName)
    {
        $this->voClassName = $voClassName;
    }

    public function getVoClassName()
    {
        return $this->voClassName;
    }

    public function select($sql, $mode, $params = NULL)
    {
        if ($mode == \PDO::FETCH_CLASS) {
            return $this->db->run($sql, $params)->fetchAll(\PDO::FETCH_CLASS,
                    $this->voClassName);
        } else {
            return $this->db->run($sql, $params)->fetchAll($mode);
        }
    }

    public abstract function getAll();

    public abstract function insert($vo);

    public abstract function update($vo);

    public abstract function delete($vo);
}
