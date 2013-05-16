<?php

include 'mainclass.php';

$name = $_POST['name'];
$action = new MainDAO();
$action->getListOfUsers($name);
?>
