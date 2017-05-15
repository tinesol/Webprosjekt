<?php

namespace Webb\App\Models;

class Location
{
    protected $id;
    protected $address;
    protected $zipCode;
    protected $city;

    public function __construct($data = NULL)
    {
        if(is_array($data))
        {
            $this->id = $data['id'];
            $this->address = $data['address'];
            $this->zipcode = $data['zip_code'];
        }
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setAddress ($address)
    {
        $this->address = $address;
    }

    public function getAddress()
    {
        return $this->address;
    }

    public function setZipCode($zipCode)
    {
        $this->zipCode = $zipCode;
    }

    public function getZipCode()
    {
        return $this->zipCode;
    }

    public function setCity($city)
    {
        $this->city = $city;
    }

    public function getCity()
    {
        return $this->city;
    }
}

