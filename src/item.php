<?php
    // Страница за артикул
    ob_start();
    session_start();
    include 'includes/header.inc';
?>
<div class="container contb">
    <?php
        include_once 'lib/db.php';
        $db = new DB();
        // ПК $id на артикула
        $id = (int)$_GET['id'];
        // заявка за извеждане информацията за артикула с $id
        $product = $db->get("SELECT * FROM product WHERE id=$id");
    ?>
    <div class="row">
        <div class="col-1.5">
            <h4>
                <?php
                    // визуализиране на името на типа
                    if($product[0]["type"] === "bouquet"):
                        print "Букет";
                    elseif ($product[0]["type"] === "art_bouquet"):
                        print "Арт букет";
                    else:
                        print "Стайнo растениe";
                    endif;
                ?>
            </h4>
            <br>
        </div>
        <?php
            // Ако в системата е логнат администратор се визуализират бутоните за редакция
            if(!empty($_SESSION)):
        ?>
        <div class="col-6">

            <a type="button" class="btn btn-link edit-btn" href="edit-item.php?id=<?php echo (int)$_GET['id'];?>">
                <svg class="bi bi-pen" width="1.5em" height="1.5em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" d="M5.707 13.707a1 1 0 0 1-.39.242l-3 1a1 1 0 0 1-1.266-1.265l1-3a1 1 0 0 1 .242-.391L10.086 2.5a2 2 0 0 1 2.828 0l.586.586a2 2 0 0 1 0 2.828l-7.793 7.793zM3 11l7.793-7.793a1 1 0 0 1 1.414 0l.586.586a1 1 0 0 1 0 1.414L5 13l-3 1 1-3z"/>
                    <path fill-rule="evenodd" d="M9.854 2.56a.5.5 0 0 0-.708 0L5.854 5.855a.5.5 0 0 1-.708-.708L8.44 1.854a1.5 1.5 0 0 1 2.122 0l.293.292a.5.5 0 0 1-.707.708l-.293-.293z"/>
                    <path d="M13.293 1.207a1 1 0 0 1 1.414 0l.03.03a1 1 0 0 1 .03 1.383L13.5 4 12 2.5l1.293-1.293z"/>
                </svg>
            </a>

            <!-- Изтриване -->
            <button type="button" class="btn btn-link edit-btn" data-toggle="modal" data-target="#delete-b">
                <svg class="bi bi-x" width="2.3em" height="2.3em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" d="M11.854 4.146a.5.5 0 0 1 0 .708l-7 7a.5.5 0 0 1-.708-.708l7-7a.5.5 0 0 1 .708 0z"/>
                    <path fill-rule="evenodd" d="M4.146 4.146a.5.5 0 0 0 0 .708l7 7a.5.5 0 0 0 .708-.708l-7-7a.5.5 0 0 0-.708 0z"/>
                </svg>
            </button>

            <!-- Modal Изтриване-->
            <div class="modal fade" id="delete-b" tabindex="-1" role="dialog" aria-labelledby="delete-bLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="delete-bLabel">Изтрии</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            Сигурни ли сте, че искате да изтриете?
                        </div>
                        <div class="modal-footer">
                            <form method="POST" action="">
                                <button type="submit" name="del" class="btn btn-danger">Да</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php
            endif;
        ?>
    </div>
    <div class="row">
        <div class="media">
            <?php

                if($product):
            ?>
            <img src="./assets/img/<?php echo $product[0]["pic_url"]; ?>" class="align-self-start mr-3" alt="..."weight="100" height="250">
            <div class="media-body">
                <h5 class="mt-0"><?php echo $product[0]["name"]; ?></h5>
                <p>Цена:<?php echo $product[0]["price"];?>лв.</p>
                <p>Описание:<?php echo $product[0]["description"];?></p>
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#order">
                Поръчай
                </button>

                <!-- Modal -->
                <div class="modal fade" id="order" tabindex="-1" role="dialog" aria-labelledby="orderl" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="orderl">Поръчка на артикул: <?php echo $product[0]["name"]; ?></h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form method="POST" action="">
                                <div class="form-group">
                                    <label for="name">Име</label>
                                    <input type="user" name="name" class="form-control" id="name" required>
                                </div>
                                <div class="form-group">
                                    <label for="email">Имейл</label>
                                    <input type="email" name="email" class="form-control" id="email" required>
                                </div>
                                <div class="form-group">
                                    <label for="address">Адрес</label>
                                    <input type="text" name="address" class="form-control" id="address" required>
                                </div>
                                <div class="form-group">
                                    <label for="message">Запитване</label>
                                    <textarea type="text" name="message" class="form-control" rows="5" id="message"></textarea>
                                </div>

                                <input name="product_id" type="hidden" value=<?php echo $product[0]["id"]; ?>>
                                <div class="modal-footer">
                                    <button type="submit" name="order" class="btn btn-primary">Завърши поръчката</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                </div>

            </div>
            <?php endif; ?>
        </div>

    </div>
</div>
<?php
    include 'includes/footer.inc';
?>
<?php
    // Заявка за деактивиране на продукта (изтриване от сайта)
    if (isset($_POST['del'])){
        $sql = "UPDATE product SET deleted=TRUE WHERE id='".$id."'";
        if($db->exec($sql))
            header("location: index.php");
        else {
            echo "<div class='alert alert-danger' role='alert'>Нещо се обърка при изтриването на продукта. Моля, опитайте отново!</div>";
            die();
        }
    }

    // Проверка на формата за поръчки
    if (isset($_POST['order'])) {
        // Проверка за наличност на данните - име, имейл и адрес са задължителни полета
        if(empty($_POST["name"]) || empty($_POST["email"]) || empty($_POST["address"])) {
            echo "<div class='alert alert-danger' role='alert'>Име, имейл и адрес са задължителни полета. Моля, опитайте отново!</div>";
            die();
        }
        // Проверка на символите в полето Име. Името трябва да съдържа само букви
        else if (!preg_match("/^[a-zA-Z ]*$/",$_POST["name"])) {
            echo "<div class='alert alert-danger' role='alert'>Името не може да съдържа числа и специални символи. Моля, опитайте отново!</div>";
            die();
        }
        // Проверка на въведения имейл
        else if (!preg_match("/^\S+@\S+\.\S+$/",$_POST["email"])) {
            echo "<div class='alert alert-danger' role='alert'>Електронната поща е в невалиден формат. Моля, опитайте отново!</div>";
            die();
        }
        else{
            // При вярно попълнена поръчка
            // Взимаме датата
            $createdate =  date('Y-m-d H:i:s');
            // Заявка за запис на поръчката в базата
            $sql = "INSERT INTO orders(product_id,email,name,message,created,address) VALUES ('".$_POST["product_id"]."','".$_POST["email"]."','".$_POST["name"]."' ,'".$_POST["message"]."','".$createdate."','".$_POST["address"]."' )";
            if($db->exec($sql))
                // След запис
                header("location: success-page.php");
            else
                // При грешка връща съобщение
                echo "<div class='alert alert-danger' role='alert'>Нещо се обърка при поръчката. Моля, опитайте отново!</div>";
        }

    }
?>