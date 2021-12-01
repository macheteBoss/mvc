<?php

class C_User extends Controller
{
    public $model;
    public $view;

    public function __construct()
    {
        parent::__construct();
        $this->model = new M_User();
    }

    public function index()
    {
        session_start();

        $data['login_status'] = '';

        if (isset($_SESSION['username'])) {
            $data['login_status'] = 'granted';
        }

        if (isset($_POST['username']) && isset($_POST['password'])) {
            if (
                ($data = $this->model->getElementOnField('username', $_POST['username']))
                && $data['password'] == md5($_POST['password'])
            ) {
                $data['login_status'] = 'granted';

                $_SESSION['username'] = $_POST['username'];
            } else {
                $data['login_status'] = 'denied';
            }
        }

        $this->view->generate('auth', $data);
    }

    public function logout() {
        session_start();

        unset($_SESSION['username']);
        session_destroy();

        header('Location:/tasks/');
    }
}