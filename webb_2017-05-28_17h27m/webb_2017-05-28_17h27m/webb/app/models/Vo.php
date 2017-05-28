<?php

namespace Webb\App\Models;

abstract class Vo
{

    public function __construct($params = NULL)
    {
        if (is_array($params) || is_object($params)) {
            foreach ($params as $key => $value) {
                $this->$key = $value;
            }
        }
    }

    public function toSqlParams($vo)
    {
        foreach ($vo as $key => $value) {
            $params[":$key"] = $value;
        }
        return $params;
    }

}
