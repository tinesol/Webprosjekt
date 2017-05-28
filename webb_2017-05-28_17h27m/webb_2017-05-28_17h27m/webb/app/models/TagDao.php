<?php

namespace Webb\App\Models;

class TagDao extends Dao
{

    public function getByName($name)
    {
        $sql = 'SELECT `name`, `description`, `image_path` as imagePath'
            . ' FROM `tag`'
            . ' WHERE `name` = :name';
        return parent::select($sql, \PDO::FETCH_CLASS, [':name' => $name]);
    }

    public function getAll()
    {
        $sql = 'SELECT `name`, `description`, `image_path` as imagePath'
            . ' FROM `tag`';
        return parent::select($sql, \PDO::FETCH_CLASS);
    }

    public function getNames()
    {
        // Get all tag names
        $sql = 'SELECT `name`'
            . ' FROM `tag`';

        return parent::select($sql, \PDO::FETCH_COLUMN);
    }

    public function insert($tagVo)
    {
        $sql = 'INSERT INTO `tag` (`name`, `description`, `image_path`)'
            . ' VALUES(:name, :description, :imagePath)';
        return $this->db->run($sql, (array) $tagVo)->rowCount();
    }

    public function update($tagVo)
    {
        $sql = 'UPDATE `tag`'
            . ' SET `description` = :description, image_path = :imagePath'
            . ' WHERE `name` = :name';
        return $this->db->run($sql, (array) $tagVo)->rowCount();
    }

    public function delete($tagVo)
    {
        $sql = 'DELETE FROM `tag` WHERE `name` = :name';
        return $this->db->run($sql, (array) $tagVo)->rowCount();
    }

}
