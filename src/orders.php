<?php
    session_start();
    include 'includes/header.inc';

    if(!empty($_SESSION)):

?>
<div class="container contb">
<?php
    include_once 'lib/db.php';
    $db = new DB();
?>
<h4>Поръчки</h4>
<table class="table">
  <thead class="thead-dark">
    <tr>
      <th scope="col">#</th>
      <th scope="col">Име</th>
      <th scope="col">Имейл</th>
      <th scope="col">Адрес</th>
      <th scope="col">Артикул</th>
      <th scope="col">Запитване</th>
      <th scope="col">Дата</th>
    </tr>
  </thead>
  <tbody>
    <?php
        $orders = $db->get("SELECT * FROM orders");
        if($orders):
            foreach($orders as $key => $value ):
    ?>
    <tr>


      <th scope="row"><?php echo $value["id"]; ?></th>
      <td><?php echo $value["name"]; ?></td>
      <td><?php echo $value["email"]; ?></td>
      <td><?php echo $value["address"]; ?></td>
      <td><?php echo $value["product_id"]; ?></td>
      <td><?php echo $value["message"]; ?></td>
      <td><?php echo $value["created"]; ?></td>
    </tr>
    <?php
        endforeach;
        endif;
    ?>
  </tbody>
</table>


</div>
<?php
    include 'includes/footer.inc';
    endif;
?>
