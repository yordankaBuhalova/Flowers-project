<?php
  // Страница за влизане в административната част
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
  // Проверка на потребителя
  if(!empty($_POST)) {
    include_once 'lib/db.php';
    $db = new DB();
    $sql = "SELECT * FROM user WHERE username='" . $_POST["username"] . "' AND password='" . sha1($_POST["password"]) . "'";
    $user = $db->get($sql);
    if(!empty($user)) {
      // запазване на пк и името на потребителя в сесийни променливи
      $_SESSION["user_id"] = $user[0]["id"];
      $_SESSION["user"] = $user[0]["username"];
      // препрати към начало
      header("location: index.php");
    }
    else {
      // при грешки
      echo "<div class='alert alert-danger' role='alert'>Грешка: невалидни потребителско име и/или парола!</div>";
    }
  }
?>

<?php
    else:
        // Ако потребителят е вече логнат препрати към начало
        header("location: index.php");
    endif;
?>
