<?php

namespace Webb\App\Models;

class TagDao extends Dao
{

    public function getByName($name)
    {
        $sql = 'SELECT `name`, `description`'
            . ' FROM `tag`'
            . ' WHERE `name` = :name';
        return parent::select($sql, [':name' => $name]);
    }

    public function getAll()
    {
        $sql = 'SELECT `name`, `description`'
            . ' FROM `tag`';
        return parent::select($sql);
    }

    public function insert($tagVo)
    {
        $sql = 'INSERT INTO `tag` (`name`, `description`)'
            . ' VALUES(:name, :description)';
        return $this->db->run($sql, (array) $tagVo)->rowCount();
    }

    public function update($tagVo)
    {
        $sql = 'UPDATE `tag`'
            . ' SET `description` = :description'
            . ' WHERE `name` = :name';
        return $this->db->run($sql, (array) $tagVo)->rowCount();
    }

    public function delete($tagVo)
    {
        $sql = 'DELETE FROM `tag` WHERE `name` = :name';
        return $this->db->run($sql, (array) $tagVo)->rowCount();
    }

}
