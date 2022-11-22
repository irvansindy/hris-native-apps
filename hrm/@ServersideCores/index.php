 <?php include "../../application/session/session.php";?>

 <!-- MAIN DATATABLE SERVERSIDE CSS -->
 <!-- MAIN DATATABLE SERVERSIDE CSS -->
 <link rel="stylesheet" href="../../asset/vendor/bootstrap/css/modal.css">
 <script src="../../asset/gt_developer/jquery.min.js"></script>
 <link rel="stylesheet" href="../../asset/gt_developer/developer_hris.css">
 <link href="../../asset/sdk_datatables_core/datatables/bedanihbuatjson/datatables/datatables.min.css" rel="stylesheet">
 <!-- MAIN DATATABLE SERVERSIDE CSS -->
 <!-- MAIN DATATABLE SERVERSIDE CSS -->

 <style>
.divBlockSpace {
       position: fixed;
       overflow: hidden;
       background: url("../../asset/dist/img/loading.gif") no-repeat center center;
       background-color: #fdfdfd;
       opacity: .75;
       filter: alpha(opacity=85);
       z-index: 100;
       top: 0;
       left: 0;
       width: 100%;
       height: 100%;
       border: 0 solid blue;

}

.modals {
       display: none;
       position: fixed;
       z-index: 99;
       padding-top: 100px;
       left: 0;
       top: 0;
       width: 100%;
       height: 100%;
       overflow: auto;
       background-color: rgb(0, 0, 0);
       background-color: rgba(0, 0, 0, 0.4);
}

/* modals Content */
/* KALO VIEW MOBILE */
@media (max-width:960px) {
       .modals-content {
              background-color: #fefefe;
              margin: auto;
              padding: 20px;
              border: 1px solid #888;
              width: 80%;
              min-height: 370px;
              margin-top: 70px;
       }

       .modals-content-loader {
              background-color: #02020270;
              margin: auto;
              padding: 20px;
              border: 1px solid #888;
              width: 80%;
              margin-top: 150px;
              border-radius: 5px;
       }
}

/* KALO VIEW WEB */
@media (min-width:960px) {
       .modals-content {
              background-color: #fefefe;
              margin: auto;
              padding: 20px;
              border: 1px solid #888;
              width: 25%
       }
}

/* The Close Button */
.close {
       color: #aaaaaa;
       float: right;
       font-size: 28px;
       font-weight: bold;
}

.modal.left .modal-dialog,
.modal.right .modal-dialog {
       position: fixed;
       margin: auto;
       width: 420px;
       height: 100%;
       -webkit-transform: translate3d(0%, 0, 0);
       -ms-transform: translate3d(0%, 0, 0);
       -o-transform: translate3d(0%, 0, 0);
       transform: translate3d(0%, 0, 0);
}


.modal.right .modal-content {
       height: 100%;
       overflow-y: auto;
}

.modal.right .modal-body {
       padding: 40px 20px 100px;
}


.modal.right.fade .modal-dialog {
       right: -420px;
       -webkit-transition: opacity 0.3s linear, right 0.3s ease-out;
       -moz-transition: opacity 0.3s linear, right 0.3s ease-out;
       -o-transition: opacity 0.3s linear, right 0.3s ease-out;
       transition: opacity 0.3s linear, right 0.3s ease-out;
}

.modal.right.fade.in .modal-dialog {
       right: 0;
}

div.dataTables_processing {
       position: absolute;
       top: 50%;
       left: 50%;
       width: 100%;
       height: 100px;
       margin-left: -50%;
       margin-top: -25px;
       padding-top: 20px;
       padding-bottom: 20px;
       text-align: center;
       font-size: 1px;
       color: white;
       background-image: url("../../asset/dist/img/index.gif");
       background: -webkit-gradient(linear, left top, right top, color-stop(0%, rgba(255, 255, 255, 0)), color-stop(25%, rgba(255, 255, 255, 0.9)), color-stop(75%, rgba(255, 255, 255, 0.9)), color-stop(100%, rgba(255, 255, 255, 0)));
       background: -webkit-linear-gradient(left, rgba(255, 255, 255, 0) 0%, rgba(255, 255, 255, 0.9) 25%, rgba(255, 255, 255, 0.9) 75%, rgba(255, 255, 255, 0) 100%);
       background: -moz-linear-gradient(left, rgba(255, 255, 255, 0) 0%, rgba(255, 255, 255, 0.9) 25%, rgba(255, 255, 255, 0.9) 75%, rgba(255, 255, 255, 0) 100%);
       background: -ms-linear-gradient(left, rgba(255, 255, 255, 0) 0%, rgba(255, 255, 255, 0.9) 25%, rgba(255, 255, 255, 0.9) 75%, rgba(255, 255, 255, 0) 100%);
       background: -o-linear-gradient(left, rgba(255, 255, 255, 0) 0%, rgba(255, 255, 255, 0.9) 25%, rgba(255, 255, 255, 0.9) 75%, rgba(255, 255, 255, 0) 100%);
       background: linear-gradient(to right, rgba(255, 255, 255, 0) 0%, rgba(255, 255, 255, 0.9) 25%, rgba(255, 255, 255, 0.9) 75%, rgba(255, 255, 255, 0) 100%);
}
 </style>








 <!-- Column -->
 <?php include "data.php"; ?>
 <!-- Column -->





























 <!-- The modals -->
 <div id="mymodals" class="modals" style="display: none;z-index: 9999;">
        <div class="modals-content">
               <p>
               <table width="100%">
                      <tr>
                             <td align="center"><img src="../../asset/dist/img/sf-mola-mola.png"
                                           style="max-width: 90%;margin-top: 20px;"></td>
                      </tr>
                      <tr>
                             <td style="width: 85%; font-weight:bold;color: #777b7b;" align="center">
                                    <p id="msg"></p><br>
                                    <button type='submit' name='submit_add' id='submit_add' style="padding: 1px;"
                                           type='button' class="btn btn-warning button_bot closeds">
                                           Keluar
                                    </button>
                             </td>
                      </tr>
               </table>
               </p>
        </div>
 </div>
 <!-- The modals -->
 <script>
// Get the modals
var modals = document.getElementById("mymodals");
var span = document.getElementsByClassName("closeds")[0];
span.onclick = function() {
       modals.style.display = "none";
}
window.onclick = function(event) {
       if (event.target == modals) {
              modals.style.display = "none";
       }
}
 </script>
 <!-- The modalsss -->
 <div id="mymodals2" class="modals" style="display: none;z-index: 9999;">
        <div class="modals-content">
               <p>
               <table width="100%">
                      <tr>
                             <td align="center"><img src="../../asset/dist/img/sf-mola-mola.png"
                                           style="max-width: 90%;margin-top: 20px;"></td>
                      </tr>
                      <tr>
                             <td style="width: 85%; font-weight:bold;color: #777b7b;" align="center">
                                    <p id="msg">Data refreshed</p><br>
                                    <!-- <button type='submit' onclick="myFunctionForClose()" name='submit_add' id='submit_add' style="padding: 1px;" type='button' class="btn btn-warning button_bot closeds">
                        Close
                    </button> -->

                                    <button class="btn btn-warning" style="width: 50%;" onclick="myFunctionForClose()"
                                           type="submit" name="submit_delete" id="submit_delete">
                                           Close
                                    </button>
                             </td>
                      </tr>
               </table>
               </p>
        </div>
 </div>
 <!-- The modalss -->



 <script>
function myFunctionForClose() {
       document.getElementById("mymodals2").style.display = "none";
}
 </script>
 <script>
function stopload() {
       $(document).ready(function() {
              const lockModal = $("#lock-modal");
              const loadingCircle = $("#loading-circle");
              const form = $("#my-form");

              // lock down the form
              lockModal.css("display", "none");
              loadingCircle.css("display", "none");


       });
};
 </script>
 <!-- MAIN DATATABLE SERVERSIDE CSS -->
 <!-- MAIN DATATABLE SERVERSIDE CSS -->
 <script src="../../asset/admus/jquery.js"></script>
 <script src="../../asset/vendor/bootstrap/js/bootstrap.min.js"></script>
 <script type="text/javascript" src="../../asset/sdk_datatables_core/gt_dist/jquery.dataTables.min.js"></script>
 <!-- MAIN DATATABLE SERVERSIDE CSS -->
 <!-- MAIN DATATABLE SERVERSIDE CSS -->