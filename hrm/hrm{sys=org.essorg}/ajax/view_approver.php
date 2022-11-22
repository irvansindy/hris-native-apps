<?php 
include "../../../application/session/session_ess.php";

$username   = $_SESSION['username'];

// Ambil data request
$sql_data_request   = mysqli_query($connect, "SELECT 
a.empno_appvr1,
CONCAT('[', a.empno_appvr1, '] ', a.name_appvr1) AS nama_aaprv1,
a.empno_appvr2,
CONCAT('[', a.empno_appvr2, '] ', a.name_appvr2) AS nama_aaprv2
FROM tclcdreqappsettingessod a WHERE a.emp_no = '$username'");

$data_request       = mysqli_fetch_assoc($sql_data_request);

if(!empty($data_request['empno_appvr1']) && !empty($data_request['empno_appvr2'])){
    $array_data_approval    = array(
        "$data_request[empno_appvr1]",
        "$data_request[empno_appvr2]",
        // "$data_approval[empno_appvr3]"
    );
}

if(!empty($data_request['empno_appvr1']) && empty($data_request['empno_appvr2'])){
    $array_data_approval    = array(
        "$data_request[empno_appvr1]",
        // "$data_approval[empno_appvr3]"
    );
}

if(empty($data_request['empno_appvr1']) && !empty($data_request['empno_appvr2'])){
    $array_data_approval    = array(
        "$data_request[empno_appvr2]",
        // "$data_approval[empno_appvr3]"
    );
}


$count  = count($array_data_approval);
// Ambil data request

// Ambil data approval




// Ambil data approval

?>
<div class="modal-body">
<table cellpadding="1" cellspacing="1" style="width:100%">
  <tbody>
    <tr>
      <td colspan="2" style="font-weight: bold;font-size: x-small;">
        Approval Name :
      </td>
      <td colspan="4" style="font-weight: bold;font-size: x-small;">
        <?php echo $username; ?>
      </td>
    </tr>
  </tbody>
</table>

<?php 
    if($count == '2'){
?>
<table cellpadding="1" cellspacing="1" style="width:100%">
  <tbody>
    <tr>
      <td nowrap="nowrap" style="font-weight: bold;font-size: x-small; vertical-align: top;">
        Step 1 :
      </td>
      <td colspan="3" style="font-weight: bold;font-size: x-small; vertical-align: top;">
        <?php echo $data_request['nama_aaprv1']; ?>, Sequence                       
      </td>
    </tr>
    <tr>
      <td nowrap="nowrap" style="font-weight: bold;font-size: x-small; vertical-align: top;">
        Step 2 :
      </td>
      <td colspan="3" style="font-weight: bold;font-size: x-small; vertical-align: top;">
        <?php echo $data_request['nama_aaprv2']; ?>, Required                         
      </td>
    </tr>
    <tr>
      <td>     
      </td>
      <!--  -->
    </tr>
    <tr>
        <td colspan="4" align="right" width="100%">
            <div class="modal-footer">
                <div class="form-group"></div>
            </div>
        </td>
    </tr>
  </tbody>
</table>
<?php }elseif($count == '1'){ ?>
    <table cellpadding="1" cellspacing="1" style="width:100%">
  <tbody>
    <?php if(!empty($data_request['empno_appvr1'])){ ?>
    <tr>
      <td nowrap="nowrap" style="font-weight: bold;font-size: x-small; vertical-align: top;">
        Step 1 :
      </td>
      <td colspan="3" style="font-weight: bold;font-size: x-small; vertical-align: top;">
        <?php echo $data_request['nama_aaprv1']; ?>, Required                             
      </td>
    </tr>
    <?php } ?>
    <?php if(!empty($data_request['empno_appvr2'])){ ?>
    <tr>
      <td nowrap="nowrap" style="font-weight: bold;font-size: x-small; vertical-align: top;">
        Step 1 :
      </td>
      <td colspan="3" style="font-weight: bold;font-size: x-small; vertical-align: top;">
        <?php echo $data_request['nama_aaprv2']; ?>, Required                             
      </td>
    </tr>
    <?php } ?>
    <tr>
      <td>     
      </td>
      <!--  -->
    </tr>
    <tr>
        <td colspan="4" align="right" width="100%">
            <div class="modal-footer">
                <div class="form-group"></div>
            </div>
        </td>
    </tr>
  </tbody>
</table>
<?php } ?>
</div>