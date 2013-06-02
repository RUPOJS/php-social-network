<?php

  session_start();

  include 'DAO/MainDAO.php';
  
  $UserID = $_SESSION['UserID'];
  $action = new MainDAO();
  $action -> countNotifications($UserID);
