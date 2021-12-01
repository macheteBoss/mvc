<div class="loginLine">
    <?if ($data['login_status'] != 'granted'):?>
        <a href="/user/" class = "btn btn-info">Авторизация</a>
    <?else:?>
        <a href="/user/logout/" class = "btn btn-info">Выход</a>
    <?endif;?>
</div>

<div class="row">
    <div class="col-md-4">
        <div class="body-add-btn">
            <a href = "/tasks/add/" class="btn btn-primary">Добавить задание</a>
        </div>
    </div>
    <div class="col-md-8">
        <form action="/tasks/index/" method = "get">
        <div class="row">
            <div class="col-sm-5">
                <div class="form-group">
                    <label for="ready">Сортировать:</label>
                    <select class="form-control" id="sortField" name = "sortField">
                        <option value = "id"<?if($data['sortField'] == 'id'):?> selected<?endif;?>>ID</option>
                        <option value = "name"<?if($data['sortField'] == 'name'):?> selected<?endif;?>>Имя</option>
                        <option value = "email"<?if($data['sortField'] == 'email'):?> selected<?endif;?>>E-mail</option>
                        <option value = "ready"<?if($data['sortField'] == 'ready'):?> selected<?endif;?>>Готовность</option>
                    </select>
                </div>
            </div>
            <div class="col-sm-5">
                <div class="form-group">
                    <label for="ready">По:</label>
                    <select class="form-control" id="direction" name = "direction">
                        <option value = "1"<?if($data['up'] === 1):?> selected<?endif;?>>По возрастанию</option>
                        <option value = "0"<?if($data['up'] === 0):?> selected<?endif;?>>По убыванию</option>
                    </select>
                </div>
            </div>
            <div class="col-sm-2">
                <div class="form-group">
                    <input type="hidden" name = "page" value = "<?=$data['page'];?>">
                    <button type = "submit" class="btn btn-primary sortTaskBtn"><i class="fa fa-chevron-right" aria-hidden="true"></i></button>
                </div>
            </div>
        </div>
        </form>
    </div>
</div>

<div class="table-responsive">
    <table class="table table-hover text-center">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Имя</th>
                <th scope="col">E-mail</th>
                <th scope="col">Текст задачи</th>
                <th scope="col">Готовность</th>
                <?if ($data['login_status'] == 'granted'):?>
                    <th scope="col"></th>
                <?endif;?>
            </tr>
        </thead>
        <tbody>
            <?if($data['items'] && count($data['items']) > 0):?>
                <?foreach ($data['items'] as $item):?>
                    <tr>
                        <th scope="row"><?=$item['id'];?></th>
                        <td><?=$item['name'];?></td>
                        <td><?=$item['email'];?></td>
                        <td><?=$item['task'];?></td>
                        <td>
                            <?if ($item['ready']):?>
                                <i class="fa fa-check ready" aria-hidden="true"></i>
                            <?else:?>
                                <i class="fa fa-times notReady" aria-hidden="true"></i>
                            <?endif;?>
                            <?if ($item['updateAdmin']):?>
                                <i class="fa fa-exchange" aria-hidden="true"></i>
                            <?endif;?>
                        </td>
                        <?if ($data['login_status'] == 'granted'):?>
                            <th scope="col">
                                <a href="/tasks/edit/<?=$item['id'];?>">
                                    <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                </a>
                            </th>
                        <?endif;?>
                    </tr>
                <?endforeach;?>
            <?endif;?>
        </tbody>
    </table>
    <nav aria-label="...">
        <ul class="pagination pagination-sm justify-content-center">
            <? for($i = 1; $i <= $data['num_pages']; $i++): ?>
                <? if ($i == $data['page']): ?>
                    <li class="page-item disabled">
                        <a class="page-link" href="#" tabindex="-1"><?=$i;?></a>
                    </li>
                <? else: ?>
                    <li class="page-item">
                        <?
                            $parts = parse_url($data['url']);
                            parse_str($parts['query'], $query);
                            $query['page'] = $i;
                            $link = '/tasks/index/?' . http_build_query($query);
                        ?>
                        <a class="page-link" href="<?=$link;?>"><?=$i;?></a>
                    </li>
                <? endif ?>
            <? endfor; ?>
        </ul>
    </nav>
</div>
