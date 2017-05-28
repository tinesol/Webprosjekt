<?php

namespace Webb\App\Controllers;

class EventController extends Controller
{
    protected $db;

    public function process($params, $db, $action = null)
    {
        $this->db = $db;

        // The URL for displaying an event is entered
        if ($action != '') {
            call_user_func(array(get_class($this), $action), $params);
        } else {
            // No URL entered so we list all events
            $this->index();
        }
    }

    public function getById($params)
    {
        // Creating a DAO instance which allows us to access events and tags
        $eventDao = new \Webb\App\Models\EventDao($this->db,
            \Webb\App\Models\EventVo::class);

        // Retrieving an event by the URL
        $event = $eventDao->getById($params[0]);

        // If no event was found we redirect to the ErrorController
        if (!$event) {
            $this->redirect('error');
        }

        // HTML head
        $this->head = array(
            'title' => $event->getName(),
        );

        // Setting template variables
        $this->data['event'] = $event;

        // Setting the template
        $this->view = 'event';
    }

    public function index()
    {
        // Creating DAO instance which allows us to access events and tags
        $eventDao = new \Webb\App\Models\EventDao($this->db,
            \Webb\App\Models\EventVo::class);
        $tagDao = new \Webb\App\Models\TagDao($this->db,
            \Webb\App\Models\TagVo::class);

        $this->head = array(
            'title' => 'Arrangementer',
        );
        $this->data['events'] = $eventDao->getCurrent();
        $this->view = 'events';
        $this->data['options'] = $this->getOptions($tagDao, $eventDao);
    }

    public function filterBy($params = null)
    {
        // Creating a DAO instance which allows us to access events and tags
        $eventDao = new \Webb\App\Models\EventDao($this->db,
            \Webb\App\Models\EventVo::class);
        $tagDao = new \Webb\App\Models\TagDao($this->db,
            \Webb\App\Models\TagVo::class);

        // Retrieving events, filter by selection
        $events = $eventDao->getSelection($params);

        // If no event was found we redirect to the ErrorController
        if (!$events) {
            $this->redirect('error');
        }


        // Setting template variables
        $this->data['events'] = $events;
        if (isset($params['id'])) {
            // HTML head
            $this->head = array(
                'title' => $events[0]->getName(),
            );
            $this->view = 'event';
        } else {
            // HTML head
            $this->head = array(
                'title' => 'Arrangementer',
            );
            $this->view = 'events';
        }
        $this->data['options'] = $this->getOptions($tagDao, $eventDao);

        // Setting the template
    }

    public function getOptions($tagDao, $eventDao)
    {
        $options = array();
        // Get options for select box
        $options['tags'] = $tagDao->getNames();
        $options['dates'] = $eventDao->getDates(date('Y-m-d'));
        $options['prices'] = $eventDao->getPrices(date('Y-m-d'));
        return $options;
    }

}
