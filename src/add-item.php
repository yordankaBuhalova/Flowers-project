<?php
    ob_start();
    session_start();
    if(!empty($_SESSION)):
        include 'includes/header.inc';
?>
<div class="container contb">
    <?php
        include_once 'lib/db.php';
        $db = new DB();
        $type = htmlspecialchars($_GET['type']);

    ?>
    <h4>Добави Артикул в <?php echo $type ?></h4>
    <br>
    <div class="media">

        <div class="media-body col-6">

            <form method="POST" action="">
                <div class="form-group">
                    <label for="name">Име</label>
                    <input name="name" type="text" class="form-control" id="name" value>
                </div>
                <div class="form-group">
                    <label for="price">Цена в лв:</label>
                    <input  name="price" class="form-control" type=number id="price"value >
                </div>
                <div class="form-group">
                    <label for="pic_url">Име на снимка:</label>
                    <input name="pic_url" class="form-control" id="pic_url" value>
                </div>
                <input hidden class="form-control" id="type" value =<?php echo $type ?>>
                <div class="form-group">
                    <label for="description">Описание</label>
                    <textarea name="description" type="text" class="form-control" rows="5" id="description"></textarea>
                </div>
                <button type="button" class="btn btn-primary">Откажи се</button>
                <input type="hidden" id="actualDate" name="actualDate"/>
                <button type="submit" class="btn btn-primary">Запази</button>

            </form>

        </div>
    </div>
</div>
<?php
    include 'includes/footer.inc';
?>

<?php
    if (!empty($_POST)) {
        $current_user = $_SESSION["user_id"];
        $createdate =  date('Y-m-d H:i:s');
        $sql = "INSERT INTO product(name,price,type,description,pic_url,user_id,deleted,created_date) VALUES ('".$_POST["name"]."','".$_POST["price"]."','".$type."' ,'".$_POST["description"]."','".$_POST["pic_url"]."' ,'".$current_user."',FALSE,'".$createdate."' )";
        $db->insert($sql);

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