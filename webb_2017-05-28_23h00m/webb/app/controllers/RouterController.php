<?php

namespace Webb\App\Controllers;

class RouterController extends Controller
{
    /**
     * @var Controller The inner controller instance
     */
    protected $controller;
    protected $action = '';

    /**
     * Parses the URL address using slashes and returns params as array
     * @param string $url The URL address to be parsed
     * @return array The URL parameters
     */
    private function parseUrl($url)
    {
        // Parses URL parts into an associative array
        $query = array();
        $url = urldecode($url);
        $parsedUrl = parse_url($url);
        if (isset($parsedUrl['query'])) {
            $parsedUrl['query'] = explode('&', $parsedUrl['query']);
            foreach ($parsedUrl['query'] as $value) {
                $parm = explode('=', $value);
                if (is_array($parm)) {
                    $query[$parm[0]] = $parm[1];
                }
            }
        }
        $parsedUrl['query'] = $query;

        // Removes the leading slash
        $parsedUrl['path'] = ltrim($parsedUrl['path'], '/');
        // Removes white-spaces around the address
        $parsedUrl['path'] = trim($parsedUrl['path']);
        // Splits the address by slashes
        $parsedUrl['path'] = explode('/', $parsedUrl['path']);
        return $parsedUrl;
    }

    /**
     * Converts dashed controller name from URL into a PascalCase class name
     * @param string $text The controller name using dashes like article-list
     * @return string The class name of the controller like ArticleList
     */
    private function dashesToPascalCase($text)
    {
        $text = str_replace('-', ' ', $text);
        $text = ucwords($text);
        $text = str_replace(' ', '', $text);
        return $text;
    }

    /**
     * Converts dashed action name from URL into a camelCase function name
     * @param string $text The action name using dashes like send-email
     * @return string The function name like sendEmail
     */
    private function dashesToCamelCase($text)
    {
        return lcfirst($this->dashesToPascalCase($text));
    }

    /**
     * Parses the URL address and creates appropriate controller
     * @param array $params The URL address as an array of a single element
     */
    public function process($params, $db, $action = null)
    {
        $parsedUrl = $this->parseUrl($params[0]);

        if (empty($parsedUrl['path'][0])) {
            $this->redirect('home');
        }

        // The controller name is the 1st URL parameter
        $controllerClass = $this->dashesToPascalCase(array_shift($parsedUrl['path']))
            . 'Controller';

        if (file_exists(dirname(__FILE__) . DIRECTORY_SEPARATOR . $controllerClass . '.php')) {
            $controllerClass = __NAMESPACE__ . '\\' . $controllerClass;
            $this->controller = new $controllerClass();
        } else {
            $this->redirect('error');
        }

        // Get action from URL
        if (!empty($parsedUrl['path'][0])) {
            $this->action = $this->dashesToCamelCase(array_shift($parsedUrl['path']));
        }

        // Calls the controller
        $this->controller->process($parsedUrl['query'], $db, $this->action);

        // Setting template variables
        $this->data['title'] = $this->controller->head['title'];
        // Sets the main template
        $this->view = 'layout';
    }

}
