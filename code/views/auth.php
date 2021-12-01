<?if ($data['login_status'] == 'denied'):?>
    <div class="alert alert-danger" role="alert">
        Неверный логин или пароль!
    </div>
<?elseif ($data['login_status'] == 'granted'):?>
    <div class="alert alert-success" role="alert">
        Вы успешно авторизованы!
    </div>
    <a href="/tasks/">На главную</a>
<?endif;?>

<?if ($data['login_status'] != 'granted'):?>
<form method="post" action = "">
    <div class="form-group">
        <label for="username">Имя пользователя</label>
        <input type="text" class="form-control" id="username" placeholder="Введите имя пользователя" name = "username">
    </div>
    <div class="form-group">
        <label for="password">Пароль</label>
        <input type="password" class="form-control" id="password" name = "password">
    </div>

    <button type="submit" class="btn btn-primary" name = "addTask">Войти</button>
</form>
<?endif;?>
