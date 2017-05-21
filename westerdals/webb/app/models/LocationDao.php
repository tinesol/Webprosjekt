<?php

namespace Webb\App\Models;

class LocationDao extends Dao
{

    public function getById($id)
    {
        $sql = 'SELECT `id`, `address`, `zip_code` as zipCode, `city`'
            . ' FROM `location`'
            . ' WHERE `id` = :id';
        return parent::select($sql, [':id' => $id]);
    }

    public function getAll()
    {
        $sql = 'SELECT `id`, `address`, `zip_code` as zipCode, `city`'
            . ' FROM `location`';
        return $this->select($sql);
    }

    public function insert($locationVo)
    {
        $sql = 'INSERT INTO `location`'
            . ' (`address`, `zip_code`,`city`'
            . ' VALUES(:address, :zipCode, :city)';
        return $this->db->run($sql, $locationVo->toSqlParams())->rowCount();
    }

    public function update($locationVo)
    {
        $sql = 'UPDATE `location`'
            . ' SET `address` = :address, `zip_code` = :zipCode, `city` = :city'
            . ' WHERE id = :id';
        return $this->db->run($sql, $locationVo->toSqlParams())->rowCount();
    }

    public function delete($locationVo)
    {
        $sql = 'DELETE FROM `location` WHERE id = :id';
        return $this->db->run($sql, $locationVo->toSqlParams())->rowCount();
    }

}
