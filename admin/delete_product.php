<?php

$sqlSelect = $mysqli->query("SELECT p.id, p.product, p.description, p.content, p.price, p.preview, p.`count`, p.date_create, p.category_id, c.category
FROM products p
JOIN categories c
ON c.id = p.category_id");

?>

<form method="post" id="form-delete-prod" class="form">
    <table class="productsTable">
        <tr class="titleRow">
            <td></td>
            <td>id</td>
            <td>Название</td>
            <td>Категория</td>
            <td>Цена</td>
            <td>Кол-во</td>
        </tr>
        <?php
        $count = 0;
        foreach ($sqlSelect as $item):
            global $count;
            $count++; ?>
            <tr class="productRow <?php if($count%2 != 0){echo 'grayRow';} ?>">
                <td><input type="checkbox" name="del_prod[]" value="<?php echo $item['id']; ?>"></td>
                <td><?php echo $item['id']; ?></td>
                <td><?php echo $item['product']; ?></td>
                <td><?php echo $item['category']; ?></td>
                <td><?php echo $item['price']; ?></td>
                <td><?php echo $item['count']; ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
    <br>
    <p><input type="submit" value="Удалить" class="btn"></p>
    <input type="hidden" name="delete_product">
</form>
