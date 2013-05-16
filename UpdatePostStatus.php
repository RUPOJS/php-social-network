<?php

session_start();

include 'mainclass.php';

$userID = $_SESSION['UserID'];
$postID = $_POST['id'];
$status = $_POST['status'];
$status = trim($status);
$type = "like";
$action = new MainDAO();
$action->updatePostStatus($postID, $userID, $status);
$action->saveToNotifications($UserID, $PostID, $type);
?>
