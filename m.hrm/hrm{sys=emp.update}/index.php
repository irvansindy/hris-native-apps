<?php
!empty($_GET['emp_id']) ? $getdata = '1' : $getdata = '0'; 
if($getdata == 0) {
	include "../../application/session/session.php";
} else {
	include "../../application/session/mobile.session.php";	
}
?>

<?php include "../template/sys.header.php";?>
<?php 
$page = '19'; //menu id SELECT * FROM hrmmenu WHERE menu_id = '19'}
$footer = 'no'; //set as `yes` if you want to use default footer & set as `no` if you want to use custom footer
?>

<style>
    @media (max-width:960px) 
    { 
            #ac-wrapper {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(255, 255, 255, .6);
            z-index: 1001;
            }
            #popup {
                padding 10px;
                height: 375px;
                background: #FFFFFF;


                box-shadow: #64686e 0px 0px 3px 3px;
                -moz-box-shadow: #64686e 0px 0px 3px 3px;
                -webkit-box-shadow: #64686e 0px 0px 3px 3px;
                position: relative;
                top: 150px;
                margin: 10px;
                padding-top: 20px;
            }
    }

    @media (min-width:960px) 
    { 
            #ac-wrapper {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(255, 255, 255, .6);
            z-index: 1001;
            }
            #popup {
                width: 555px;
                height: 375px;
                background: #FFFFFF;
    
               
                box-shadow: #64686e 0px 0px 3px 3px;
                -moz-box-shadow: #64686e 0px 0px 3px 3px;
                -webkit-box-shadow: #64686e 0px 0px 3px 3px;
                position: relative;
                top: 150px;
                left: 375px;
                padding-top: 20px;
            }
    }
    </style>

<?php
$cek_update_a = mysqli_fetch_array(mysqli_query($connect, "SELECT last_activity FROM login_details WHERE username = '$username' and last_activity <> '$times' ORDER BY last_activity DESC limit 1"));                            
$cek_update_ar = $cek_update_a['last_activity'];

$cek_update = mysqli_query($connect, "SELECT * FROM hrmupdate WHERE created_date > '$cek_update_ar'");
$cek_update_b = mysqli_fetch_array(mysqli_query($connect, "SELECT * FROM hrmupdate WHERE created_date > '$cek_update_ar'"));
$cek_update_br = $cek_update_a['last_activity'];
$cek_update_remarks = $cek_update_b['messages'];

?>

<div id="ac-wrapper" style='display:none'>
    <div id="popup">
        <center>
                                <form action='edit' method='POST' style="margin: 10px;" onsubmit='return HrmsValidationForm()'>
                                        <input type='hidden' class='hidden' value='<?php echo $username; ?>' type='text' name='rfid'>



                                        <table>
                                            <br>
                                            <tr>
                                                <td colspan="2" style="text-align: center;">
                                                <img src="../../asset/dist/img/sf-mola-mola.png" style="max-width: 40%;margin-top: 20px;">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="2" style="text-align: center;">
                                                <h5><?php echo $cek_update_remarks; ?></h5>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <?php 
                                                    $is_active = mysqli_query($connect, "SELECT 
                                                                                                *
                                                                                                FROM mgtools_period
                                                                                                WHERE CURDATE() BETWEEN period_start AND period_end");
                                                    if(mysqli_num_rows($is_active) > 0){

                                                            

                                                            

                                                            echo '<button type="submit" name="submit_add" id="submit_add" type="button" style="width: 100%;" class="btn btn-warning button_bot">
                                                            &nbsp;&nbsp; &nbsp;&nbsp;Update Data&nbsp;&nbsp;&nbsp;&nbsp;
                                                                    </button>';

                                                                    $get_period = mysqli_fetch_array(mysqli_query($connect, "SELECT * FROM mgtools_period ORDER BY migration_id DESC LIMIT 1"));
                                                                    $get_period_r = $get_period['migration_id'];
                                                                    $is_update =mysqli_query($connect, "SELECT 
                                                                                                            *
                                                                                                            FROM mgtools_submission
                                                                                                            WHERE 
                                                                                                            `emp_no` = '$username' AND
                                                                                                            `status` = 'Y' AND
                                                                                                            `migration_id` = '$get_period_r'");


                                                                    if(mysqli_num_rows($is_update) > '0')
                                                                    {
                                                                        $act = 'hide';
                                                                    } else {
                                                                        $act = 'show';
                                                                    }

                                                            
                                                                    
                                                    } else {
                                                            echo '<button type="submit" style="background-color: #3090E4;width: 100%;" name="submit_add" id="submit_add" type="button" class="btn btn-primary button_bot">
                                                            &nbsp;&nbsp;&nbsp;&nbsp;Preview Data&nbsp;&nbsp;&nbsp;&nbsp;
                                                                    </button>';
                                                            $act = 'hide';
                                                    }
                                                    ?>
                                                    
                                                    <button class="btn btn-warning button_bot" type="button" name="submit_add2"
                                                            id="submit_add2" style="display:none;width: 100%; cursor: no-drop;" disabled>
                                                            <img src="../../asset/dist/img/Rolling-0.6s-200px.gif" width="30">
                                                    </button>
                                                </td>

                                                <td><button style="background-color: #3090E4;width: 100%;" onclick="PopUp(`hide`)" class="btn btn-primary button_bot" name="submit_add" id="submit_add" type="button" >
                                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Keluar&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                        </button>
                                                </td>
                                            </tr>
                                        </table>




                                        
      
                                </form>

                              
        </center>
    </div>
</div>

<script>
    function PopUp(hideOrshow) {
    if (hideOrshow == 'hide') document.getElementById('ac-wrapper').style.display = "none";
    else document.getElementById('ac-wrapper').removeAttribute('style');
    }
    window.onload = function () {
        setTimeout(function () {
            PopUp('<?php echo $act; ?>');
        }, 1000);
    }
</script>









<!-- LOADER -->
<div onclick='return stopload()' id="divBlockSpace" class="divBlockSpace"></div>
<div onclick='return stopload()' id="loading-circle"></div>
<div id="contents"></div>
<!-- LOADER -->

        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Page wrapper  -->
        <!-- ============================================================== -->
        <div class="page-wrapper" style="display: block;">
            <div class="row page-titles">
                <div class="col-md-5 col-12 align-self-center">
                    <h3 class="text-themecolor mb-0">Employee</h3>
                    <ol class="breadcrumb mb-0 p-0 bg-transparent">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Home&nbsp;&nbsp;</a></li>
                        <li ><i class="fa fa-angle-right" aria-hidden="true"></i>&nbsp;Employee Information</li>
                    </ol>
                </div>
                <div class="col-md-7 col-12 align-self-center d-none d-md-block">
                    <div class="d-flex mt-2 justify-content-end">
                    </div>
                </div>
            </div>


            <!-- ============================================================== -->
            <!-- Container fluid  -->
            <!-- ============================================================== -->
            <div class="container-fluid">
                <!-- Row -->
                <div class="row">
                    <div class="col-lg-12 col-md-12">

                        <div class="row">
                           
                            <!-- Column -->
                            <?php include "data.php"; ?>
                            <!-- Column -->
                        </div>
                    </div>
                   
                        
                </div>
                <!-- Row -->
            </div>
            <!-- ============================================================== -->
            <!-- End Container fluid  -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
           
            <?php include "../template/sys.footer.php";?>
