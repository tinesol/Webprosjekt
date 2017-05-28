<?php

namespace Webb\App\Controllers;

class UserController extends Controller
{

    // må husker hvor vi var før innlogging og utlogging.
    public function login()
    {
        // HTML head
        $this->head = array(
            'title' => 'Logg inn',
        );
        $this->view = 'login';
    }

    public function logout()
    {

    }

    public function process($params, $db, $action = null)
    {
// If param contains action
        if ($action != '') {
            call_user_func_array(array(get_class($this), $action), $params);
        } else {
            // HTML head
            $this->head = array(
                'title' => 'Min side',
            );
            $this->view = 'account';
        }
    }

    public function registration($params = null)
    {
// HTML head
        $this->head = array(
            'title' => 'Registrering',
        );
        $this->view = 'registration';
    }

    public function account($params = null)
    {
// HTML head
        $this->head = array(
            'title' => 'Min side',
        );
        $this->view = 'account';
    }

}
