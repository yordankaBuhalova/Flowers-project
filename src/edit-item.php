<?php
    ob_start();
    session_start();
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
            $id = (int)$_GET['id'];
            $product = $db->get("SELECT * FROM product WHERE id=$id");
            $type = htmlspecialchars($_GET['type']);
            if($product):
        ?>
        <img src="./assets/img/<?php echo $product[0]["pic_url"]; ?>" class="align-self-start mr-3" alt="..."weight="100" height="250">

        <div class="media-body col-6">
            <form  method="POST" action="">
                <div class="form-group">
                    <label for="name">Име</label>
                    <input type="text" name="name" class="form-control"  value=<?php echo $product[0]["name"]; ?>>

                </div>
                <div class="form-group">
                    <label for="price">Цена в лв:</label>
                    <input  name="price" class="form-control" id="exampleInputPassword1" value =<?php echo $product[0]["price"];?>>
                </div>
                <div class="form-group">
                    <label for="pic_url">Име на снимка:</label>
                    <input name="pic_url" class="form-control" id="exampleInputPassword1" value=<?php echo $product[0]["pic_url"]; ?>>
                </div>
                <div class="form-group">
                    <label for="type">Тип</label>
                    <select class="form-control" id="type" name="type">
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
    if (!empty($_POST)) {
        $current_user = $_SESSION["user_id"];
        $sql = "UPDATE product SET name='".$_POST["name"]."',price='".$_POST["price"]."',type='".$_POST["type"]."',description='".$_POST["description"]."',pic_url='".$_POST["pic_url"]."',user_id='".$current_user."' WHERE id=".$id;
        $db->update($sql);
        if ($type == "bouquet"){
            header("location: bouquets.php");
        }
        elseif($type == "art_bouquet"){
            header("location: art-bouquets.php");
        }
        else{
            header("location: room-plants.php");
        }
    }
?>
<?php
    else:
        echo "Not allowed";
    endif;
?>