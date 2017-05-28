<?php

namespace Webb\App\Models;

class OrganizerDao extends Dao
{

    public function getById($id)
    {
        $sql = 'SELECT `id`, `name`, `email`, `phone`'
            . ' FROM `organizer`'
            . ' WHERE `id` = :id';
        return parent::select($sql, \PDO::FETCH_CLASS, [':id' => $id]);
    }

    public function getAll()
    {
        $sql = 'SELECT `id`, `name`, `email`, `phone`'
            . ' FROM `organizer`';
        return $this->select($sql, \PDO::FETCH_CLASS);
    }

    public function getOptions()
    {
        $sql = 'SELECT `id`, `name`, `email`, `phone`'
            . ' FROM `organizer`';
        return $this->select($sql, \PDO::FETCH_CLASS);
    }

    public function insert($locationVo)
    {
        $sql = 'INSERT INTO `organizer`'
            . ' (`name`, `email`, `phone`)'
            . ' VALUES(:name, :email, :phone)';
        return $this->db->run($sql, $locationVo->toSqlParams())->rowCount();
    }

    public function update($locationVo)
    {
        $sql = 'UPDATE `organizer`'
            . ' SET `name` = :name, `email` = :email, `phone` = :phone'
            . ' WHERE id = :id';
        return $this->db->run($sql, $locationVo->toSqlParams())->rowCount();
    }

    public function delete($locationVo)
    {
        $sql = 'DELETE FROM `organizer` WHERE id = :id';
        return $this->db->run($sql, $locationVo->toSqlParams())->rowCount();
    }

}
