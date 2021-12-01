<?php

class Controller {

    public $model;
    public $view;

    public function __construct()
    {
        $this->view = new View();
    }

    protected function isGranted() {
        session_start();

        if (isset($_SESSION['username'])) {
            return true;
        }

        return false;
    }

    protected function getCurrentUrl() {
        return ((!empty($_SERVER['HTTPS'])) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
    }

    protected function index() {}
}