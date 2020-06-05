<?php
    // Страница за редакция на артикули
    ob_start();
    session_start();
    // Проверка за логнат администратор
    if(!empty($_SESSION)):
    include 'includes/header.inc';
?>
<div class="container contb">
    <h4>Редактирай Артикул</h4>
    <br>
    <div class="media">
        <?php
            include_once 'lib/db.php';
            $db = new DB();
            // пк на продукта
            $id = (int)$_GET['id'];
            // заявка за извличане на продукта от базата
            $product = $db->get("SELECT * FROM product WHERE id=$id");
            if($product):
        ?>
        <img src="./assets/img/<?php echo $product[0]["pic_url"]; ?>" class="align-self-start mr-3" alt="..."weight="100" height="250">

        <div class="media-body col-6">
            <form  method="POST" action="">
                <div class="form-group">
                    <label for="name">Име</label>
                    <input type="text" name="name" class="form-control"  value=<?php echo $product[0]["name"]; ?> required>

                </div>
                <div class="form-group">
                    <label for="price">Цена в лв:</label>
                    <input  name="price" class="form-control" id="exampleInputPassword1" value =<?php echo $product[0]["price"];?> required>
                </div>
                <div class="form-group">
                    <label for="pic_url">Име на снимка:</label>
                    <input name="pic_url" class="form-control" id="exampleInputPassword1" value=<?php echo $product[0]["pic_url"]; ?>>
                </div>
                <div class="form-group">
                    <label for="type">Тип</label>
                    <select class="form-control" id="type" name="type" required>
                        <!-- Селектиране на конкретния тип -->
                        <option value ="bouquet" <?php if($product[0]["type"] === "bouquet"): ?> selected <?php endif; ?>>Букети</option>
                        <option value ="art_bouquet" <?php if($product[0]["type"] === "art_bouquet"): ?> selected <?php endif; ?>>Арт букети</option>
                        <option value ="houseplant" <?php if($product[0]["type"] === "houseplant"): ?> selected <?php endif; ?>>Стайни растения</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="description">Описание</label>
                    <textarea name="description" type="text" class="form-control" rows="5" id="description" ><?php echo $product[0]["description"];?></textarea>
                </div>

                <button type="submit" class="btn btn-primary">Запази</button>

            </form>
        </div>
        <?php endif; ?>
    </div>
</div>
<?php
    include 'includes/footer.inc';
?>
<?php
    // Валидация на формата за редакция
    if (!empty($_POST)) {
        // Проверка за наличност на данни в задължителните полета
        if(empty($_POST["name"]) || empty($_POST["price"]) || empty($_POST["type"])) {
            echo "<div class='alert alert-danger' role='alert'>Име, цена и тип са задължителни полета. Моля, опитайте отново!</div>";
            die();
        }
        // пк на админа
        $current_user = $_SESSION["user_id"];
        // Заявка за редакция на продукта в базата
        $sql = "UPDATE product SET name='".$_POST["name"]."',price='".$_POST["price"]."',type='".$_POST["type"]."',description='".$_POST["description"]."',pic_url='".$_POST["pic_url"]."',user_id='".$current_user."' WHERE id=".$id;
        if($db->exec($sql)) {
            // След успешно добавяне следва връшане към съответния тип продукти
            if ($_POST["type"] == "bouquet") {
                header("location: bouquets.php");
            }
            elseif($_POST["type"] == "art_bouquet") {
                header("location: art-bouquets.php");
            }
            else {
                header("location: room-plants.php");
            }
        }
        else {
            // При грешки
            echo "<div class='alert alert-danger' role='alert'>Нещо се обърка при редакцията на продукта. Моля, опитайте отново!</div>";
        }
    }
?>
<?php
    else:
        // Ако потребителя е анонимен
        echo "Not allowed";
    endif;
?>