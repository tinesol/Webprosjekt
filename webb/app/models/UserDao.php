<?php

namespace Webb\App\Models;

class UserDao extends Dao
{

    public function select($sql, $params)
    {
        $rows = $this->db->run($sql, $params)->fetchAll();
        $rowCount = count($rows);
        if ($rowCount > 0) {
            for ($i = 0; $i < $rowCount; $i++) {
                $user[$i] = new User($rows[$i]);
            }
        }
        return $user;
    }

    public function getByUsername($username)
    {
        $sql = 'SELECT `username`, `password`, `email`, `user_type`'
            . ' FROM `Event`'
            . ' WHERE `username` = :username';
        $params = array(
            ':username' => $username,
        );

        return $this->select($sql, $params);
    }

    public function insert($user)
    {
        $sql = 'INSERT INTO `User`'
            . ' (`username`, `password`, `email`, `user_type`)'
            . ' VALUES(:username, :password, :email, :userType)';
        $params = array(
            ':username' => $user->getUsername(),
            ':password' => $user->getPassword(),
            ':email'    => $user->getEmail(),
            ':userType' => $user->getUserType(),
        );

        return $this->db->run($sql, $params)->rowCount();
    }

    public function update($user)
    {
        $sql = 'UPDATE `User`'
            . ' SET `password` = :password, `email` = :email'
            . ' WHERE `username` = :username';
        $params = array(
            ':username' => $user->getUsername(),
            ':password' => $user->getPassword(),
            ':email'    => $user->getEmail(),
        );

        return $this->db->run($sql, $params)->rowCount();
    }

    public function delete($user)
    {
        $sql = 'DELETE FROM `User` WHERE username = :username';
        $params = array(
            ':username' => $user->getUsername(),
        );

        return $this->db->run($sql, $params)->rowCount();
    }

}
