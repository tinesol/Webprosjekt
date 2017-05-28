<?php

namespace Webb\App\Models;

class EventDao extends Dao
{

    public function getById($id)
    {
        $sql = $this->getSelectStmt() . ' WHERE `event`.id = :id';
        return $this->toVo(parent::select($sql, \PDO::FETCH_ASSOC,
                    [':id' => $id]));
    }

    public function getSelection($params = null)
    {
        $queryParams = array();
        $sql = $this->getSelectStmt();
        $where = ' where';

        if (is_array($params)) {
            $and = ' ';
            foreach ($params as $key => $value) {
                switch ($key) {
                    case 'tag':
                        $where .= $and . '`event`.id in ('
                            . ' SELECT `event`'
                            . ' FROM `event_tag`'
                            . ' WHERE upper(`tag`) = upper(:tag))';

                        break;

                    case 'price':
                        $where .= "$and `event`.$key <= :$key";
                        $value = (float) $value;
                        break;

                    default:
                        $where .= "$and `event`.$key = :$key";
                        break;
                }

                $queryParams[":$key"] = $value;
                $and = ' and ';
            }
        }

        if ($where != ' where') {
            $sql .= $where;
        }

        $sql .= ' ORDER BY `event`.date';
        $rows = $this->toVo(parent::select($sql, \PDO::FETCH_ASSOC, $queryParams));
        //return $this->toVo(parent::select($sql, \PDO::FETCH_ASSOC, $queryParams));
        return $rows;
    }

    public function getAll()
    {
        $sql = $this->getSelectStmt() . ' ORDER BY `event`.date';
        return $this->toVo(parent::select($sql, \PDO::FETCH_ASSOC));
    }

    public function getCurrent()
    {
        $sql = $this->getSelectStmt() . ' WHERE `event`.date >= CURRENT_DATE'
            . ' ORDER BY `event`.date';
        return $this->toVo(parent::select($sql, \PDO::FETCH_ASSOC));
    }

    public function getDates($date = null)
    {
        // Get all event dates
        $sql = "SELECT distinct `date`"
            . ' FROM `event`';

        if (isset($date)) {
            $sql .= ' WHERE `date` >= :date';
        }

        $sql .= ' ORDER by `date`';

        return parent::select($sql, \PDO::FETCH_COLUMN, [':date' => $date]);
    }

    public function getPrices($date = null)
    {
        // Get all event prices
        $sql = 'SELECT distinct `price`'
            . ' FROM `event`';
        ;

        if (isset($date)) {
            $sql .= ' WHERE `date` >= :date';
        }

        $sql .= ' ORDER by `price`';

        return parent::select($sql, \PDO::FETCH_COLUMN, [':date' => $date]);
    }

    public function insert($eventVo)
    {
        $sql = 'INSERT INTO `event`'
            . ' (`name`, date`, `time`, `location`, `age_limit`, `price`'
            . ', `description`, `organizer`, `image_path`)'
            . ' VALUES(:name, :date, :time, :location, :ageLimit, :price'
            . ', :description, :organizer, :imagePath)';
        return $this->db->run($sql, $eventVo->toSqlParams())->rowCount();
    }

    public function update($eventVo)
    {
        $sql = 'UPDATE `event`'
            . ' SET `name` = :name, `date` = :date, time` = :time,'
            . ' `location` = :location, `age_limit` = :ageLimit,'
            . ' `price` = :price, `decription` = :description,'
            . ' `organizer` = :organizer, `image_path` = :imagePath'
            . ' WHERE `id` = :id';
        return $this->db->run($sql, $eventVo->toSqlParams())->rowCount();
    }

    public function delete($eventVo)
    {
        $sql = 'DELETE FROM `event` WHERE `id` = :id';
        return $this->db->run($sql, $eventVo->toSqlParams())->rowCount();
    }

    protected function getSelectStmt()
    {
        return 'SELECT `event`.id, `event`.name, '
            . " `event`.date, `event`.time," . ' `location`.id AS l_id, `location`.address AS l_address,'
            . ' `location`.zipcode AS l_zipcode, `location`.city AS l_city, '
            . ' `location`.location_path AS l_location_path, '
            . ' `event`.age_limit, `event`.price, `event`.description,'
            . ' `organizer`.id as o_id, `organizer`.name as o_name,'
            . ' `organizer`.email as o_email, `organizer`.phone as o_phone,'
            . ' `event`.image_path'
            . ' FROM `event`'
            . ' LEFT JOIN `location`'
            . ' ON `location`.id = `event`.location'
            . ' LEFT JOIN `organizer`'
            . ' ON `organizer`.id = `event`.organizer';
    }

    protected function toVo($rows)
    {
        $events = array();
        if (is_array($rows)) {
            foreach ($rows as $row) {
                $locationVo = new LocationVo([
                    'id'           => $row['l_id'],
                    'address'      => $row['l_address'],
                    'zipCode'      => $row['l_zipcode'],
                    'city'         => $row['l_city'],
                    'locationPath' => $row['l_location_path'],
                ]);
                $organizerVo = new OrganizerVo([
                    'id'    => $row['o_id'],
                    'name'  => $row['o_name'],
                    'email' => $row['o_email'],
                    'phone' => $row['o_phone'],
                ]);
                $eventVo = new EventVo([
                    'id'          => $row['id'],
                    'name'        => $row['name'],
                    'date'        => $row['date'],
                    'time'        => $row['time'],
                    'location'    => $locationVo,
                    'ageLimit'    => $row['age_limit'],
                    'price'       => $row['price'],
                    'description' => $row['description'],
                    'organizer'   => $organizerVo,
                    'imagePath'   => $row['image_path'],
                ]);

                array_push($events, $eventVo);
            }

            return $events;
        }
    }

}
