<?php

namespace Webb\App\Models;

class OrganizerVo extends Vo
{
    protected $id;
    protected $name;
    protected $email;
    protected $phone;

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

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setPhone($phone)
    {
        $this->pone = $phone;
    }

    public function getPhone()
    {
        return $this->phone;
    }

}
