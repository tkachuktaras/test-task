<?php

class View
{
    private $template_view = 'template_view.php';

    function generate($content_view, $template_view = null, $data = null)
    {
        if(is_array($data)) {
            extract($data);
        }

        include 'app/views/' . ($template_view ?? $this->template_view);
    }

    function generate_404()
    {
        include 'app/views/404_view.php';
    }
}