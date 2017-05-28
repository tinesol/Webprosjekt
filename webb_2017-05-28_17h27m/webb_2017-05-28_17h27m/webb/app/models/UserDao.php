<?php

namespace Webb\App\Models;

class UserDao extends Dao
{

    public function getByUsername($username)
    {
        $sql = 'SELECT `username`, `name`, `password`, `email`, `role`'
            . ' FROM `user`'
            . ' WHERE `username` = :username';
        return parent::select($sql, \PDO::FETCH_CLASS,
                [':username' => $username]);
    }

    public function getByRole($role)
    {
        $sql = 'SELECT `username`, `name`, `password`, `email`, `role`'
            . ' FROM `user`'
            . ' WHERE `role` = :role';
        return parent::select($sql, \PDO::FETCH_CLASS, [':role' => $role]);
    }

    public function getAll()
    {
        $sql = 'SELECT `username`, `name`, `password`, `email`, `role`'
            . ' FROM `user`';
        return parent::select($sql, \PDO::FETCH_CLASS);
    }

    public function getOptions()
    {

    }

    public function insert($userVo)
    {
        $sql = 'INSERT INTO `user`'
            . ' (`username`, `name`, `password`, `email`, `role`)'
            . ' VALUES(:username, :name, :password, :email, :role)';
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
