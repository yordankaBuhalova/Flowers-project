<?php
// Страница за изход
    ob_start();
    session_start();
    $_SESSION = [];
    // закрива се сесията
    session_destroy();
    // Пренасочва към началната страница на сайта
    header("location: index.php");
    exit;
?>