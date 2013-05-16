<?php

session_start();

include 'mainclass.php';

$UserID = $_SESSION['UserID'];
$action = new MainDAO();
$action->countNotifications($UserID);
