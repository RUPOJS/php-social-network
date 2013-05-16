<?php

class BaseDAO {
    private $dbhost = 'mysql:host=localhost';
    private $dbname = 'dbname=project';
    private $username = "root";
    private $password = "";
    
    function openCon() {
        $this->dbCon = new PDO($this->dbHost.$this->dbName,  $this->username,  $this->password);
    }
    
    function closeCon() {
        $this->dbCon = null;
    }
    
}
    

?>
