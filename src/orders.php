<?php
	ob_start();
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
      <th scope="col">Одобри</th>
      <th scope="col">Отхвърли</th>

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
		<td>
		<button class="btn btn-link edit-btn">
			<svg class="bi bi-check" width="2.3em" height="2.3em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
			<path fill-rule="evenodd" d="M10.97 4.97a.75.75 0 0 1 1.071 1.05l-3.992 4.99a.75.75 0 0 1-1.08.02L4.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093 3.473-4.425a.236.236 0 0 1 .02-.022z"/>
		</svg>
		</button>
		</td>
		<td >
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
                        <form method="POST" action="">
							<input type="hidden" name="order_id" value="<?php echo $value["id"]; ?>">
                            <button type="submit" name="delorder" class="btn btn-danger">Да</button>
                        </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
      </td>
    </tr>
    <?php
        endforeach;
        endif;
    ?>
  </tbody>
</table>
</div>
<?php
	if(isset($_POST["delorder"])) {
		$sql="DELETE FROM orders where id='".$_POST["order_id"]."'";
		if($db->delete($sql)) {
			header("Refresh:0");
		}
		else {
			echo "<div class='alert alert-danger' role='alert'>Нещо се обърка при изтриването на поръчката. Моля, опитайте отново!</div>";
		}
	}
?>
<?php
    include 'includes/footer.inc';
    endif;
?>
