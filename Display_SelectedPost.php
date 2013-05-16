<?php

session_start();

include 'mainclass.php';

$UserID = $_SESSION['UserID'];
$postID = $_SESSION['postID'];

$action = new MainDAO();
$action->display_SelectedPost($UserID, $postID);