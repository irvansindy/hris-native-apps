<?php 
!empty($_GET['emp_id']) ? $getdata = '1' : $getdata = '0'; 
if($getdata == 0) {
	include "../../application/session/session.php";
} else {
	include "../../application/session/mobile.session.php";	
}

							$param = $_POST['id_chat'];

							if( $_POST['id_chat']) {
								$param = $_POST['id_chat'];
							} else {
								$param = $_GET['id_chat'];
							}
                                                 //$param = 'WHIST2022-20220610150852';
							$modal=mysqli_query($connect, 

							"SELECT 
							a.*,
							x.avatar,
							x.nama,
							DATE_FORMAT(a.created_date, '%b %d') as whens,
							DATE_FORMAT(a.created_date, '%H:%i %p') as whens_hours
							
							FROM whstm_chat a
							LEFT JOIN users x on a.created_by=x.username
							WHERE a._whistle_id='$param'
							ORDER BY a._desc ASC
							");
							while($r=mysqli_fetch_array($modal)){
						?>
						<?php
						$updateRead = mysqli_query($connect, "UPDATE whstm_chat SET readflag='1' WHERE _whistle_id='$param' and created_by NOT LIKE '%$username%'");
						
						$flag = $r['flag'];
						$message = $r['message'];
						$image = $r['image'];
						
						$created = $r['created_by'];
						$data = mysqli_fetch_array(mysqli_query($connect, "SELECT full_name FROM teodempersonal WHERE emp_no = '$created'"));
						$namanya = $data['full_name'];

                                          if ($flag == 1 && $message != 'image')
						{
							echo '<div class="incoming_msg">
                                                            
                                                               <div class="received_msg">
                                                                      <div class="received_withd_msg">
                                                                             <p>'.$r['message'].'</p>
                                                                             <span class="time_date"> '.$r['whens_hours'].' | '.$r['whens'].'</span>
                                                                      </div>
                                                               </div>
                                                        </div>';
						} elseif ($flag == 1 && $message == 'image') {
							echo '<div class="incoming_msg">
                                                      
                                                               <div class="received_msg">
                                                                      <div class="received_withd_msg">
                                                                             <p><img src="../../asset/request.file.whistleblower.attachment/'.$image.'"></p>
                                                                             <span class="time_date"> '.$r['whens_hours'].' | '.$r['whens'].'</span>
                                                                      </div>
                                                               </div>
                                                        </div>';
						
						} elseif ($flag == 0 && $message != 'image') {
							echo '<div class="outgoing_msg">
                                                               <div class="sent_msg">
                                                                      <p>'.$r['message'].'</p>
                                                                      <span class="time_date"> '.$r['whens_hours'].' | '.$r['whens'].'</span>
                                                               </div>
                                                        </div>';

						} elseif ($flag == 0 && $message == 'image') {
							echo '<div class="outgoing_msg">
                                                               <div class="sent_msg">
                                                                      <p><img src="../../asset/request.file.whistleblower.attachment/'.$image.'"></p>
                                                                      <span class="time_date"> '.$r['whens_hours'].' | '.$r['whens'].'</span>
                                                               </div>
                                                        </div>';

						} elseif ($flag == 3 && $message != 'image') {
							echo '<div class="outgoing_msg_respon">
                                                               <div class="sent_msg_respon">
                                                                      <p>'.$r['message'].'</p>
                                                                      <span class="time_date"> '.$r['whens_hours'].' | '.$r['whens'].'</span>
                                                               </div>
                                                        </div>';								
			
						} else {
							// echo '<div class="outgoing_msg">
                                                 //               <div class="sent_msg">
                                                 //                      <p><img src="../../asset/request.file.whistleblower.attachment/'.$image.'"></p>
                                                 //                      <span class="time_date"> '.$r['whens_hours'].' | '.$r['whens'].'</span>
                                                 //               </div>
                                                 //        </div>';
						}

                                          ?>

                                          <?php } ?>