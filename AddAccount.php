<?php

include 'AccountsConfig.php';

$NewProfilePic = 'images/p.jpg';
$data = $_POST['data'];
$decoded = json_decode($data,true);

foreach ($decoded as $info) {
    $info['name'] = $info['value'];
}

$action = new AccountsDAO();
$action->AddAccount($firstname, $lastname, $nickname, $email, $password, $gender, $bdate, $age, $NewProfilePic);
?>
