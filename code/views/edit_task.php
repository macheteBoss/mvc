<?if ($data['edit_status'] == 'error'):?>
    <div class="alert alert-danger" role="alert">
        <?=implode("<br>", $data['errors']);?>
    </div>
<?elseif ($data['edit_status'] == 'success'):?>
    <div class="alert alert-success" role="alert">
        Задача успешно изменена!
    </div>
<?endif;?>

<form method="post" action = "">
    <div class="form-group">
        <label for="name">Имя пользователя</label>
        <input type="text" class="form-control" id="name" value = "<?=$data['name']?>" name = "name" disabled>
    </div>
    <div class="form-group">
        <label for="email">E-mail</label>
        <input type="email" class="form-control" id="email" value = "<?=$data['email']?>" name = "email" disabled>
    </div>
    <div class="form-group">
        <label for="task">Текст задачи</label>
        <textarea class="form-control" id="task" rows="3" name = "task"><?=$data['task']?></textarea>
    </div>
    <div class="form-group">
        <label for="ready">Готовность</label>
        <select class="form-control" id="ready" name = "ready">
            <option value = "1"<?if ($data['ready']):?> selected<?endif;?>>Готово</option>
            <option value = "0"<?if (!$data['ready']):?> selected<?endif;?>>Не готово</option>
        </select>
    </div>

    <button type="submit" class="btn btn-primary" name = "editTask">Отправить</button>
</form>