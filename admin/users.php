<?php $sqlSelect = $mysqli->query("SELECT u.id, u.email, u.login, u.role_id, u.date_create, u.approve  FROM users u "); ?>

<table class="usersTable">
    <tr class="titleRow">
        <td>id</td>
        <td>Email</td>
        <td>Логин</td>
        <td>Роль</td>
        <td>Дата создания</td>
        <td>Подтверждён</td>
    </tr>
    <?php
    $count = 0;
    foreach ($sqlSelect as $item):
        global $count;
        $count++; ?>
        <tr class="productRow <?php if($count%2 != 0){echo 'grayRow';} ?>">
            <td><?php echo $item['id']; ?></td>
            <td><?php echo $item['email']; ?></td>
            <td><?php echo $item['login']; ?></td>
            <td><?php echo $item['role_id']; ?></td>
            <td><?php echo $item['date_create']; ?></td>
            <td><?php echo $item['approve']; ?></td>
        </tr>
    <?php endforeach; ?>
</table>