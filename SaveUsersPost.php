<?php

    session_start();
    
    include 'DAO/MainDAO.php';
    
    $UserID = $_SESSION['UserID'];
    $P_date = $_POST['P_date'];	
    $Users_Post = nl2br($_POST['users_post']);
    $Users_Post = trim($Users_Post);
    $Users_Post = htmlentities($Users_Post);
   
    
    $action = new MainDAO();
    
    $action->saveUsersPost($UserID,$Users_Post,$P_date);



?>
