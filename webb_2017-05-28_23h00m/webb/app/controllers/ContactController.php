<?php

namespace Webb\App\Controllers;

class ContactController extends Controller
{

    public function process($params, $db, $action = null)
    {
        // If param contains action
        if ($action != '') {
            call_user_func_array(array(get_class($this), $action), $params);
        } else {
            // HTML head
            $this->head = array(
                'title' => 'Kontakt oss',
            );
            $this->view = 'contact';
        }
    }

    public function sendEmail($param = null)
    {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $message = $_POST['message'];
        $from = "From: $email";
        $to = 'post@byntl.com';
        $subject = 'Message from contact form';
        $body = "From: $name\n Email: $email\n Message:\n $message";

        if (isset($_POST['submit'])) {
            if (mail($to, $subject, $body, $from)) {
                $this->data['response'] = 'Meldingen ble sendt! Vi vil svare deg så fort vi kan.';
            } else {
                $this->data['response'] = 'Meldingen ble ikke sendt. Vennligst prøv igjen senere.';
            }
        }

        $this->head = array(
            'title' => 'Kontakt oss',
        );
        $this->view = 'contact';
    }

}
