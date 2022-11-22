<?php
include "../../../application/config.php";
$id = $_GET['rfid'];
$sql = mysqli_query($connect, "SELECT * FROM hrmattformula WHERE process_order = '$id' ");
$row = mysqli_fetch_assoc($sql);
?>

<div class="form-row">
         <div class="col-sm-12">
                <div class="input-group">
                       <textarea class="form-control" autocomplete="off" autofocus="on" id="sel_formula"
                              name="sel_formula" type="Text" value="" onfocus="hlentry(this)" size="30"
                              style="width: 100%;height: 200px;" validate="NotNull:Invalid Form Entry"
                              onchange="formodified(this);" title=""><?php echo $row['attformula']; ?></textarea>
                       <img onclick="SelectName()" src="../../asset/dist/img/suggest.png" style="cursor: pointer;">
                       <script type="text/javascript">
                       var popup;

                       function SelectName() {
                              var x = document.getElementById("sel_formula").value;
                              var y = document.getElementById("sel_ls_process_order").value;
                              popup = window.open("Popup.php?id=" + x + '&git=' + y, "Popup", "width=510,height=300");
                              popup.focus();
                              return false
                       }
                       </script>
                </div>
         </div>
</div>