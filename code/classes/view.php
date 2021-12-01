<?php

class View
{
    public function generate($content_view, $data = null)
    {
        $content_view .= '.php';
        include 'code/views/base.php';
    }
}