<?php
    ob_start();
    session_start();
    if(empty($_SESSION)):
    include 'includes/header.inc';
?>
<div class="container cont">
  <br>
      <h4>Вход за Админ Панел</h4>

  <form method="POST" action="login.php" class="col-3">
    <div class="form-group">
      <label for="exampleInputuser1">Потребител</label>
      <input type="user" class="form-control" name="username" aria-describedby="userHelp">
    </div>
    <div class="form-group">
      <label for="exampleInputPassword1">Парола</label>
      <input type="password" class="form-control" name="password">
    </div>

    <button type="submit" titel="Login" class="btn btn-primary" >Вход</button>
  </form>
</div>
<?php
    include 'includes/footer.inc';
?>

<?php
  if(!empty($_POST)) {
    include_once 'lib/db.php';
    $db = new DB();
    $sql = "SELECT * FROM user WHERE username='" . $_POST["username"] . "' AND password='" . sha1($_POST["password"]) . "'";
    $user = $db->get($sql);
    if(!empty($user)) {
      $_SESSION["user_id"] = $user[0]["id"];
      $_SESSION["user"] = $user[0]["username"];
      header("location: index.php");
    }
  }
?>

<?php
    else:
        header("location: index.php");
    endif;
?>
