<?php
    session_start();
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

    <button type="submit" class="btn btn-primary">Вход</button>
  </form>
  Click here to clean <a href = "login.php" tite = "Logout">Session.
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
    $_SESSION["user_id"] = $user["idadmin"];
    $_SESSION["user"] = $user["username"];
    header("Location: index.php");
  }

}

?>

<?php
/*
   session_start();
   unset($_SESSION["username"]);
   unset($_SESSION["password"]);

   echo 'You have cleaned session';
   header('Refresh: 2; URL = login.php');
*/
?>
