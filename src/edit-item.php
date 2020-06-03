<?php
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
            $product = $db->get("SELECT * FROM product WHERE idproduct=$id");
            if($product):
        ?>
        <img src="./assets/img/<?php echo $product[0]["pic_url"]; ?>" class="align-self-start mr-3" alt="..."weight="100" height="250">

        <div class="media-body col-6">
            <form  >
                <div class="form-group">
                    <label for="name">Име</label>
                    <input type="text" class="form-control"  value=<?php echo $product[0]["name"]; ?>>

                </div>
                <div class="form-group">
                    <label for="price">Цена в лв:</label>
                    <input  class="form-control" id="exampleInputPassword1" value = <?php echo $product[0]["price"];?>>
                </div>
                <div class="form-group">
                    <label for="pic_url">Име на снимка:</label>
                    <input  class="form-control" id="exampleInputPassword1" value=<?php echo $product[0]["pic_url"]; ?>>
                </div>
                <div class="form-group">
                    <label for="type">Тип</label>
                    <select class="form-control" id="type">
                        <option value = "bouquet">Букети</option>
                        <option value = "art_bouquet">Арт букети</option>
                        <option value = "houseplant">Стайни растения</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="description">Описание</label>
                    <textarea type="text" class="form-control" rows="5" id="description" ><?php echo $product[0]["description"];?></textarea>
                </div>
                <button type="button" class="btn btn-primary">Откажи</button>
                <button type="button" class="btn btn-primary">Запази</button>

            </form>
        </div>
        <?php endif; ?>
    </div>
</div>
<?php
    include 'includes/footer.inc';
?>
<?php
    else:
        echo "Not allowed";
    endif;
?>