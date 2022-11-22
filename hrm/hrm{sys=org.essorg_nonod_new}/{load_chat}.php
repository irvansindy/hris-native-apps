<?php 

include "../../application/session/session.php";
$username           = $_SESSION['username'];


$req_id             = $_POST['id'];

$sql_data_chat      = mysqli_query($connect, "SELECT 
a.id_chat,
a.ticketing_id,
a.created_date,
b.Full_Name,
a.message,
a.created_by,
CASE WHEN c.file_name IS NULL then ''
	  when c.file_name IS NOT NULL then c.file_name
END AS nama_file
FROM hrmorgesschat a
LEFT JOIN view_employee b ON a.created_by = b.emp_no
LEFT JOIN hrmorgesschatattachment c ON c.chat_id = a.id_chat
WHERE a.ticketing_id = '$req_id' 
ORDER BY a.created_date ASC
");

?>                    
<div class="direct-chat-messages" style="height:100%">      
<?php 
    while($data_chat    = mysqli_fetch_assoc($sql_data_chat)){

    $info   = '';
    if($data_chat['id_chat'] == 'Create'){
        $info   = 'Has create request';
    }else if($data_chat['id_chat'] == 'Close'){
        $info   = 'Has close request';
    }
?>

<?php 
    if($data_chat['id_chat'] == 'Create' || $data_chat['id_chat'] == 'Close'){
?>
                                   <!-- Untuk status -->

                                    <div class="direct-chat-msg right">
                                        <div class="direct-chat-infos clearfix">
                                            <span class="fontCustom direct-chat-name float-right" style="font-size: 8pt;"></span>
                                            <span class="direct-chat-timestamp float-left"></span>
                                        </div>
                                        <table cellpadding="1" cellspacing="1" style="width:100%">
                                            <tbody>
                                                <tr>
                                                    <td style="text-align:center">
                                                        <table align="center" cellpadding="1" cellspacing="1" style="width:50%">
                                                
                                                            <tbody>
                                                                <tr>
                                                                    <td class="fontCustom" style="color:#444;margin:5px 0 0 50px;padding:10px 10px;  text-align:left; vertical-align:middle; width:250px; font-size:12px;font-family:verdana">
                                                                
                                                                        <?php echo $data_chat['created_date'] ?>
                                                                
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td style="background-color:#d2d0cb; width:250px;text-align:center; font-weight:bold; border-radius:.3rem;background:#d2d0cb;;color:#444;margin:5px 0 0 50px;padding:10px 10px;  text-align:center; vertical-align:middle; width:250px;font-size: 11px;">
                                                                                    
                                                                        <?php echo $data_chat['Full_Name']; ?> <?php echo $info; ?>
                                                                                    
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>                       
                                        
                                        
                                                                
                                        

                                    </div>

                                    <!-- Untuk status -->
<?php } ?>
            
                                    <!-- Conversations are loaded here -->
                                    

<?php 
    if($data_chat['id_chat'] != 'Create'){
        if($data_chat['id_chat'] != 'Close'){
?>                              
                                
                                        <!-- Message. Default to the left -->
                                        <?php 
                                            if($data_chat['created_by'] == $username){
                                        ?>
                                        <div class="direct-chat-msg">
                                            <div class="direct-chat-info clearfix">
                                                <span class="direct-chat-name pull-left"><?php echo $data_chat['Full_Name']; ?></span>
                                                <span class="direct-chat-timestamp pull-right"><?php echo $data_chat['created_date']; ?></span>
                                            </div>
                                            <!-- /.direct-chat-info -->
                                            <img class="direct-chat-img" src="../hrm{sys=org.essorg}/avatar/man.jpg" alt="Message User Image"><!-- /.direct-chat-img -->
                                            <?php if($data_chat['message'] != '                                                                    
                                                                '){ ?>
                                            <?php if($data_chat['message'] != 'Meeting created'){ ?>
                                                    <div class="direct-chat-text">
                                                        <?php echo $data_chat['message']; ?>
                                                    </div>
                                                <?php }else{ 
                                                
                                                $sql_data_meeting   = mysqli_query($connect, "SELECT 
                                                a.request_id,
                                                a.`to`,
                                                a.subject,
                                                DATE_FORMAT(a.time_start, '%d %M %Y') AS tanggal_start,
                                                DATE_FORMAT(a.time_start, '%H:%i') AS waktu_start,
                                                DATE_FORMAT(a.time_end, '%d %M %Y') AS tanggal_end,
                                                DATE_FORMAT(a.time_end, '%H:%i') AS waktu_end,
                                                a.content
                                                FROM hrmorgessmeeting a
                                                WHERE a.id_chat = '$data_chat[id_chat]'");

                                                $data_meeting       = mysqli_fetch_assoc($sql_data_meeting);
                                                
                                                ?>
                                                
                                                    <div class="direct-chat-text">
                                                        <fieldset id="fset_1" class="" >
                                                        <table>
                                                            <tr>
                                                                <td style="width:70px">To</td>
                                                                <td>: <?php echo $data_meeting['to']; ?></td>
                                                            </tr>
                                                            <tr>
                                                                <td style="width:70px">Subject</td>
                                                                <td>: <?php echo $data_meeting['subject']; ?></td>
                                                            </tr>
                                                            <tr>
                                                                <td style="width:70px">Start</td>
                                                                <td>: <?php echo $data_meeting['tanggal_start']; ?> [<?php echo $data_meeting['waktu_start']; ?>] - <?php echo $data_meeting['tanggal_end']; ?> [<?php echo $data_meeting['waktu_end']; ?>]</td>
                                                            </tr>
                                                        </table>
                                                        </fieldset>
                                                        <!-- <br> -->
                                                        <fieldset id="fset_1" class="" >
                                                        <?php echo $data_meeting['content']; ?>
                                                        </fieldset>
                                                    </div>
                                                
                                                <?php } ?>
                                            <?php } ?>
                                            <!-- /.direct-chat-text -->
                                            <?php 
                                                if($data_chat['nama_file'] != ''){
                                            ?>
                                            <div class="direct-chat-infos clearfix" style="margin-top:5px">
                                                <span class="direct-chat-timestamp float-left"> 
                                                    <a href="../../asset/upload/attachmentessod/<?php echo $data_chat['nama_file'] ?>" target="framename">
                                                        <img src="../../asset/img/icons/attached-file.png" alt="">
                                                    </a>
                                                </span>
                                            </div>
                                            <?php } ?>
                                        </div>
                                        <?php } ?>
                                        <!-- /.direct-chat-msg -->

                                        <!-- Message to the right -->
                                        <?php 
                                            if($data_chat['created_by'] != $username){
                                        ?>
                                        <div class="direct-chat-msg right">
                                            <div class="direct-chat-info clearfix">
                                                <span class="direct-chat-name pull-right"><?php echo $data_chat['Full_Name']; ?></span>
                                                <span class="direct-chat-timestamp pull-left"><?php echo $data_chat['created_date']; ?></span>
                                            </div>
                                            <!-- /.direct-chat-info -->
                                            <img class="direct-chat-img" src="../hrm{sys=org.essorg}/avatar/man.jpg" alt="Message User Image"><!-- /.direct-chat-img -->
                                            <?php if($data_chat['message'] != '                                                                    
                                                                '){ ?>
                                            <?php if($data_chat['message'] != 'Meeting created'){ ?>
                                                    <div class="direct-chat-text" style="background:#ffc107; border-color:#ffc107;">
                                                        <?php echo $data_chat['message']; ?>
                                                    </div>
                                                <?php }else{ 
                                                    
                                                    $sql_data_meeting   = mysqli_query($connect, "SELECT 
                                                    a.request_id,
                                                    a.`to`,
                                                    a.subject,
                                                    DATE_FORMAT(a.time_start, '%d %M %Y') AS tanggal_start,
                                                    DATE_FORMAT(a.time_start, '%H:%i') AS waktu_start,
                                                    DATE_FORMAT(a.time_end, '%d %M %Y') AS tanggal_end,
                                                    DATE_FORMAT(a.time_end, '%H:%i') AS waktu_end,
                                                    a.content
                                                    FROM hrmorgessmeeting a
                                                    WHERE a.id_chat = '$data_chat[id_chat]'");
    
                                                    $data_meeting       = mysqli_fetch_assoc($sql_data_meeting);

                                                ?>
                                                <div class="direct-chat-text" style="background:#ffc107; border-color:#ffc107;">
                                                        <fieldset id="fset_1" class="" >
                                                        <table>
                                                            <tr>
                                                                <td style="width:70px">To</td>
                                                                <td>: <?php echo $data_meeting['to']; ?></td>
                                                            </tr>
                                                            <tr>
                                                                <td style="width:70px">Subject</td>
                                                                <td>: <?php echo $data_meeting['subject']; ?></td>
                                                            </tr>
                                                            <tr>
                                                                <td style="width:70px">Start</td>
                                                                <td>: <?php echo $data_meeting['tanggal_start']; ?> [<?php echo $data_meeting['waktu_start']; ?>] - <?php echo $data_meeting['tanggal_end']; ?> [<?php echo $data_meeting['waktu_end']; ?>]</td>
                                                            </tr>
                                                        </table>
                                                        </fieldset>
                                                        <!-- <br> -->
                                                        <fieldset id="fset_1" class="" >
                                                        <?php echo $data_meeting['content']; ?>
                                                        </fieldset>
                                                    </div>
                                                
                                                <?php } ?>
                                            <?php } ?>
                                            <!-- /.direct-chat-text -->
                                            <?php 
                                                if($data_chat['nama_file'] != ''){
                                            ?>
                                            <div class="direct-chat-infos clearfix" style="margin-top:5px">
                                                <span class="direct-chat-timestamp float-right"> 
                                                    <a href="../../asset/upload/attachmentessod/<?php echo $data_chat['nama_file'] ?>" target="framename">
                                                        <img src="../../asset/img/icons/attached-file.png" alt="">
                                                    </a>
                                                </span>
                                            </div>
                                            <?php } ?>
                                        </div>
                                        <?php } ?>
                                        <!-- /.direct-chat-msg -->
<?php }} ?>
                                    
<?php } ?>
<div class="direct-chat-msg right">
                                        <div class="direct-chat-infos clearfix">
                                            <span class="fontCustom direct-chat-name float-right" style="font-size: 8pt;"></span>
                                            <span class="direct-chat-timestamp float-left"></span>
                                        </div>
                                        <table cellpadding="1" cellspacing="1" style="width:100%">
                                            <tbody>
                                                <tr>
                                                    <td style="text-align:center">
                                                        <table align="center" cellpadding="1" cellspacing="1" style="width:50%">
                                                
                                                            <tbody>
                                                                <tr>
                                                                    <td style="background-color:#d2d0cb; width:250px;text-align:center; font-weight:bold; border-radius:.3rem;background:#d2d0cb;;color:#444;margin:5px 0 0 50px;padding:10px 10px;  text-align:center; vertical-align:middle; width:250px;font-size: 11px;">
                                                                                    
                                                                        <table align="center">
                                                                            <tr>
                                                                                <td>
                                                                                    <div class="toolbar sprite-toolbar-reload" id="refresh_chat" title="Reload"
                                                                                            onclick="">
                                                                                    </div>
                                                                                </td>
                                                                                <!-- <td>
                                                                                    <label style="margin-top:4px" for="formFileMultiple" class="form-label">Refresh Chat</label>
                                                                                </td> -->
                                                                            </tr>
                                                                        </table>
                                                                                    
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>                       
                                    </div>

</div>
                                    <!--/.direct-chat-messages-->