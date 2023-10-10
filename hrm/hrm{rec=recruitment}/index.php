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
$page   = '16'; //menu id SELECT * FROM hrmmenu WHERE menu_id = '21'
$footer = 'no'; //set as `yes` if you want to use default footer & set as `no` if you want to use custom footer
?>

<?php include "../template/sys.sidebar.php"; ?>

<!-- ============================================================== -->
<!-- ============================================================== -->
<!-- Page wrapper  -->
<!-- ============================================================== -->

<!-- <div style="width: 100vw;height: 100vh;overflow-x: hidden;"> -->
<div style="width: 100vw;height: 100vh;overflow-x: hidden;">

    <div id="new-header" style="z-index: 10;background: #eceaea;position: fixed;width: 100%;margin-top: 111px;height: 30px;padding: 5px;" mb-4>
        <div class="row page-titles" style="margin-top: -16px;">
            <div class="col-md-5 col-12 align-self-center">
                <ol class="breadcrumb mb-0 p-0 bg-transparent">
                    <li class="digital" style="font-size: 12px;">Recruitment&nbsp;&nbsp;</li>
                    <li class="digital" style="font-size: 12px;"><i class="fa fa-angle-right" aria-hidden="true"></i>&nbsp;Applicant</li>
                </ol>
            </div>

            <!-- <div class="card-actions ml-auto" style="margin-top: -3px;">
                <table>
                    <tbody>
                        <tr>
                            <td>
                                <a href="#" class="open_modal_search" title="First Step For Add Suggestion Innovation" data-toggle="modal" data-target="#CreateForm" id="create_data_Suggestion" data-keyboard="false" data-backdrop="static">
                                    <div class="toolbar sprite-toolbar-add">
                                    </div>
                                </a>
                            </td>
                            <td>
                                <div class="toolbar sprite-toolbar-reload" id="RELOAD" title="Reload" onclick="RefreshPage();">
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div> -->
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

<style>
    .card-margin {
        margin-bottom: 1.875rem;
    }

    .card {
        border: 0;
        box-shadow: 0px 0px 10px 0px rgba(82, 63, 105, 0.1);
        -webkit-box-shadow: 0px 0px 10px 0px rgba(82, 63, 105, 0.1);
        -moz-box-shadow: 0px 0px 10px 0px rgba(82, 63, 105, 0.1);
        -ms-box-shadow: 0px 0px 10px 0px rgba(82, 63, 105, 0.1);
    }
    .card {
        position: relative;
        display: flex;
        flex-direction: column;
        min-width: 0;
        word-wrap: break-word;
        background-color: #ffffff;
        background-clip: border-box;
        border: 1px solid #e6e4e9;
        border-radius: 8px;
    }

    .card .card-header.no-border {
        border: 0;
    }
    .card .card-header {
        background: none;
        padding: 0 0.9375rem;
        font-weight: 700;
        display: flex;
        align-items: center;
        min-height: 50px;
    }
    .card-header:first-child {
        border-radius: calc(8px - 1px) calc(8px - 1px) 0 0;
    }

    .widget-49 .widget-49-title-wrapper {
    display: flex;
    align-items: center;
    }

    .widget-49 .widget-49-title-wrapper .widget-49-date-primary {
    display: flex;
    align-items: center;
    justify-content: center;
    flex-direction: column;
    background-color: #edf1fc;
    width: 5rem;
    height: 5rem;
    border-radius: 50%;
    }

    .widget-49 .widget-49-title-wrapper .widget-49-date-primary .widget-49-date-day {
    color: #4e73e5;
    font-weight: 500;
    font-size: 1.5rem;
    line-height: 1;
    }

    .widget-49 .widget-49-title-wrapper .widget-49-date-primary .widget-49-date-month {
    color: #4e73e5;
    line-height: 1;
    font-size: 1rem;
    text-transform: uppercase;
    }


    .widget-49 .widget-49-title-wrapper .widget-49-meeting-info {
    display: flex;
    flex-direction: column;
    margin-left: 1rem;
    }

    .widget-49 .widget-49-title-wrapper .widget-49-meeting-info .widget-49-pro-title {
    color: #3c4142;
    font-size: 14px;
    }

    .widget-49 .widget-49-title-wrapper .widget-49-meeting-info .widget-49-meeting-time {
    color: #B1BAC5;
    font-size: 11px;
    }

    .widget-49 .widget-49-meeting-points {
    font-weight: 400;
    font-size: 13px;
    margin-top: .5rem;
    }

    .widget-49 .widget-49-meeting-points .widget-49-meeting-item {
    display: list-item;
    color: #727686;
    }

    .widget-49 .widget-49-meeting-points .widget-49-meeting-item span {
    margin-left: .10rem;
    }

    .widget-49 .widget-49-meeting-action {
    text-align: right;
    }

    .widget-49 .widget-49-meeting-action a {
    text-transform: uppercase;
    /* hover {
        color: white
    } */
    }

    .widget-49 .widget-49-title-wrapper .widget-49-meeting-info .list-inline {
        margin-left: 0; !important
    }

    /* progress bar */
    .back-skills {
        width: 100%;
        background-color: #ddd;
    }
    .skills {
        text-align: right;
        padding-top: 10px;
        padding-bottom: 10px;
        font-weight: bold;
        color: white;
    }
    .percentage {width: 65%; background-color: #f44336;}

    /* stepper progress */
    .md-stepper-horizontal {
        display: table;
        width: 100%;
        margin: 0 auto;
        background-color: transparent;
        /* box-shadow: 0 3px 8px -6px rgba(0, 0, 0, .50); */
    }

    .md-stepper-horizontal .md-step {
        display: table-cell;
        position: relative;
        padding: 24px;
    }

    .md-stepper-horizontal .md-step:hover,
    .md-stepper-horizontal .md-step:active {
        background-color: rgba(0, 0, 0, 0.04);
    }

    .md-stepper-horizontal .md-step:active {
        border-radius: 15% / 75%;
    }

    .md-stepper-horizontal .md-step:first-child:active {
        border-top-left-radius: 0;
        border-bottom-left-radius: 0;
    }

    .md-stepper-horizontal .md-step:last-child:active {
        border-top-right-radius: 0;
        border-bottom-right-radius: 0;
    }

    .md-stepper-horizontal .md-step:hover .md-step-circle {
        background-color: #757575;
    }

    .md-stepper-horizontal .md-step:first-child .md-step-bar-left,
    .md-stepper-horizontal .md-step:last-child .md-step-bar-right {
        display: none;
    }

    .md-stepper-horizontal .md-step .md-step-circle {
        width: 30px;
        height: 30px;
        margin: 0 auto;
        background-color: #999999;
        border-radius: 50%;
        text-align: center;
        line-height: 30px;
        font-size: 16px;
        font-weight: 600;
        color: #FFFFFF;
    }

    .md-stepper-horizontal.green .md-step.active .md-step-circle {
        background-color: #00AE4D;
    }

    .md-stepper-horizontal.blue .md-step.active .md-step-circle {
        /* background-color: #F96302; */
        background-color: #1b6fb9;
    }

    .md-stepper-horizontal .md-step.active .md-step-circle {
        background-color: rgb(33, 150, 243);
    }

    .md-stepper-horizontal .md-step.done .md-step-circle:before {
        font-family: 'FontAwesome';
        font-weight: 100;
        content: "\f00c";
    }

    .md-stepper-horizontal .md-step.done .md-step-circle *,
    .md-stepper-horizontal .md-step.editable .md-step-circle * {
        display: none;
    }

    .md-stepper-horizontal .md-step.editable .md-step-circle {
        -moz-transform: scaleX(-1);
        -o-transform: scaleX(-1);
        -webkit-transform: scaleX(-1);
        transform: scaleX(-1);
    }

    .md-stepper-horizontal .md-step.editable .md-step-circle:before {
        font-family: 'FontAwesome';
        font-weight: 100;
        content: "\f040";
    }

    .md-stepper-horizontal .md-step .md-step-title {
        margin-top: 16px;
        font-size: 16px;
        font-weight: 600;
    }

    .md-stepper-horizontal .md-step .md-step-title,
    .md-stepper-horizontal .md-step .md-step-optional {
        text-align: center;
        color: rgba(0, 0, 0, .26);
    }

    .md-stepper-horizontal .md-step.active .md-step-title {
        font-weight: 600;
        color: rgba(0, 0, 0, .87);
    }

    .md-stepper-horizontal .md-step.active.done .md-step-title,
    .md-stepper-horizontal .md-step.active.editable .md-step-title {
        font-weight: 600;
    }

    .md-stepper-horizontal .md-step .md-step-optional {
        font-size: 12px;
    }

    .md-stepper-horizontal .md-step.active .md-step-optional {
        color: rgba(0, 0, 0, .54);
    }

    .md-stepper-horizontal .md-step .md-step-bar-left,
    .md-stepper-horizontal .md-step .md-step-bar-right {
        position: absolute;
        top: 36px;
        height: 1px;
        border-top: 1px solid #DDDDDD;
    }

    .md-stepper-horizontal .md-step .md-step-bar-right {
        right: 0;
        left: 50%;
        margin-left: 20px;
    }

    .md-stepper-horizontal .md-step .md-step-bar-left {
        left: 0;
        right: 50%;
        margin-right: 20px;
    }

    
</style>

<!-- fetch all data -->
<script type="module" src="source_js/fetch_data.js"></script>


<!-- pagination -->
<link rel="stylesheet" href="source_js/pagination_js/dist/pagination.css"/>
<script src="source_js/pagination_js/dist/pagination.js"></script>