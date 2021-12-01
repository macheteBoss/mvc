<?if ($data['add_status'] == 'error'):?>
    <div class="alert alert-danger" role="alert">
        <?=implode("<br>", $data['errors']);?>
    </div>
<?elseif ($data['add_status'] == 'success'):?>
    <div class="alert alert-success" role="alert">
        Задача успешно добавлена!
    </div>
<?endif;?>

<form method="post" action = "">
    <div class="form-group">
        <label for="name">Имя пользователя</label>
        <input type="text" class="form-control" id="name" placeholder="Введите имя" name = "name">
    </div>
    <div class="form-group">
        <label for="email">E-mail</label>
        <input type="text" class="form-control" id="email" aria-describedby="emailHelp" placeholder="Введите email" name = "email">
        <small id="emailHelp" class="form-text text-muted">Мы никогда никому не передадим вашу электронную почту.</small>
    </div>
    <div class="form-group">
        <label for="task">Текст задачи</label>
        <textarea class="form-control" id="task" rows="3" name = "task"></textarea>
    </div>

    <button type="submit" class="btn btn-primary" name = "addTask">Отправить</button>
</form>