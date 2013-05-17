<?php
session_start();
include 'AccountsConfig.php';
$logout = new AccountsDAO();
if(isset($_SESSION['UserID'])) {
    session_destroy();
    session_unset();
    $logout ->LogOutUser($_SESSION['$User_id']);
    header('Location:index.php');
    } else {
        header('Location:index.php');
    }

?>
