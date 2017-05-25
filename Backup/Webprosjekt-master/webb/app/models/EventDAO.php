<?php

Namespace Webb\App\Models;

class EventDAO
{

    public function getEvents()
    {
        $sql = "SELECT * FROM `Event`";
        retyrb $this->execute($sql);
    }


}