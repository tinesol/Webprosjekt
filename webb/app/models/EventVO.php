<?php

namespace Webb\App\Models;

class EventVO
{
    protected $id;
    protected $eventDate;
    protected $eventTime;
    protected $locationId;
    protected $ageLimit;
    protected $price;
    protected $description;
    protected $organizerId;

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setEventDate($eventDate)
    {
        $this->eventDate = $eventDate;
    }

    public function getEventdate()
    {
        return $this->eventDate;
    }

    public function setEventTime($eventTime)
    {
        $this->eventTime = $eventTime;
    }

    public function getEventTime()
    {
        return $this->eventTime;
    }

    public function setLocationId($locationId)
    {
        $this->locationId = $locationId;
    }

    public function getLocationId()
    {
        return $this->locationId;
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

    public function setOrganizerId($organizerId)
    {
        $this->organizerId = $organizerId;
    }

    public function getOrganizerId()
    {
        return $this->organizerId;
    }

}

