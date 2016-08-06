<?php

$sqlSelect = $mysqli->query("SELECT p.id, p.product, p.description, p.content, p.price, p.preview, p.`count`, p.date_create, p.category_id, c.category
FROM products p
JOIN categories c
ON c.id = p.category_id");

?>

<table class="productsTable">
    <tr class="titleRow">
        <td>id</td>
        <td>Название</td>
        <td>Категория</td>
        <td>Описание</td>
        <td>Информация</td>
        <td>Цена</td>
        <td>Кол-во</td>
    </tr>
    <?php
    $count = 0;
    foreach ($sqlSelect as $item):
        global $count;
        $count++; ?>
        <tr class="productRow <?php if($count%2 != 0){echo 'grayRow';} ?>">
            <td><?php echo $item['id']; ?></td>
            <td><a href="?page=edit_product&id=<?php echo $item['id']; ?>"><?php echo $item['product']; ?></a></td>
            <td><?php echo $item['category']; ?></td>
            <td><?php echo $item['description']; ?></td>
            <td><?php echo $item['content']; ?></td>
            <td><?php echo $item['price']; ?></td>
            <td><?php echo $item['count']; ?></td>
        </tr>
    <?php endforeach; ?>
</table>
<br>
<ul>
    <li><a href="?page=add_product">Добавить товар</a></li>
    <li><a href="?page=delete_product">Удалить товар</a></li>
</ul>
