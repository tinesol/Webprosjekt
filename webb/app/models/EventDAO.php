<?php

namespace Webb\App\Models;

class EventDao extends Dao
{

    public function select($sql, $params)
    {
        $rows = $this->db->run($sql, $params)->fetchAll();
        $rowCount = count($rows);
        if ($rowCount > 0) {
            for ($i = 0; $i < $rowCount; $i++) {
                $event[$i] = new Event($rows[$i]);
            }
        }
        return $event;
    }

    public function getById($id)
    {
        $sql = 'SELECT `id`, `name`, `event_date`, `event_time`, `age_limit`,'
            . ' `price`, `decription`, `organizer_id`'
            . ' FROM `Event`'
            . ' WHERE `id` = :id';
        $params = array(
            ':id' => $id
        );
        return $this->select($sql, $params);
    }

    public function getAll()
    {
        $sql = 'SELECT `id`, `name`, `event_date`, `event_time`, `age_limit`,'
            . ' `price`, `decription`, `organizer_id`'
            . ' FROM `Event`';
        $params = array();
        return $this->select($sql, $params);
    }

    public function insert($event)
    {
        $sql = 'INSERT INTO `Event`'
            . ' (`name`, `event_date`, `event_time`, `age_limit`, `price`'
            . ', `decription`, `organizer_id`)'
            . ' VALUES(:name, :eventDate, :eventTime, :ageLimit, :price'
            . ', :description, :organizerId)';
        $params = array(
            ':name'        => $event->getName(),
            ':eventDate'   => $event->getEventDate(),
            ':eventTime'   => $event->getEventTime(),
            ':ageLimit'    => $event->getAgeLimit(),
            ':price'       => $event->getPrice(),
            ':description' => $event->getDescription(),
            ':organizerId' => $event->getOrganizerId(),
        );

        return $this->db->run($sql, $params)->rowCount();
    }

    public function update($event)
    {
        $sql = 'UPDATE `Event`'
            . ' SET `name` = :name, `event_date` = :eventDate,'
            . ' `event_time` = :eventTime, `age_limit` = :ageLimit,'
            . ' `price` = :price, `decription` = :description,'
            . ' `organizer_id` = :organizerId'
            . ' WHERE id = :id';
        $params = array(
            ':id'          => $event->getId(),
            ':name'        => $event->getName(),
            ':eventDate'   => $event->getEventDate(),
            ':eventTime'   => $event->getEventTime(),
            ':ageLimit'    => $event->getAgeLimit(),
            ':price'       => $event->getPrice(),
            ':description' => $event->getDescription(),
            ':organizerId' => $event->getOrganizerId(),
        );

        return $this->db->run($sql, $params)->rowCount();
    }

    public function delete($event)
    {
        $sql = 'DELETE FROM `Event` WHERE id = :id';
        $params = array(
            ':id' => $event->getId(),
        );

        return $this->db->run($sql, $params)->rowCount();
    }

}
