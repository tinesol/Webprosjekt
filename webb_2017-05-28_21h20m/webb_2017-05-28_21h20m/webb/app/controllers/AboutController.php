<?php

namespace Webb\App\Controllers;

class AboutController extends Controller
{

    public function process($params, $db, $action = null)
    {
        // Creating a DAO instance which allows us to access users
        $userDao = new \Webb\App\Models\UserDao($db,
            \Webb\App\Models\UserVo::class);

        // HTML head
        $this->head = array(
            'title' => 'Om oss',
        );

        $this->view = 'about';
    }

}
