<?php

session_start();

include 'mainclass.php';

$UserID = $_SESSION['UserID'];
$P_date = $_POST['P_date'];
$Users_Post = nl2br($_POST['$Users_Post']);
$Users_Post = trim($Users_Post);
$Users_Post = htmlentities($Users_Post);

$action= new MainDAO();

$action->saveUsersPost($UserID, $Users_Post, $P_date);
?>
