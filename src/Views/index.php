<?php

namespace App\Views;

use App\Auth;

?>

<div class='container'>
<div class="header">
    <h1>Список</h1>
    <h2></h1>
</div>
<?php if (!Auth::isAdmin()) :?>
    <form class="form-add" action="/add" method="POST">
    <div class="fieldsstart">
        <div class='fields'>
            <label for="start">Начало</label>
            <input type="text" name="start"id="datepickerstart" required>
        </div>
        <p class="error"></p>
    </div>
    <div class="fieldsend">
        <div class='fields'>
        <label for="start">Конец</label>
        <input type="text" name="end"id="datepickerend" required>
        </div>
        <p class='error'></p>
    </div>
    <input class="btn btn-success add-button" type="submit" value="Добавить">
</form>
<?php endif;?>
<div class='center-block'>
    <table class="table">
    <thead>
        <th>Сотрудник</th>
        <th>Начало</th>
        <th>Конец</th>
        <th>Статус</th>
    </thead>
        <tbody>
            <?php foreach ($data as $list) {?>
            <tr>
                <th><?=$list->author;?></th>
                <th><?=$list->start;?></th>
                <th><?=$list->end;?></th>
                <th>
                    <?php if (Auth::isAdmin()) : ?>
                            <a class='status' href="/edit/<?=$list->id?>"><?=$list->check ? 'Утвержден' : 'Не утвержден'?></a>
                    <?php else : ?>
                            <?=$list->check ? 'Утвержден' : 'Не утвержден'?>
                    <?php endif;?>
                </th>
            </tr>
            <?php }?>
        </tbody>
    </table>
</div>
</div>