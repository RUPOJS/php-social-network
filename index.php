<?php
  session_start();  //starting the session
	
	include 'AccountsConfig.php'; //include the account config
	$action = new AccountsDAO();
	if(isset($_SESSION['UserID'])){ //if logged in
		header('Location:mainpage.php'); //redirect the page to Mainpage
	}else if(isset($_POST['email']) && isset($_POST['password'])){
		$verrified = $action -> LogInUser($_POST['email'],$_POST['password']); //calling the function to verify the appropriate credentials.
		if($verrified){
			$UserID = $action->GetUseriD_SetUserStatus($_POST['email']);
			$_SESSION['UserID'] = $UserID;
			header('Location: mainpage.php'); //if verified redirect
		}else{
			$errMsg = "<div class='ErrorMsg'>Unknown User!</div>"; //otherwise show the error msg
			
		}
	}
	
	

?>

<!DOCTYPE HTML>
<html>

<head>
	<link rel='stylesheet' type='text/css' href='css/index.css'/>
	<link rel='short icon' href='images/messenger.png' />
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
			<div class='div-bg-header'>
				<div class='div-img'><img src='images/messenger.png'/></div>
				<span class='span-title'>SocNet</span>
				<div class='div-login-form'>
					<form method='POST'>
						<label for='email'>Email Add:</label>
						<input type='text' name='email' id='username-email'/>
						<label  for='password'>Password:</label>
						<input type='password' name='password' id='password'/>
						<input type='submit' value='Log In' id='btn_login'/>
					</form>
				</div><!--end tag for class div-login-form-->
			</div><!--end tag for class div-bg-header-->
			<?php
				
				if(isset($errMsg)){
					echo $errMsg;
				}
			
			?>
		</div><!--end tag div with a class header-->
		
		<div class='div-center'>
			<div class='div-left'>
				<img src='images/bgimg1.jpeg' class='slideImages' id= 'slideImg_1' alt='img'  />
				<img src='images/bgimg2.jpg' class='slideImages' id= 'slideImg_2' alt='dadzky33@gmail.com && ramzsweet16@gmail.com' />
				<img src='images/bgimg3.jpeg' class='slideImages' id= 'slideImg_3' alt='Makers' />
				<img src='images/bgimg4.jpg' class='slideImages' id= 'slideImg_4' alt='Makers' />
				<img src='images/bgimg5.jpg' class='slideImages' id= 'slideImg_5' alt='Makers' />
				<img src='images/bgimg6.jpg' class='slideImages' id= 'slideImg_6' alt='Makers' />
				<img src='images/bgimg7.jpg' class='slideImages' id= 'slideImg_7' alt='Makers' />
				<p class='img_pg'><span id='NumberOfPage'>1</span>/7</p>
			</div><!--end tag for class div-left-->
			
			<div class='div-right-signup'>
				<h3 class='h3signup'><span>Sign Up</span> <br/> </h3>
				
				<form id='Registration_form'>
					<div class='div-signup-header-alert-msg' id='div-signup-header-alert-msg'><small class='signup-alert-msg'></small></div>
					<p>
					<input type='text' id='firstname' name='firstname' class='Register_name' placeholder='Firstname' title="ENTER YOUR FIRST NAME"/>
					
					<p>
					
					<input type='text' id='lastname' name='lastname' class='Register_name' placeholder='Lastname' title="ENTER YOUR LAST NAME"/>
					
					<p>
					
					<input type='text' id='nickname' name='nickname' class='Register_name' placeholder='Nickname' title="ENTER YOUR NICKNAME"/>
					<p>
					
					<input type='text' id='emailadd' name='emailadd'  placeholder = 'Email Address' title="ENTER YOUR EMAIL ADDRESS"/>
					<div class='div-alert-for-signup' id='alert-for-email'><small class='small' id='msg-email'></small></div>
					<p>
					
					<input type='password' id='passW' name='passW' placeholder='Password' title="ENTER YOUR PASSWORD"/>
					<div class='div-alert-for-signup' id='alert-for-password'><small class='small' id='msg-password'></small></div>
					<p>
					
					<input type='password' id='repassword' name='repassword' placeholder="Re-enter Password" title="RE-ENTER YOUR PASSWORD"/>
					<div class='div-alert-for-signup' id='alert-for-repassword'><small class='small' id='msg-repassword'></small></div>
					<p>
					
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
