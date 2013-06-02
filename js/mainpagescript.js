
$(document).ready(function(){
  
   var pub_chat_interval;
   var pub_post_interval;


	/*Setting Options Area*/
	SetIntervalForPost();
	RefreshPost();

	/*Uploading New Profile Picture Area*/
	$('#span-change-pic').click(function(){
		$('#div-editp-option').slideToggle();	
	});

	$('#li-upload_pic').click(function(){
		$('#div-form-upload-profile-pic').show();
		$('#div-editp-option').hide();
	});
	$('#li-choose_pic').click(function(){
		alert("Unfinished..\nSorry");
	})
	$('#btn_saveNewPic').click(function(){
		$('#div-loading').show().fadeIn(1000);
		$('#div-loading').fadeOut(10000);
	});

	$("#div-update-upload span").click(function(){
		alert("Unfinished..\nSorry..");

	});

	/*Making Post On Wall*/

	$('#btn_post').click(function(){
	   
	    var presentDate = GetPresentDate();
	    var user_post=$('#post-message').val();

	    var obj = {'users_post':user_post, 'P_date':presentDate};
		
		
			$.ajax({
				type:'POST',
				url: 'SaveUsersPost.php',
				data:obj,
				success:function(data){
					$('#post-message').val("");
					RefreshPost();
				},
				error:function(data){
					alert("Error on posting => " + data);
				}
			
			});
		
	});


	/*close inlarge picture*/
	
	$('.close_btn').click(function(){
		$('#overlay').hide();		
	})
		
	//Counts the notification of Comments ...-note: Not Permanent!!
	setInterval(function(){
		CountNotifications();
	},3000);
	
	

	
	/*----------------------------------------*/
	
	/*Chat Area..*/
	$('#chat-form').submit(function(){
	   var msg = $('input[name=chat-message]').val();

		 var obj = {'msg':msg};
	  
	   $.ajax({
	      type:'POST',
	      url:'SavePublic_ChatMsg.php',
	      data:obj,
	      success:function(data){
	         console.log(data);
	      },
	      error:function(data){
	         alert("Error on saving public chat message => " + data);
	      } 
	   
	   });
	   
	   $('input[name=chat-message]').val("");
	   return false;
	
	});
	
	$('#span-pchat').click(function(){
		$('#div-tbl-for-chat').slideToggle(1000);
		//refreshes the messages on chat!
		pub_chat_interval = setInterval(function(){
		   $.ajax({
			  type:"GET",
			  url:"RefreshPubChat.php",
			 
			  success:function(data){
				
				$('#div-for-main-table').html(data);
			  },
			  error: function(data){
				 alert("Something went wrong may be low server capacity, try again later");
			  }
		   });  
		   
		},1000);
	});
	//stops the interval
	/*add some codes below (clearInterval)*/

	$('#div-for-online').click(function(){//not permanent
		$('#div-tbl-for-chat').hide(1000);
		clearInterval(pub_chat_interval);
	});
	
	/*===========================Notification-Area [comment only :(]===================================*/
	
	$('#div-notifications').click(function(){

		$('#div-notifications-list').slideToggle(1000);
			 
			displayNotifications();

    });

	
});
function SetIntervalForPost(){

	//refreshes the wall -note: Not Permanent!
	pub_post_interval=setInterval(function(){
	
		RefreshPost();
	  
	},10000);

}

function StopPostInterval(){
	clearInterval(pub_post_interval);
}

function RefreshPost(){
    $('#div-loading-post').show();
	$.ajax({
	        type:'POST',
	        url: 'GetUsersPost.php',
	        success:function(data){
	           $('#div-displayed-post').html(data);
	        },
	        error:function(data){
	            alert("Error on posting => " + data);
	        },
            complete:function(){
                $('#div-loading-post').hide();
            }
	    
	}); 
}
function GetPresentDate(){
    var date = new Date();
    var yr = date.getFullYear();
    var mn = date.getMonth()+1;
    var day = date.getDate();
    
    return yr+"-"+mn+"-"+day;
    
}

/*Like on Post*/

function Post_status(postID){

	var status = $('#Post'+postID +' .like_btn').html();
	var obj = {'id':postID,'status':status};

	$.ajax({
		type: 'POST',
		url: 'UpdatePostStatus.php',
		data: obj,
		success: function(data){
		
			var numLikes = parseInt($('#disp_post_'+postID +' .likes').html());
			if(status==' Like'){
				$('#disp_post_'+postID +' .like_btn').html("Unlike");
				$('#disp_post_'+postID +' .likes').html(numLikes+1);			
			}else{
				$('#disp_post_'+postID +' .like_btn').html("Like");				
				$('#disp_post_'+postID +' .likes').html(numLikes-1);
			}

			RefreshPost();
		},
		error: function(data){
			alert('Error on Changing Post Status =>'+data);
		}
	
	});

}

function displayLikers(postID){

    var obj = {postID:postID};
    $.ajax({
        type: 'POST',
        url: 'DisplayLikers.php',
        data: obj,
        success: function(data){
           var test = JSON.parse(data);
           var likers = "";
           for(var ctr=0; ctr<test.length; ctr++){
               likers += test[ctr]+" <br />";
           }

           $('#Post'+postID +' .likers').show();
           $('#Post'+postID +' .likers').html("<span class='closeLikers' onClick='closeLikers("+postID+")'>x</span> <br/>"+likers);

        },
        error: function(data){
            alert('Error on Displaying Users Who Liked this Post =>'+data);
        }

    });

}

function closeLikers(postID){
    $('#Post'+postID +' .likers').hide();
}


function Remove_post(postID){

	var obj = {'id':postID};
	alert('Still Working.. \n Alert la ito!')
	/*$.ajax({
		type:'POST',
		url:'RemovePost.php',
		data:obj,
		success:function(data){
			console.log(data);
				
		},
		error: function(data){
			alert('Error on Changing Post Status');
		}
	
	});*/
}
	
function InlargeProfilePic(profile_img){
	
	var inlarge_img = "<img src='"+profile_img+"' alt='Profile Image' class='inlarge_pic'/>";
	$('#div-displayed-selected-post').hide();	
	$('#overlay').show();
	$('.inlarge_img_displayer').html(inlarge_img);

	
}


	/*Comment in Post*/
	
function SavePostComment(postID,type){

 	 /*if type is true, it refers to the users post in the main page,
		but if it is false, it refers to the Post that has been view from notifications..	
	*/

  var comment ="";
  if(type){
   	comment = $('#post_comment_'+postID).val();
  }else{
    comment = $('#select_post_comment_'+postID).val();
  }

  	var date_time = getCurrentDateAndTime();
	var obj = {'postID':postID,'post_comment':comment, 'date_time':date_time};
	var flag=true;

	$.ajax({
	
		type:'POST',
		url:'SavePostComment.php',
		data:obj,
		success:function(data){

			if(!type){				
				Display_SelectedPost(postID,flag);
			}
			RefreshPost();
			$('#post_comment_'+postID).val("");
      		$('#select_post_comment_'+postID).val("")
		},
		error: function(data){
			alert('Error on Post Comment => '+ data);
		}
		
	});
		
}

function CountNotifications(){

  $.ajax({
		  type:'POST',
		  url:'CountNotifications.php',
		  success:function(data){
		  //	alert(data);
		    $('.Notification_Num').html(data);
		  },
		  error:function(data){
		    alert(data);
		  }
	});


}

function displayNotifications(){

	 $.ajax({
	    type:'POST',
	    url:'DisplayNotification.php',
	    success:function(data){
	      $('#div-notifications-list').html(data);
	    },
	    error:function(data){
	      alert(data);
	    }
	 });
}

function Display_SelectedPost(postID,flag){

    var obj = {postID:postID};
    
    $.ajax({
		  type:'POST',
		  url:'Display_SelectedPost.php',
		  data:obj,
		  success:function(data){
		  	$('#overlay').show();
		  	$('.inlarge_img_displayer').hide();
		    $('#div-displayed-selected-post').show();		    
		    $('.div-displayed-selected-post-content').html(data);
		    $('#div-notifications-list').hide();
		    
		  },
		  error:function(data){
		    alert(data);
		  }
	});
    
}
function Close_selected_post(){
  $('#div-displayed-selected-post').hide();
}

function getCurrentDateAndTime(){

	var currentdate = new Date();
	var yr = currentdate.getFullYear();
	var mn = currentdate.getMonth()+1;
	var dt = currentdate.getDate();
	var hrs = currentdate.getHours();
	var mnts = currentdate.getMinutes();
	var secs = currentdate.getSeconds();
	var date_time = yr+"-"+mn+"-"+dt+" "+hrs+":"+mnts+":"+secs;
	return date_time;

}




















