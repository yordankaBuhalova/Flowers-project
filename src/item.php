<?php
    include 'includes/header.inc';
?>
<div class="container contb">
    <div class="row">
        <div class="col-1.5">
           <h4>Букет</h4>
           <br>
        </div>
        <div class="col-6">
            <a type="button" class="btn btn-link edit-btn" href="edit-item.php?id=<?php echo (int)$_GET['id'];?>">
                <svg class="bi bi-pen" width="1.5em" height="1.5em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" d="M5.707 13.707a1 1 0 0 1-.39.242l-3 1a1 1 0 0 1-1.266-1.265l1-3a1 1 0 0 1 .242-.391L10.086 2.5a2 2 0 0 1 2.828 0l.586.586a2 2 0 0 1 0 2.828l-7.793 7.793zM3 11l7.793-7.793a1 1 0 0 1 1.414 0l.586.586a1 1 0 0 1 0 1.414L5 13l-3 1 1-3z"/>
                    <path fill-rule="evenodd" d="M9.854 2.56a.5.5 0 0 0-.708 0L5.854 5.855a.5.5 0 0 1-.708-.708L8.44 1.854a1.5 1.5 0 0 1 2.122 0l.293.292a.5.5 0 0 1-.707.708l-.293-.293z"/>
                    <path d="M13.293 1.207a1 1 0 0 1 1.414 0l.03.03a1 1 0 0 1 .03 1.383L13.5 4 12 2.5l1.293-1.293z"/>
                </svg>
            </a>

            <!-- Button trigger modal -->
            <button type="button" class="btn btn-link edit-btn" data-toggle="modal" data-target="#exampleModal">
                <svg class="bi bi-x" width="2.3em" height="2.3em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" d="M11.854 4.146a.5.5 0 0 1 0 .708l-7 7a.5.5 0 0 1-.708-.708l7-7a.5.5 0 0 1 .708 0z"/>
                    <path fill-rule="evenodd" d="M4.146 4.146a.5.5 0 0 0 0 .708l7 7a.5.5 0 0 0 .708-.708l-7-7a.5.5 0 0 0-.708 0z"/>
                </svg>
            </button>

            <!-- Modal -->
            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Изтрии</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            Сигурни ли сте, че искате да изтриете?
                        </div>
                        <div class="modal-footer">

                            <button type="button" class="btn btn-primary">Да</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </div>
    <div class="row">

        <div class="media">
            <?php
                include_once 'lib/db.php';
                $db = new DB();
                $id = (int)$_GET['id'];
                $product = $db->get("SELECT * FROM product WHERE idproduct=$id");
                $products = $db->get("SELECT * FROM product");
                if($product):
            ?>

            <img src="./assets/img/bojur.jpg" class="align-self-start mr-3" alt="..."weight="100" height="250">
            <div class="media-body">
                <h5 class="mt-0"><?php echo $product[0]["name"]; ?></h5>
                <p>Цена:<?php echo $product[0]["price"];?>лв.</p>
                <p>Описание:<?php echo $product[0]["description"];?></p>
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#delete">
                Поръчай
                </button>

                <!-- Modal -->
                <div class="modal fade" id="delete" tabindex="-1" role="dialog" aria-labelledby="deletel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="deletel">Поръчка на артикул: <?php echo $product[0]["name"]; ?></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form>
                            <div class="form-group">
                                <label for="exampleInputuser1">Име</label>
                                <input type="user" class="form-control" id="exampleInputuser1" aria-describedby="userHelp">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Имейл</label>
                                <input type="password" class="form-control" id="exampleInputPassword1">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Адрес</label>
                                <input type="password" class="form-control" id="exampleInputPassword1">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Запитване</label>
                                <textarea type="text" class="form-control" rows="5" id="exampleInputPassword1"></textarea>
                            </div>

                            <input name="product_id" type="hidden" value=<?php echo $product[0]["idproduct"]; ?>>
                        </form>
                    </div>
                    <div class="modal-footer">

                        <button type="button" class="btn btn-primary " data-target="success-page.php">Завърши поръчката</button>
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