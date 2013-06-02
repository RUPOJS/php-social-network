<?php

include 'DAO/MainDAO.php';

$postID = $_POST['postID'];

$action = new MainDAO();
$action -> displayLikers($postID);