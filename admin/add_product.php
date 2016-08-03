<?php $sqlSelect = $mysqli->query("SELECT c.id, c.category  FROM categories c"); ?>

<form method="post" id="form-add-prod" class="form">
    <h3>Добавить продукт</h3>
    <p class="form_text message" style="display: none;"></p>
    <p><input type="text" placeholder="Название товара" name="name" required></p>
    <p><textarea placeholder="Описание товара" name="description" required></textarea></p>
    <p><textarea placeholder="Зарактеристики товара" name="content" required></textarea></p>
    <div class="row">
        <p class="col-xs-4"><input type="number" placeholder="Цена товара" name="price" required></p>
        <p class="col-xs-4"><input type="number" placeholder="Количество" name="count" required></p>
        <p class="col-xs-4">
            <select name="category_id" required>
                <?php foreach ($sqlSelect as $item): ?>
                    <option value="<?php echo $item["id"]; ?>"><?php echo $item["category"]; ?></option>
                <?php endforeach; ?>
            </select>
        </p>
    </div>
    <p><input type="submit" value="Добавить" class="btn"></p>
    <input type="hidden" name="add_product">
</form>
