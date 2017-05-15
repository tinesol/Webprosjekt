<?php

namespace Webb\App\Models;

class LocationDao extends Dao
{

    public function select($sql, $params)
    {
        $rows = $this->db->run($sql, $params)->fetchAll();
        $rowCount = count($rows);
        if ($rowCount > 0) {
            for ($i = 0; $i < $rowCount; $i++) {
                $location[$i] = new Location($rows[$i]);
            }
        }
        return $location;
    }

    public function getById($id)
    {
        $sql = 'SELECT `id`, `address`, `zip_code`, `city`'
            . ' FROM `Location`'
            . ' WHERE `id` = :id';
        $params = array(
            ':id' => $id
        );
        return $this->select($sql, $params);
    }

    public function getAll()
    {
        $sql = 'SELECT `id`, `address`, `zip_code`, `city`'
            . ' FROM `Location`';
        $params = array();
        return $this->select($sql, $params);
    }

    public function insert($location)
    {
        $sql = 'INSERT INTO `Location`'
            . ' (`address`, `zip_code`,`city`'
            . ' VALUES(:address, :zip_code, :city)';
        $params = array(
            ':address'   => $location->getAddress(),
            ':zipCode'   => $location->getZipCode(),
            ':city'       => $location->getCity(),
        );

        return $this->db->run($sql, $params)->rowCount();
    }

    public function update($location)
    {
        $sql = 'UPDATE `Location`'
            . ' SET `address` = :address, `zip_code` = :zipCode, `city` = :city'
            . ' WHERE id = :id';
        $params = array(
            ':id'          => $location->getId(),
            ':address'   => $location->getAddress(),
            ':zip_code'   => $location->getZipCode(),
            ':city'       => $location->getCity(),
        );

        return $this->db->run($sql, $params)->rowCount();
    }

    public function delete($location)
    {
        $sql = 'DELETE FROM `Location` WHERE id = :id';
        $params = array(
            ':id' => $location->getId(),
        );

        return $this->db->run($sql, $params)->rowCount();
    }
}

