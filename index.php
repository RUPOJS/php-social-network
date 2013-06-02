<?php
	session_start();
	
	include 'DAO/AccountsDAO.php';
	$action = new AccountsDAO();
	if(isset($_SESSION['UserID'])){
		header('Location:mainpage.php');
	}else if(isset($_POST['email']) && isset($_POST['password'])){
		$verrified = $action -> LogInUser($_POST['email'],$_POST['password']);
		if($verrified){
			$UserID = $action->GetUseriD_SetUserStatus($_POST['email']);
			$_SESSION['UserID'] = $UserID;
			header('Location: mainpage.php');
		}else{
			$errMsg = "<div class='ErrorMsg'>Unknown User!</div>";
			
		}
	}
	
	

?>

<!DOCTYPE HTML>
<html>

<head>
	<link rel='stylesheet' type='text/css' href='css/index.css'/>
	<link rel="stylesheet" href="http://code.jquery.com/ui/1.9.2/themes/base/jquery-ui.css" />
	<script type='text/javascript' src='js/jquery.js'></script>
	<script type='text/javascript' src='js/jquery-ui-darkhive.js'></script>
	<script type='text/javascript' src='js/indexscript.js'></script>
	<title>Welcome to SocNet</title>
</head>
<body>
	<div class='wrapper'>
		<input type='hidden' name='UserID' value=<?php if(isset($UserID)){echo "'".$UserID."'";}?>/><!--Sets the ID of the User-->
		<div class='header'>
				<div id="logo"> <span class='span-title'>NiTConneCT</span></div>
					<form method='POST'>
						<label for='email'></label>
						<input type='text' name='email' id='username-email' placeholder="Email"/>
						<label  for='password'></label>
						<input type='password' name='password' id='password' placeholder="Password"/>
						<input type='submit' value='Log In' id='btn_login'/>
					</form>
			<?php
				
				if(isset($errMsg)){
					echo $errMsg;
				}
			
			?>
		</div><!--end tag div with a class header-->
		
		<div class='div-center'>
			<div class='div-left'>
				<img src='images/pic1.jpg' class='slideImages' id= 'slideImg_1' alt=''  />
				<img src='images/pic2.jpg' class='slideImages' id= 'slideImg_2' alt='' />
				<img src='images/pic3.jpg' class='slideImages' id= 'slideImg_3' alt='' />
				<img src='images/pic4.jpg' class='slideImages' id= 'slideImg_4' alt='' />
				<img src='images/pic5.jpg' class='slideImages' id= 'slideImg_5' alt='' />
				<img src='images/pic6.jpg' class='slideImages' id= 'slideImg_6' alt='' />
				<img src='images/pic7.jpg' class='slideImages' id= 'slideImg_7' alt='' />
			</div><!--end tag for class div-left-->
			
			<div class='div-right-signup'>
				<h3 class='h3signup'><span>New User?Sign Up</span> <br/> </h3>
				
				<form id='Registration_form'>
					<div class='div-signup-header-alert-msg' id='div-signup-header-alert-msg'><small class='signup-alert-msg'></small></div>
					
					<input type='text' id='firstname' name='firstname' class='Register_name' placeholder='Firstname' title="ENTER YOUR FIRST NAME"/><br/>
					
					
					<input type='text' id='lastname' name='lastname' class='Register_name' placeholder='Lastname' title="ENTER YOUR LAST NAME"/><br/>
					
					
					<input type='text' id='nickname' name='nickname' class='Register_name' placeholder='Nickname' title="ENTER YOUR NICKNAME"/>
					
					<p>
					<input type='text' id='emailadd' name='emailadd'  placeholder = 'Email Address' title="ENTER YOUR EMAIL ADDRESS"/>
					<div class='div-alert-for-signup' id='alert-for-email'><small class='small' id='msg-email'></small></div>
					</p>
					<p>
					<input type='password' id='passW' name='passW' placeholder='Password' title="ENTER YOUR PASSWORD"/>
					<div class='div-alert-for-signup' id='alert-for-password'><small class='small' id='msg-password'></small></div>
					</p>
					<p>
					<input type='password' id='repassword' name='repassword' placeholder="Re-enter Password" title="RE-ENTER YOUR PASSWORD"/>
					<div class='div-alert-for-signup' id='alert-for-repassword'><small class='small' id='msg-repassword'></small></div>
					</p>
					
					<select id='gender' name='gender' title="SELECT GENDER">
						<option value="">Gender</option>
						<option value="Male">Male</option>
						<option value="Female">Female</option>
					</select>
					<input type='text' id='bdate' name='bdate'  placeholder = 'Birthdate' title="WHAT IS YOUR BIRTHDATE" readonly>
					<p>
					<input type='hidden' name='age' id='age' />
					
				</form>
					<button id='btn_signup'>Sign-Up</button>
			</div><!--end tag for class div-right-signup-->
		</div><!--end tag for class div-center-->
	</div><!--end tag div with a class wrapper-->
</body>

</html>
