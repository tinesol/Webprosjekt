<?php

namespace Webb\App\Models;

class EventDao extends Dao
{

    public function getById($id)
    {
        $sql = 'SELECT `id`, `name`, `date`, `time`, `location`,'
            . ' `age_limit` AS ageLimit, `price`, `description`,'
            . ' `organizer`'
            . ' FROM `event`'
            . ' WHERE `id` = :id';
        return parent::select($sql, [':id' => $id]);
    }

    public function getAll()
    {
        $sql = 'SELECT `id`, `name`, `date`, `time`, `location`,'
            . ' `age_limit` AS ageLimit, `price`, `description`,'
            . ' `organizer`'
            . ' FROM `event`';
        return parent::select($sql);
    }

    public function insert($eventVo)
    {
        $sql = 'INSERT INTO `event`'
            . ' (`name`, `date`, `time`, `location`, `age_limit`, `price`'
            . ', `description`, `organizer`)'
            . ' VALUES(:name, :date, :time, :location, :ageLimit, :price'
            . ', :description, :organizer)';
        return $this->db->run($sql, $eventVo->toSqlParams())->rowCount();
    }

    public function update($eventVo)
    {
        $sql = 'UPDATE `event`'
            . ' SET `name` = :name, `date` = :date, time` = :time,'
            . ' `location` = :location, `age_limit` = :ageLimit,'
            . ' `price` = :price, `decription` = :description,'
            . ' `organizer` = :organizer'
            . ' WHERE `id` = :id';
        return $this->db->run($sql, $eventVo->toSqlParams())->rowCount();
    }

    public function delete($eventVo)
    {
        $sql = 'DELETE FROM `event` WHERE `id` = :id';
        return $this->db->run($sql, $eventVo->toSqlParams())->rowCount();
    }

}
