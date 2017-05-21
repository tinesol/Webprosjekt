<?php

namespace Webb\App\Models;

class UserDao extends Dao
{

    public function getByUsername($username)
    {
        $sql = 'SELECT `username`, `name`, `password`, `email`, `group`'
            . ' FROM `user`'
            . ' WHERE `username` = :username';
        return parent::select($sql, [':username' => $username]);
    }

    public function getByGroup($group)
    {
        $sql = 'SELECT `username`, `name`, `password`, `email`, `group`'
            . ' FROM `user`'
            . ' WHERE `group` = :group';
        return parent::select($sql, [':group' => $group]);
    }

    public function getAll()
    {
        $sql = 'SELECT `username`, `name`, `password`, `email`, `group`'
            . ' FROM `user`';
        return parent::select($sql);
    }

    public function insert($userVo)
    {
        $sql = 'INSERT INTO `user`'
            . ' (`username`, `name`, `password`, `email`, `group`)'
            . ' VALUES(:username, :name, :password, :email, :group)';
        return $this->db->run($sql, (array) $userVo)->rowCount();
    }

    public function update($userVo)
    {
        $sql = 'UPDATE `user`'
            . ' SET `name` = :name, `password` = :password, `email` = :email'
            . ' WHERE `username` = :username';
        return $this->db->run($sql, (array) $userVo)->rowCount();
    }

    public function delete($userVo)
    {
        $sql = 'DELETE FROM `user` WHERE username = :username';
        return $this->db->run($sql, (array) $userVo)->rowCount();
    }

}
