<?php	
	session_start();
	include 'DAO/AccountsDAO.php';
	
	$logout = new AccountsDAO();
	if(isset($_SESSION['UserID'])){
		session_destroy();
		session_unset();
		$logout->LogOutUser($_SESSION['UserID']);
		header('Location:index.php');
	}else{
		header('Location:index.php');
	}
?>