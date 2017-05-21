<?php

namespace Webb\App\Controllers;

class EventController extends Controller
{

    public function process($params, $db)
    {
        // Creating a DAO instance which allows us to access events
        $eventDao = new \Webb\App\Models\EventDao($db,
            \Webb\App\Models\EventVo::class);

        // The URL for displaying an event is entered
        if (!empty($params[0])) {
            // Retrieving an event by the URL
            $event = $eventDao->getById($params[0]);

            // If no event was found we redirect to the ErrorController
            if (!$event) {
                $this->redirect('error');
            }

            // HTML head
            $this->head = array(
                'title'       => $event->getName(),
                'description' => $event->getDescription(),
            );

            // Setting template variables
            $this->data['event'] = $event;

            // Setting the template
            $this->view = 'event';
        } else {
            // No URL entered so we list all events
            // HTML head
            $this->head = array(
                'title'       => 'Arrangementer',
                'description' => 'Oversikt over arrangementer',
            );
            $this->data['events'] = $eventDao->getAll();
            $this->view = 'events';
        }
    }

}
