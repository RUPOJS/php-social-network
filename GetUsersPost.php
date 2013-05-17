<?php


session_start();

include 'mainclass.php';

$UserID = $_SESSION['UserID'];
$action = new MainDAO();
$action->getUsersPost($UserID);


?>
