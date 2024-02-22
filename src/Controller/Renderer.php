<?php

namespace App\Controller;

class Renderer
{
    /**
     * Render a view with data
     *
     * @param string $view The view file to render
     * @param array $data The data to pass to the view
     * @return void
     */
    public function render(string $view, array $data = []): void
    {
        extract($data);

        ob_start();

        require $view;

        $content = ob_get_clean();

        echo $content;

    }
}
