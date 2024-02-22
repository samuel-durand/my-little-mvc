<?php

namespace App\Controller;

class Renderer
{
    /**
     * Render a view with data
     *
     * @param array $data The data to pass to the view
     * @return void
     */
    function processRoute(array $match): void
    {
        $content = '';
        if (is_callable($match['target'])) {
            call_user_func_array($match['target'], $match['params']);
        } else {
            $params = $match['params'];
            ob_start();
            require_once 'public/View/' . $match['name'] . '.php';
            $content = ob_get_clean();
        }
        require 'public/View/elements/layout.php';
    }
}
