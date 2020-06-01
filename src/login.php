<?php
    include 'includes/header.inc';
?>
<div class="container cont">
<br>
    <h4>Вход за Админ Панел</h4>
</div>
<form>
  <div class="form-group">
    <label for="exampleInputuser1">Потребител</label>
    <input type="user" class="form-control" id="exampleInputuser1" aria-describedby="userHelp">

  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">Парола</label>
    <input type="password" class="form-control" id="exampleInputPassword1">
  </div>

  <button type="submit" class="btn btn-primary">Вход</button>
</form>
<?php
    include 'includes/footer.inc';
?>
