<?php

class view
{
    function generate_view($template_view, $content_view)
    {
        include 'application/views/'.$template_view;
    }
}