<?php

class C_Tasks extends Controller
{
    public $model;
    public $view;

    public function __construct()
    {
        parent::__construct();
        $this->model = new M_Tasks();
    }

    public function index()
    {
        $cur_page = 1;
        $per_page = 3;
        if (isset($_GET['page']) && $_GET['page'] > 0)
        {
            $cur_page = $_GET['page'];
        }
        $start = ($cur_page - 1) * $per_page;

        $data['sortField'] = "id";
        $data['up'] = 1;
        if (isset($_GET['sortField']) && in_array($_GET['sortField'], ['id', 'name', 'email', 'ready'])) {
            $data['sortField'] = $_GET['sortField'];
        }
        if (isset($_GET['direction']) && in_array($_GET['direction'], ['1', '0'])) {
            $data['up'] = (int)$_GET['direction'];
        }

        $data['items'] = $this->model->getAll($start . ',' . $per_page, $data['sortField'], $data['up']);

        $num_pages = ceil($this->model->getCount() / $per_page);

        $data['num_pages'] = $num_pages;
        $data['page'] = $cur_page;

        $data['login_status'] = $this->isGranted() ? 'granted' : '';
        $data['url'] = $this->getCurrentUrl();

        $this->view->generate('tasks', $data);
    }

    public function add()
    {
        $data['add_status'] = '';
        $data['errors'] = [];

        if (isset($_POST['addTask'])) {
            if (strlen(trim($_POST['name'])) == 0) {
                $data['errors'][] = 'Поле имя должно быть заполнено!';
            }
            if (strlen(trim($_POST['email'])) == 0) {
                $data['errors'][] = 'Поле E-mail должно быть заполнено!';
            } elseif (!preg_match ('/[\.a-z0-9_\-]+[@][a-z0-9_\-]+([.][a-z0-9_\-]+)+[a-z]{1,4}/i', $_POST['email'])) {
                $data['errors'][] = 'Введено не валидное значение для E-mail!';
            }
            if (strlen(trim($_POST['task'])) == 0) {
                $data['errors'][] = 'Поле текст должно быть заполнено!';
            }

            if (empty($data['errors'])) {
                $data = [
                    'name' => $_POST['name'],
                    'email' => $_POST['email'],
                    'task' => $_POST['task'],
                ];
                $this->model->insert($data);

                $data['add_status'] = 'success';
            } else {
                $data['add_status'] = 'error';
            }
        }

        $this->view->generate('add_task', $data);
    }

    public function edit()
    {
        if (!$this->isGranted()) {
            header('Location:/user/index/');
        }

        $data['edit_status'] = '';
        $data['errors'] = [];

        $urlParams = explode('/', $_SERVER['REQUEST_URI']);
        if (
            !isset($urlParams[3])
            || !$data = $this->model->getElementOnField('id', $urlParams[3])
        ) {
            header('Location:/tasks/');
        }


        if (isset($_POST['editTask'])) {
            $data['ready'] = $_POST['ready'];

            if (strlen(trim($_POST['task'])) == 0) {
                $data['errors'][] = 'Поле текст должно быть заполнено!';
            }
            if ($data['task'] != $_POST['task']) {
                $data['task'] = $_POST['task'];
                $data['updateAdmin'] = true;
            }

            if (
                empty($data['errors'])
                && $this->isGranted()
            ) {
                $this->model->update($data, "id='". $urlParams[3] ."'");
                $data['edit_status'] = 'success';
            } else {
                $data['edit_status'] = 'error';
            }
        }

        $this->view->generate('edit_task', $data);
    }
}