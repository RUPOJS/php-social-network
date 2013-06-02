<?php
	
	session_start();
	
		include 'DAO/MainDAO.php';
		$action = new MainDAO();
		if(!isset($_SESSION['UserID'])){
			header('Location:index.php');
		}else if(isset($_FILES['Profile_pic'])){
			 $name = $_FILES['Profile_pic']['name'];
			  $type = $_FILES['Profile_pic']['type'];
			  $error = $_FILES['Profile_pic']['error'];
			  $tmp_name = $_FILES['Profile_pic']['tmp_name'];
			  $directory = "images/";
		   if($error>0){
			  $ErrorPicMsg =  "Error on Uploading File =>".$error;
		   }else if($type == 'image/jpg' || $type == 'image/jpeg' || $type == 'image/png' || $type == 'image/gif' ){
		   
				move_uploaded_file($tmp_name, $directory.$name);
				$NewProfilePic = $directory.$name;
			    $action -> saveUploaded_Img($_SESSION['UserID'],$NewProfilePic);
  			  
		   }else{
			  $ErrorPicMsg = 'Unsupported Format';
		   }
		}

		
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml ">
<head>
	<meta http-equiv="Content-Type" content="text/html";charset=utf-8"/>
	<link rel='stylesheet' type='text/css' href='css/main.css'/>
	<link rel="short icon" href='images/messenger.png' />
	<script type='text/javascript' src='js/jquery.js'></script>
	<script type='text/javascript' src='js/mainpagescript.js'></script>
	
	<title>SocNet-mainpage</title>
</head>
<body>
	<div id='div-wrapper'>
		<div id='div-header'>
			<div id='div-logo'><span class='uLinked'>NiTConneCT</span></div>
				<!--input type='text' name='searchFriends' id='searchFriends' placeholder="Search for people [not fixed]"/ -->
				<div id='div-notifications'>Notifications[<span class='Notification_Num'><img src='images/loading.gif' alt='Loading' /></span>]</div>
          <div id='div-notifications-list'></div>				
				
				
			
			<div id='div-navigation'>
				<ul>
					
					<!--<li><a href='#' id='home'>Home</a></li>
					<li><a href='#' id='setting'>Settings</a>
						<ul id='set'>
							<li><a href='#' id='accountSet'>Account Settings</a></li>
							<li><a href='#' id='privacySet'>Privacy Settings</a></li>
						</ul>
					</li>
					<li><a href='#' id='Friends'>Friends</a></li>-->
					<li><a href='logout.php' id='Logout'>Logout</a></li>
					
				</ul>
			</div>
		</div><!--end div tag (id div-header)-->
		
		<div id='div-maincontent'>
		
			<div id='div-leftcontent'>

				<div id='div-leftcontent-profilepic'>
					<div id='div-image-hover'>
						<span class='Profile_Image'>
							
								 <?php
									$profile_img = $action -> getUsersProfile_Pic($_SESSION['UserID']);
									echo $profile_img;
								?>
							
						</span>
						
						<?php
							if(isset($ErrorPicMsg)){ 
								echo $ErrorPicMsg;
							}							
						?>
					</div>
					<div id='div-editprofile'><span id='span-change-pic'>CHANGE PROFILE PIC</span></div>
					<div id='div-form-upload-profile-pic'>
						<form enctype='multipart/form-data' id='ChangeProfile_Pic' method='POST' action='mainpage.php'>
							<input type='file' name='Profile_pic'/>
							<input type='submit' value ='Save' id='btn_saveNewPic' class='btn-for-upload'/>
						</form>
					</div>	
					<div id='div-editp-option'>
						<ul>
							<li id='li-upload_pic'><small>Upload Photo</small></li>
						</ul>
					</div>
					
					
					<!--end div tag (id div-form-upload-profile-pic)-->
					
						<!--Sets the Name of the User-->
						<?php						
							echo $action->GetUserFullName($_SESSION['UserID']);
						?>
				</div><!--end div tag (id div-leftcontent-profilepic)-->
				
				<div id='div-for-public-chat'>
					<h3 id='span-pchat'>Public Chat</h3>
					<div id='div-tbl-for-chat'>
					
					  <div id='div-for-online'><span id='count-online'><?php echo $action->countUsersOnline();?> <small>Online user(s)</small></span></div>
					  
					   <div id='div-for-main-table'>					    
					  </div><!--end div tag (id div-for-main-table)-->
					  
					  <div id='div-for-chat-form'>
					    <form id='chat-form' method='POST'>
					       <input type='text' name='chat-message' id='chat-message'/>
					       <!--input type='submit' value='Send' id='btn_SendChat'/-->
					    </form>
					   </div>
					   
					</div>
				</div><!--end div tag (id div-for-public-chat)-->
				
			</div><!--end div tag (id div-leftcontent)-->
			
			<div id='div-rightcontent'>
                
			
			    <div id='div-update-upload'>
			        <span id='span-updatestatus'>Update Status</span>
			        <span id='span-uploadphotos'>Upload Photos</span>
			    </div>
			    
			    <div id='div-for-post-area'>
			        <textarea name='post-message' id='post-message' cols="25" rows="1" placeholder="What's on your mind...."></textarea>
			        <div id='div-for-button'>
			            <button id='btn_post'>POST</button>
			        </div>
			        
			        <div id='div-displayed-post'>
			            
			        </div><!--end div tag (id div-displayed-post)-->
			        			       		        
			    </div><!--end div tag (id div-for-post-area)-->
			    
			</div><!--end div tag (id div-rightcontent)-->
			
		</div><!--end div tag (id div-maincontent)-->
		
		<div id='overlay'>
			<span class='close_btn'>close</span>
 			<div id='div-displayed-selected-post'>
	          	<div class='div-displayed-selected-post-content'> </div>			       			            
			</div><!--end div tag (id div-displayed-selected-post)-->	
			<div id='overlay_inlarge_rofilepic_content'>			
				<div class='inlarge_img_displayer'><div>
			</div><!--end content-->

		</div><!--end div overlay -->
	</div><!--end div tag (id div-wrapper)-->
</body>
</html>
