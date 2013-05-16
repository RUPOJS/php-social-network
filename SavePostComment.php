<?php

session_start();

include 'mainclass.php';

$UserID = $_SESSION['UserID'];
$PostID = $_SESSION['postID'];
$Comment_date_time = $_SESSION['date_time'];
$Comment = $_POST['post_comment'];
$Comment = trim($Comment);
$Comment = htmlentities($Comment);
$Comment = nl2br($Comment);
$type = "comment";
$action = new MainDAO();
$action->savePostComment($UserID, $PostID, $Comment, $Comment_date_time);
$action->saveToNotifications($UserID, $PostID, $type);
?>
