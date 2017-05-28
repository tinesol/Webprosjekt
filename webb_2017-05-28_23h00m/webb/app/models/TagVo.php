<?php

namespace Webb\App\Models;

class TagVo extends Vo
{
    protected $name;
    protected $description;
    protected $imagePath;

    public function setName($name)
    {
        $this->name = $name;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setDescription($description)
    {
        $this->description = $description;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function setImagePath($imagePath)
    {
        $this->imagePath = $imagePath;
    }

    public function getImagePath()
    {
        return $this->imagePath;
    }

}
