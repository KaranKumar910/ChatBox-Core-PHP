<?php
session_start();
require 'connect.php';
if(!isset($_SESSION['admin'])){
	header('location:login.php');
}

$admin = connect("SELECT * FROM login WHERE id = '".$_SESSION['admin_id']."' ")->fetch_assoc();

?>
<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!DOCTYPE html>
<html>
<head>
<title>Chat</title>
<link rel="stylesheet" type="text/css" href="chat.css">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.min.css">
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.min.js"></script>
</head>
<style type="text/css">
.delete-btn{
display: none;
}
.msg_cotainer:hover .delete-btn{
display: inline-block;
}
.round-img{
	width: 100px;
	height: 100px;
	border-radius: 50%;
	border: 2px solid white;
	box-shadow: 0 0 10px 0 yellow;
}
.icon-profile{
	position: absolute;
    bottom: 14px;
    right: 54px;
    background: rgb(0,0,0,.6);
    text-align: center;
    padding: 12px;
    border-radius: 50%;
    border: 1px solid white;
}
.profile-card{
	display: none;
}
.list_group{
	position: relative;
}
.list_group .closeBtn{
	position: absolute;
	right: 8px;
	top: 10px;
	color: red;
}
</style>
<!--Coded With Love By Mutiullah Samim-->
<body>
<div class="container-fluid h-100">
<div class="row justify-content-center h-100">
<div class="col-md-4 col-xl-3 chat"><div class="card mb-sm-3 mb-md-0 contacts_card">
	<div class="card-header">
		<div class="input-group">
			<input type="text" placeholder="Search..." name="" class="form-control search">
			<div class="input-group-prepend">
				<span class="input-group-text search_btn"><i class="fas fa-search"></i></span>
			</div>
		</div>
	</div>
	<div class="card-body contacts_body">
		<ui class="contacts">
			<?php
			$list=	connect("SELECT * FROM login WHERE id != '".$_SESSION['admin_id']."' ");
			// echo '<pre>';
			// print_r($list);
			// exit();

 			if($list->num_rows):

				while($row = $list->fetch_assoc()):

				$active = '';
				if($row['id'] == $_GET['id'])
					$active = 'active';	
			?>
					<li class="list_group <?=$active?>">
						<a href="?id=<?=$row['id']?>">
							<div class="d-flex bd-highlight">
								<div class="img_cont">
									<img src="upload/<?=$row['profile']?>" class="rounded-circle user_img">
									
								</div>
								<div class="user_info">
									<span><?=ucwords($row['name'])?></span>
									<p><?=ucwords($row['name'])?> is online</p>
								</div>
							</div>
						</a>
					</li>
		<?php
			endwhile;
		endif;
		?>
		</ui>
	</div>
	<div class="card-footer"></div>
</div></div>
<div class="col-md-8 col-xl-6 chat">
	<?php
	if(isset($_GET['id'])):
		$user = connect("SELECT * FROM login WHERE id = '".$_GET['id']."' ")->fetch_assoc();
	?>
	<div class="card">
		<div class="card-header msg_head">
			<div class="d-flex bd-highlight">
				<div class="img_cont">
					<img src="upload/<?=$user['profile']?>" class="rounded-circle user_img">
					<!-- <span class="online_icon"></span> -->
				</div>
				<div class="user_info">
					<span>Chat with <?=ucwords($user['name'])?></span>
					<!-- <p>1767 Messages</p> -->
				</div>
			<!-- 	<div class="video_cam">
					<span><i class="fas fa-video"></i></span>
					<span><i class="fas fa-phone"></i></span>
				</div> -->
			</div>
			<span id="action_menu_btn" onclick="$('.action_menu').toggle()"><i class="fas fa-ellipsis-v"></i></span>
			<div class="action_menu">
				<ul>

					<li align="center" style="position:relative;"> 
						<label>
							<img class="round-img admin-image" alt="" src="upload/<?=$admin['profile']?>">
							<input id="sortpicture" style="display: none;" type="file" name="sortpic" />
							<i class="icon-profile fa fa-camera"></i>
						</label>
					</li>
					<li><i class="fas fa-users"></i> Add to close friends</li>
					<li><i class="fas fa-plus"></i> Add to group</li>
					<li><i class="fas fa-ban"></i> Block</li>
				</ul>
			</div>
		</div>
		<div class="card-body msg_card_body">
			
			
			

		</div>
		<div class="card-footer">
			<form method="POST" action="query.php" class='submit_msg'>
				<input type="hidden" name="status" value="msg">
				<input type="hidden" name="sender_id" value="<?=$_SESSION['admin_id']?>">
				<input type="hidden" name="receiver_id" value="<?=$user['id']?>">
				<div class="profile-card"></div>
				<div class="input-group">
					<div class="input-group-append">
						<span class="input-group-text attach_btn"><i class="fas fa-paperclip"></i></span>
					</div>

					<textarea name="msg" class="form-control type_msg" placeholder="Type your message..."></textarea>
					<div class="input-group-append">
						<button class="input-group-text send_btn"><i class="fas fa-location-arrow"></i></button>
					</div>
				</div>
			</form>
		</div>
	</div>
	<?php
	endif;
	?>
</div>
</div>
</div>
</body>
</html>
<script>
$(document).ready(function(){
//alert($('div').scrollTop()  - $('div').height());
 $('.msg_card_body').animate({
        scrollTop: $(this).outerHeight()
      }, 100);
});
</script>
<script type="text/javascript">

$('.type_msg').keyup(function(e){
	if(e.keyCode == 13){
		$('.submit_msg').submit();
		return false;
	}


	var val = $(this).val();

	if($.trim(val) != ''){
		$.ajax({
			type :'POST',
			url : 'query.php',
			data : {status : 'checkProfile', val : val},
			success:function(res){
				//console.log(res);
				if(res != 0){
					$('.profile-card').html(res).slideDown(500);
				}
				else{
					$('.profile-card').slideUp(500).html('');
				}
			}
		})
	}
	else
		$('.profile-card').slideUp(500).html('');
});


	$(".submit_msg").submit(function(x){
		x.preventDefault();

		// var form = $(this);
		// var url = form.attr('action');

		$.ajax({
			type : $(this).attr('method'),
			url  : $(this).attr('action'),
			data : $(this).serialize(),
			success : function(res){
				//alert(res);
				$('.submit_msg')[0].reset();
				print_msg();
				$('.profile-card').slideUp(500).html('');
			}
		})
	})
	setInterval(function(){ print_msg(); }, 500);
	function print_msg(){
		$.ajax({
			type : 'POST',
			url  : 'query.php',
			data : { status : 'allMsg', rid : '<?=@$_GET['id']?>'},
			success : function(res){
				$('.msg_card_body').html(res);
			}
		})
	}
	$(document).ready(function(){
 		$(".search").on("keyup", function() {
       		var value = $(this).val().toLowerCase();
       		$(".contacts li").filter(function() {
      			$(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
  });
});

$(document).on('click','.closeBtn',function(){
	$(this).closest('li').remove();
})

 $(function() {
$(document).on('click',".delbutton",function(){
var element = $(this);
var del_id = element.attr("id");
var info = 'id=' + del_id + '&status=delete_msg';
alert(info);
if(confirm("Are you sure you want to delete this Record?")){
    $.ajax({
        type: "GET",
        url: "query.php",
        data: info,
        success: function(){   
        	//element.html('<i style="color:red">This Mesasge Deleted.</i>');
    	}
});
    $(this).parents(".record").animate({ backgroundColor: "#fbc7c7" }, "fast")
    .animate({ opacity: "hide" }, "slow");
}
return false;
});
});
</script>
<script type="text/javascript">
$(function() {
$(".delbutton").click(function(){
var element = $(this);
var del_id = element.attr("id");
var info = 'id=' + del_id;
if(confirm("Are you sure you want to delete this Record?")){
    $.ajax({
        type: "GET",
        url: "deleteCourse.php",
        data: info,
        success: function(){   
    }
});
    $(this).parents(".record").animate({ backgroundColor: "#fbc7c7" }, "fast")
    .animate({ opacity: "hide" }, "slow");
}
return false;
});
});

/*++++++++++ Upload file with ajax jquery++++++++++++*/
$("#sortpicture").on("change", function() {
    var file_data = this.files[0] //$(this).prop("files")[0];   
    var image_name = file_data.name;
    var image_extension = image_name.split('.').pop().toLowerCase();

    if(jQuery.inArray(image_extension,['gif','jpg','jpeg','']) == -1){
      alert("Invalid image file");
      return false;
    }

    var form_data = new FormData();
    form_data.append("file", file_data);
    form_data.append("status", "upload_profile");
    //alert(form_data);
    $.ajax({
        url: "query.php",
        cache: false,
        contentType: false,
        processData: false,
        data: form_data,                         
        type: 'post',
        success: function(re){
            $('.admin-image').prop('src',re); 
        }
    });
});
// $(document).ready(function() {
//     $('list_group').click(function() {
//         $('list_group .active').removeClass("active");
//         $(this).addClass("active");
//     });
// });
</script>