<?php
session_start();
	include 'connect.php';
	if (post('status')) {
		$status = post('status');


		switch($status){
			case 'upload_profile':
				if(!empty($_FILES['file']['name'])){
					$file = $_FILES['file']['name'];
					move_uploaded_file($_FILES['file']['tmp_name'],'upload/'.$file);
					connect("UPDATE `login` SET `profile` = '".$file."' WHERE `login`.`id` = '".$_SESSION['admin_id']."' ");
					echo 'upload/'.$file;
				}
			break;
			case 'login':
				$res = connect("SELECT * FROM login WHERE username = '".post('username')."' AND password = '".post('password')."'");
				if($res->num_rows){
					$row = $res->fetch_assoc();
					$_SESSION['admin'] = true;
					$_SESSION['admin_id'] = $row['id'];
					$_SESSION['username'] = $row['username'];
					redirect();
				}
				else
					redirect('login','action=wrong_password');
			break;
			case 'create_a/c':
				connect("INSERT INTO login (id,username,password,name) VALUES (NULL,'".$_POST['username']."','".$_POST['password']."','".$_POST['name']."')");
				redirect();

			break;
			case 'checkProfile':
				$user = connect("SELECT * FROM login WHERE name = '".$_POST['val']."' OR username = '".$_POST['val']."' ");
				$html = 0;
				if($user->num_rows){
					$html = '<ul class="contacts">';
					while($row = $user->fetch_assoc()){
						$html .= '<li class="list_group ">
										<input type="hidden" name="user_id[]" value="'.$row['id'].'">
										<div class="d-flex bd-highlight">
											<div class="img_cont">
												<img src="upload/'.$row['profile'].'" class="rounded-circle user_img">
												<span class="online_icon"></span>
											</div>
											<div class="user_info">
												<span>'.$row['name'].'</span>
												<p>'.$row['username'].'</p>
											</div>
										</div>
										<a href="javascript:void()" class="closeBtn">
											<i class="fa fa-times"></i>
										</a>
								</li>';
					}
					$html .= '</ul>';
				}
				echo $html;
			break;
			case 'msg':
				$msg = trim($_POST['msg']);
				$user_id = 'null';
				if(isset($_POST['user_id']))
					$user_id = json_encode($_POST['user_id']);
				if(!empty($msg))
					connect("INSERT INTO `massage` (`id`, `time`, `sender_id`, `receiver_id`, `massage`,`user_id`) VALUES (NULL, CURRENT_TIMESTAMP,'".$_POST['sender_id']."', '".$_POST['receiver_id']."', '".$_POST['msg']."','".$user_id."')");
				//redirect('index','id='.$_POST['receiver_id']);
				echo 1;
			break;
			case 'allMsg':
				$msg = connect("SELECT * FROM massage WHERE ( sender_id = '".$_SESSION['admin_id']."' AND receiver_id = '".$_POST['rid']."' ) OR  ( receiver_id  = '".$_SESSION['admin_id']."' AND sender_id = '".$_POST['rid']."' ) ");


				if($msg->num_rows):
					$id = 1;
					while($m = $msg->fetch_assoc()):
						//echo ;
						$time = date('h : i A',strtotime($m['time']));
						$class = $_SESSION['admin_id'] == $m['sender_id'] 
										?	 'end'
										:	  'start';

						echo '<div class="d-flex justify-content-'.$class.' mb-4">';

						if($m['sender_id'] != $id):
							$id = $m['sender_id'];

						echo '<div class="img_cont_msg">
									<img src="https://static.turbosquid.com/Preview/001292/481/WV/_D.jpg" class="rounded-circle user_img_msg">
								</div>';
						endif;
						echo '<div class="msg_cotainer" style="min-width:100px">';

						

						if($m['user_id'] != 'null'):
							
							$usersid = json_decode($m['user_id'],true);
							echo '<ul class="contacts" style="width:400px">';
							foreach($usersid as $userID){
								$userRow = connect("SELECT * FROM login WHERE id = '".$userID."'");
								if($userRow->num_rows):
									$userRow = $userRow->fetch_assoc();
									echo '<li class="list_group ">
											<div class="d-flex bd-highlight">
												<div class="img_cont">
													<img src="upload/'.$userRow['profile'].'" class="rounded-circle user_img">
													<span class="online_icon"></span>
												</div>
												<div class="user_info">
													<span>'.$userRow['name'].'</span>
													<p>'.$userRow['username'].'</p>
												</div>
											</div>
									</li>';
								endif;
							}
							echo '</ul>';
						elseif(!$m['isDeleted']):
							
								echo $m['massage'].'
										<a class="delete-btn delbutton" id="'.$m['id'].'" href="javascript:void()"><i class="fa fa-trash" ></i></a>
										<span class="msg_time"> '.$time.' , Today</span>
									';
					
						else:
							echo '<i style="color:red">This Mesasge was Deleted.</i>';
						endif;
						echo '</div></div>';

					endwhile;
				endif;
			break;
		}
	}
	elseif(isset($_GET['status'])){
		switch ($_GET['status']) {
			case 'delete_msg':
				connect("UPDATE `massage` SET `isDeleted` = '1' WHERE `massage`.`id` = '".$_GET['id']."'");
				//redirect('index','id='.$_GET['rid']);
				echo 1;
			break;
			
			default:
				// code...
				break;
		}
	}
	?>
