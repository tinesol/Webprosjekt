<?php

namespace Webb\App\Controllers;

class HomeController extends Controller
{

    public function process($params, $db, $action = null)
    {
        // Creating a DAO instance which allows us to access tags
        $tagDao = new \Webb\App\Models\TagDao($db, \Webb\App\Models\TagVo::class);

        // HTML head
        $this->head = array(
            'title' => 'Forside',
        );

        // List all tags
        $this->data['tags'] = $tagDao->getAll();
        $this->view = 'home';
    }

}
