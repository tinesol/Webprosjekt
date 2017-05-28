<?php

namespace Webb\App\Controllers;

class AboutController extends Controller
{

    public function process($params, $db, $action = null)
    {
        // HTML head
        $this->head = array(
            'title' => 'Om oss',
        );

        $this->view = 'about';
    }

}
