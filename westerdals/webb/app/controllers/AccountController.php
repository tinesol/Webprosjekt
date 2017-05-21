<?php

namespace Webb\App\Controllers;

class AccountController extends Controller
{

    public function process($params, $db)
    {
        // Creating a DAO instance which allows us to access users
        $userDao = new \Webb\App\Models\UserDao($db,
            \Webb\App\Models\UserVo::class);

        // HTML head
        $this->head = array(
            'title'       => 'Kontakt oss',
            'description' => 'Kontaktinformasjon og meldingsskjema',
        );

        // List all admin users
        $this->data['users'] = $userDao->getByUsername('ngaletl');
        $this->view = 'account';
    }

}
