<?php

	include 'DAO/BaseDAO.php';
	
	class AccountsDAO extends BaseDAO{
	
		function LogInUser($email,$password){
		
			$this->openCon();
			
			   $incryptedPass = md5($password);
				$sql = 'SELECT * FROM users WHERE email_add = ? AND password = ?';
				$stmt = $this->dbCon->prepare($sql);
				$stmt->bindParam(1,$email);
				$stmt->bindParam(2,$incryptedPass);
				$stmt->execute();
			
			$this->closeCon();
			
			$row = $stmt->fetch();
			if($row[0] == "" || $row[0] == null){
				return false;
			}else{
				return true;
			}
		}
		
		function LogOutUser($User_id){
		
			$this->openCon();
			
				$sql = "UPDATE users SET status = 'offline' WHERE usersID=?";
				$stmt = $this->dbCon->prepare($sql);
				$stmt->bindParam(1,$User_id);				
				$stmt->execute();
			
			$this->closeCon();
		
		}
		function GetUseriD_SetUserStatus($email){
		
			$this->openCon();
				
				$sql = 'SELECT usersID FROM users WHERE email_add = ?';
				$stmt = $this->dbCon->prepare($sql);
				$stmt->bindParam(1,$email);				
				$stmt->execute();
				
				$UserID = $stmt->fetch();
				$sql = "UPDATE users SET status ='online' WHERE usersID = ?";
				$stmt = $this->dbCon->prepare($sql);
				$stmt->bindParam(1,$UserID[0]);				
				$stmt->execute();
			
			$this->closeCon();
			
			return $UserID[0];
			
		}
		
		function AddAccount($firstname,$lastname,$nickname,$email,$password,$gender,$bdate,$age,$NewProfilePic){
			
			$this->openCon();
			   
			   $incryptedPass = md5($password);
				$sql = 'INSERT INTO users(email_add,password) values(?,?)';
				$stmt = $this->dbCon->prepare($sql);
				$stmt->bindParam(1,$email);
				$stmt->bindParam(2,$incryptedPass );
				$stmt->execute();
			
				$usersID = $this->dbCon->lastInsertId();
				$sql = 'INSERT INTO users_info values(null,?,?,?,?,?,?,?)';
				$stmt = $this->dbCon->prepare($sql);
				$stmt->bindParam(1,$usersID);
				$stmt->bindParam(2,$firstname);
				$stmt->bindParam(3,$lastname);
				$stmt->bindParam(4,$nickname);
				$stmt->bindParam(5,$gender);
				$stmt->bindParam(6,$bdate);
				$stmt->bindParam(7,$age);
				$stmt->execute();

				$sql = "INSERT INTO profile_pics VALUES(null,?,?)";
				$stmt = $this->dbCon->prepare($sql);
				$stmt->bindParam(1,$usersID);
				$stmt->bindParam(2,$NewProfilePic);
				$stmt->execute();
							
			$this->closeCon();
		
		}
	
	}
