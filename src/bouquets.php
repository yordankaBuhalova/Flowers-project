<?php
    // Страница за списък с артикули от тип букет
    session_start();
    include 'includes/header.inc';
?>
<div class="container contb">
    <?php
        include_once 'lib/db.php';
        $db = new DB();
        // Заявка за извличане на информацията за артикули от тип букет
        $products = $db->get("SELECT * FROM product WHERE type='bouquet' AND deleted=FALSE");
    ?>
    <br>
    <div class="row">
        <div class="col-1">
            <h4>Букети</h4>
        </div>
        <div class="col-6">
        <?php
        // Бутон за добавяне на нов артикул от типа. Видим само за администраторите.
            if(!empty($_SESSION)):
        ?>
            <a type="button" class="btn btn-link edit-btn" href="add-item.php?type=bouquet">
                <svg class="bi bi-plus" width="2.5em" height="2.5em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" d="M8 3.5a.5.5 0 0 1 .5.5v4a.5.5 0 0 1-.5.5H4a.5.5 0 0 1 0-1h3.5V4a.5.5 0 0 1 .5-.5z"/>
                    <path fill-rule="evenodd" d="M7.5 8a.5.5 0 0 1 .5-.5h4a.5.5 0 0 1 0 1H8.5V12a.5.5 0 0 1-1 0V8z"/>
                </svg>
            </a>
        <?php
            endif;
        ?>
        </div>

</div>
    <div class="row">
        <?php
            // За всеки артикул от типа се създава карта с информацията за него
            if($products):
                foreach($products as $key => $value ):
        ?>

        <div class="col-sm-3 mt-5">
            <div class="card " style="width: 16rem;">
                <img src="./assets/img/<?php echo $value["pic_url"]; ?>" class="card-img-top" alt="..." weight="100" height="250">
                <div class="card-body">
                    <h5 class="card-title"><?php echo $value["name"]; ?></h5>
                    <p class="card-text">Цена: <?php echo $value["price"]; ?>лв.</p>
                    <a href="item.php?id=<?php echo $value["id"]; ?>" class="btn btn-primary" >За повече информация</a>
                </div>
            </div>
        </div>

        <?php
            endforeach;
            endif;
        ?>
    </div>
</div>
<?php
    include 'includes/footer.inc';
?>