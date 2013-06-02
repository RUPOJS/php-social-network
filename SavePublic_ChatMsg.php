<?php
   session_start();
   
   include 'DAO/MainDAO.php';
   
   $UserID = $_SESSION['UserID'];
   $msg = $_POST['msg'];
   $msg = trim($msg);
   $msg = htmlentities($msg);
   
   $action = new MainDAO();
   
   $action -> saveChatMsg($UserID,$msg); 


?>
