<?php

class view
{
    function generate_view($template_view, $content_view, $data = NULL, $current_page = NULL, $last_page = NULL)
    {
        include 'application/views/'.$template_view;
    }
}