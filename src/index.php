<?php
    include 'includes/header.inc';
?>
<div class="container justify-content-center cont">
    <div class="jumbotron jumbotron-fluid">
        <div class="container">
            <h1 class="display-4">Добре дошли при нас!</h1>
            <p class="lead">
                Тук ще намерите най-красивите предложения за Вашия празник!
                Доставяме до 2 часа в рамките на град Пловдив!</p>
        </div>
    </div>
    <div class="container">
    <h4>Актуално:</h4>

    <div class="row">
        <?php
            // Заявка за извеждане на последните 3 въведени артикула
            include_once 'lib/db.php';
            $db = new DB();
            $bouquets = $db->get("SELECT * FROM product WHERE deleted=FALSE ORDER BY id DESC LIMIT 3");
            
            if($bouquets):
                foreach($bouquets as $key => $value ):
        ?>
        <div class="col-sm-3 m-3">
            <div class="card " style="width: 18rem;">
                <img src="./assets/img/<?php echo $value["pic_url"]; ?>" class="card-img-top" alt="..." weight="100" height="280">
                <div class="card-body">
                    <h5 class="card-title"><?php echo $value["name"]; ?></h5>
                    <p class="card-text">Цена:<?php echo $value["price"]; ?></p>
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
