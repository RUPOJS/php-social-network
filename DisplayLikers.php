<?php

include 'mainclass.php';

$postID = $_POST['postID'];

$action = new MainDAO();
$action->displayLikers($postID);
