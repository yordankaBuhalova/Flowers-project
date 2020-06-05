<?php
    // Страница за добавчне на нови артикули
    ob_start();
    session_start();
    // Проверка за логнат администратор
    if(!empty($_SESSION)):
        include 'includes/header.inc';
?>
<div class="container contb">
    <?php
        include_once 'lib/db.php';
        $db = new DB();
        // Типа на артикула
        $type = htmlspecialchars($_GET['type']);

    ?>
    <h4>
        Добави Артикул в
        <?php
            // визуализиране на името на типа
            if($type === "bouquet"):
                print "Букет";
            elseif ($type === "art_bouquet"):
                print "Арт букет";
            else:
                print "Стайнo растениe";
            endif;
        ?>
    </h4>
    <br>
    <div class="media">

        <div class="media-body col-6">

            <form method="POST" action="">
                <div class="form-group">
                    <label for="name">Име</label>
                    <input name="name" type="text" class="form-control" id="name" required>
                </div>
                <div class="form-group">
                    <label for="price">Цена в лв:</label>
                    <input  name="price" class="form-control" type=number id="price" required>
                </div>
                <div class="form-group">
                    <label for="pic_url">Име на снимка:</label>
                    <input name="pic_url" class="form-control" id="pic_url">
                </div>
                <input hidden class="form-control" id="type" value =<?php echo $type ?>>
                <div class="form-group">
                    <label for="description">Описание</label>
                    <textarea name="description" type="text" class="form-control" rows="5" id="description"></textarea>
                </div>

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
    // Валидация на формата за добавяне на артикули
    if (!empty($_POST)) {
        // Проверка на задължителни полета
        if(empty($_POST["name"]) || empty($_POST["price"])) {
            echo "<div class='alert alert-danger' role='alert'>Име и цена са задължителни полета. Моля, опитайте отново!</div>";
            die();
        }
        // пк на админа
        $current_user = $_SESSION["user_id"];
        // дата
        $createdate =  date('Y-m-d H:i:s');
        // Заявка за добавяне в базата
        $sql = "INSERT INTO product(name,price,type,description,pic_url,user_id,deleted,created_date) VALUES ('".$_POST["name"]."','".$_POST["price"]."','".$type."' ,'".$_POST["description"]."','".$_POST["pic_url"]."' ,'".$current_user."',FALSE,'".$createdate."' )";
        if($db->exec($sql)) {
            // След успешно добавяне следва връшане към съответния тип продукти
            if ($type == "bouquet"){
                header("location: bouquets.php");
            }
            elseif($type == "art_bouquet"){
                header("location: art-bouquets.php");
            }
            else {
                header("location: room-plants.php");
            }
        }
        else {
            // При грешки
            echo "<div class='alert alert-danger' role='alert'>Нещо се обърка при добавянето на продукта. Моля, опитайте отново!</div>";
        }
    }
?>


<?php
    else:
        // Ако потребителя е анонимен
        echo "Not allowed";
    endif;
?>