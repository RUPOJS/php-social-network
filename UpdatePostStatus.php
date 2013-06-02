<?php
	session_start();
	include 'DAO/MainDAO.php';
	
	$userID=$_SESSION['UserID'];
	$postID=$_POST['id'];
	$status=$_POST['status'];
	$status = trim($status);
	$type = "like";
	$action = new MainDAO();
	$action -> updatePostStatus($postID,$userID,$status);
	$action->saveToNotifications($userID,$postID,$type)

?>
