<?php

namespace Webb\App\Models;

class EventVo extends Vo
{
    protected $id;
    protected $name;
    protected $date;
    protected $time;
    protected $location;
    protected $ageLimit;
    protected $price;
    protected $description;
    protected $organizer;

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setDate($date)
    {
        $this->date = $date;
    }

    public function getDate()
    {
        return $this->date;
    }

    public function setTime($time)
    {
        $this->time = $time;
    }

    public function getTime()
    {
        return $this->time;
    }

    public function setLocation($location)
    {
        $this->location = $location;
    }

    public function getLocation()
    {
        return $this->location;
    }

    public function setAgeLimit($ageLimit)
    {
        $this->ageLimit = $ageLimit;
    }

    public function getAgeLimit()
    {
        return $this->agelimit;
    }

    public function setPrice($price)
    {
        $this->price = $price;
    }

    public function getPrice()
    {
        return $this->price;
    }

    public function setDescription($description)
    {
        $this->description = $description;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function setOrganizer($organizer)
    {
        $this->organizer = $organizer;
    }

    public function getOrganizer()
    {
        return $this->organizer;
    }

}
