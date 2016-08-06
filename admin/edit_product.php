<?php
$prodId = $_GET["id"];
$sqlSelect = $mysqli->query("SELECT c.id, c.category  FROM categories c");
$sqlSelectProd = $mysqli->query("SELECT p.id, p.product, p.description, p.content, p.price, p.`count`, p.category_id  FROM products p WHERE p.id = $prodId");
?>

<?php foreach ($sqlSelectProd as $prod): ?>
<form method="post" id="form-edit-prod" class="form">
    <h3>Редактировать продукт</h3>
    <p class="form_text message" style="display: none;"></p>
    <p><input type="text" name="name" required value="<?php echo $prod["product"] ?>"></p>
    <p><textarea name="description" required><?php echo $prod["description"] ?></textarea></p>
    <p><textarea name="content" required><?php echo $prod["content"] ?></textarea></p>
    <div class="row">
        <p class="col-xs-4"><input type="number" name="price" required value="<?php echo $prod["price"] ?>"></p>
        <p class="col-xs-4"><input type="number" name="count" required value="<?php echo $prod["count"] ?>"></p>
        <p class="col-xs-4">
            <select name="category_id" required>
                <?php foreach ($sqlSelect as $item): ?>
                    <option value="<?php echo $item["id"]; ?>" <?php if($item["id"] == $prod["category_id"]){echo 'selected';} ?>><?php echo $item["category"]; ?></option>
                <?php endforeach; ?>
            </select>
        </p>
    </div>
    <p><input type="submit" value="Сохранить" class="btn"></p>
    <input type="hidden" name="id" value="<?php echo $prodId; ?>">
    <input type="hidden" name="edit_product">
</form>
<?php endforeach; ?>
