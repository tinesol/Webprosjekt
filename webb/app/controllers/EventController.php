<?php

namespace Webb\App\Controllers;

class EventController extends Controller
{

    public function process($params)
    {
        // Creating a model instance which allows us to access events
        $eventDao = new EventDao();

        // The URL for displaying event is entered
        if (!empty($params[0])) {
            // Retrieving an article by the URL
            $event = $eventDao->getById($params[0]);
            // If no event was found we redirect to the ErrorController
            if (!$event) {
                $this->redirect('error');
            }

            // HTML head
            $this->head = array(
                'title'       => $event['name'],
                'description' => $event['description'],
            );

            // Setting template variables
            $this->data['title'] = $event['title'];
            $this->data['content'] = $event['content'];

            // Setting the template
            $this->view = 'article';
        } else {
            // No URL entered so we list all articles
            $articles = $eventDao->getArticles();
            $this->data['articles'] = $articles;
            $this->view = 'articles';
        }
    }

}
