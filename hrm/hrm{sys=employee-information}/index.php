<?php
!empty($_GET['emp_id']) ? $getdata = '1' : $getdata = '0';
if ($getdata == 0) {
    include "../../application/session/session.php";
    $getPackage = "?";
} else {
    include "../../application/session/mobile.session.php";
    $getPackage = "?emp_id=$username&";
}
?>

<?php include "../template/sys.header.php"; ?>

<!-- <script src="../../asset/gt_developer/jquery.min.js"></script> -->
<?php
$page   = '2'; //menu id SELECT * FROM hrmmenu WHERE menu_id = '21'
$footer = 'no'; //set as `yes` if you want to use default footer & set as `no` if you want to use custom footer
?>

<?php include "../template/sys.sidebar.php"; ?>
<style>
    input[type="file"] {
        color: black !important;
    }
</style>
<!-- ============================================================== -->
<!-- ============================================================== -->
<!-- Page wrapper  -->
<!-- ============================================================== -->
<div style="width: 100vw;height: 100vh;overflow-x: hidden;">

    <div id="new-header" style="z-index: 10;background: #eceaea;position: fixed;width: 100%;margin-top: 111px;height: 30px;padding: 5px;">
        <div class="row page-titles" style="margin-top: -16px;">
            <div class="col-md-5 col-12 align-self-center">
                <ol class="breadcrumb mb-0 p-0 bg-transparent">
                    <li class="digital" style="font-size: 12px;">Employee&nbsp;&nbsp;</li>
                    <li class="digital" style="font-size: 12px;"><i class="fa fa-angle-right" aria-hidden="true"></i>&nbsp;Employee Information&nbsp;&nbsp;</li>
                </ol>
            </div>

            <div class="card-actions ml-auto" style="margin-top: -3px;">
                <table>
                    <tbody>
                        <tr>
                            <td>
                                <a href='#' class='open_modal_search' class="btn btn-demo" data-toggle="modal" data-target="#myModal2">
                                    <div class="toolbar sprite-toolbar-search" id="SEARCH" title="Search">
                                    </div>
                                </a>
                            </td>
                            <td>
                                <a href="#" class="open_modal_search" title="Add" data-toggle="modal" data-target="#CreateForm" id="CreateButton" data-keyboard="false" data-backdrop="static" data-emp_no="<?php echo $username; ?>">
                                    <div class="toolbar sprite-toolbar-add">
                                    </div>
                                </a>
                            </td>
                            <td>
                                <a href="#" class="open_modal_search" title="Add" data-toggle="modal" data-target="#CreateForm" id="CancelButton" data-keyboard="false" data-backdrop="static" data-emp_no="<?php echo $username; ?>">
                                <div class="toolbar sprite-toolbar-back" id="add" title="Add"></div>
                                </a>
                            </td>
                            <td>
                                <div class="toolbar sprite-toolbar-reload" id="RELOAD" title="Reload" onclick="RefreshPage();">
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="page-wrapper" style="display: block;">

        <!-- ============================================================== -->
        <!-- Container fluid  -->
        <!-- ============================================================== -->
        <div class="container-fluid">
            <!-- Row -->
            <div class="row">
                <div class="col-lg-12 col-md-12">

                    <div class="row">

                        <!-- Column -->
                        <?php
                        if ($get_auth['access'] > 0) {
                            include "data.php";
                        } else {
                            include "../saas.error/index.php";
                        }
                        ?>
                        <!-- Column -->
                    </div>
                </div>
            </div>
            <!-- Row -->
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- End Container fluid  -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->

    <?php include "../template/sys.footer.php"; ?>