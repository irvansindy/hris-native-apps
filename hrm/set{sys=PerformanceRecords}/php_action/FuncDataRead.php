<?php 
require_once '../../../application/config.php';
include "../../../model/pr/GMPerformancePlanSearchGen.php";
include "../../../model/pr/GMPerformancePlan.php";

$output = array('data' => array());

$sql = $qListRenderEntry;

$query = mysqli_query($connect, $sql);

$x = 1;
while ($row = mysqli_fetch_assoc($query)) {

	if($row['kpi_type'] == 'SPV-Up') {
		$use_form_delete_for = 'FormDisplayApproverSPVUP';
		$use_form_revised_for = 'FormDisplayRevisedSPVUP';
		$use_function_delete_for = 'editApprovalSPVUPMember';
		$use_function_revised_for = 'editRevisedMemberSPVUP';
	} else {
		$use_form_delete_for = 'FormDisplayDelete';
		$use_form_revised_for = 'FormDisplayRevised';-
		$use_function_delete_for = 'editdelMember';
		$use_function_revised_for = 'editRevisedMember';
	}

	if($row['name_en'] == "Revised") {
		$rmintf = '<a type="button" nowrap="nowrap" data-toggle="modal" data-target="#'.$use_form_revised_for.'" data-backdrop="static" style="color: blue; border: 5px; cursor:pointer" onclick="'.$use_function_revised_for.'(`'.$row['ipp_reqno'].'`)"><u>'.$row['ipp_reqno'].'</u></a>';
	} else {
		$rmintf = $row['ipp_reqno'];
	}

	// $prn = '<a type="button" nowrap="nowrap" data-toggle="modal" data-target="#'.$use_form_delete_for.'" data-backdrop="static" style="color: blue; border: 5px; cursor:pointer" onclick="'.$use_function_delete_for.'(`'.$row['ipp_reqno'].'`)"> <input type="image" src="../../asset/dist/img/ios7-close-outline.png" title="delete" width="22px"/></a>';

	$prn = '<a type="button" nowrap="nowrap" data-toggle="modal" data-target="#'.$use_form_delete_for.'" data-backdrop="static" style="color: blue; border: 5px; cursor:pointer" onclick="'.$use_function_delete_for.'(`'.$row['ipp_reqno'].'`)"> <input type="image" src="../../asset/dist/img/icons/icon-addinfo.png" title="delete" width="22px"/></a>';

	$activebadge = '';
       if($row['name_en'] == "Draft") {
                     $activebadge = "badge-draft";
       } elseif($row['name_en'] == "Unverified") {
                     $activebadge = "badge-Unverified";  
       } elseif($row['name_en'] == "Partially Approved") {
                     $activebadge = "badge-Partially-Approved"; 
       } elseif($row['name_en'] == "Fully Approved") {
                     $activebadge = "badge-Fully-Approved";
       } elseif($row['name_en'] == "Revised") {
                     $activebadge = "badge-Revised";
       } elseif($row['name_en'] == "Rejected") {
                     $activebadge = "badge-Rejected"; 
       } elseif($row['name_en'] == "Cancelled") {
                     $activebadge = "badge-Cancelled";                
       } else {
                     $activebadge = "badge-Closed";
       }

	$status = '<span class="badge '.$activebadge.'">'.$row['name_en'].'</span>';

	$output['data'][] = array(
		$x,
		$rmintf,
		$row['kpi_type'],
		$row['period_name'],
		$row['emp_no'],
		$row['Full_Name'],
		$row['pos_name_en'],
		$row['cost_code'],
		// $row['created_date'],
		// $row['created_by'],
		// $row['modified_date'],
		// $row['created_by'],
		$status,
		$prn
	);

	$x++;
}

// database connection close
$connect->close();
echo json_encode($output);

// KASIH KUTIP TUH DI NIP

// $activebadge = '';
//        if($row['name_en'] == "Draft") {
//                      $activebadge = "badge-draft";
//        } elseif($row['name_en'] == "Unverified") {
//                      $activebadge = "badge-Unverified";  
//        } elseif($row['name_en'] == "Partially Approved") {
//                      $activebadge = "badge-Partially-Approved"; 
//        } elseif($row['name_en'] == "Fully Approved") {
//                      $activebadge = "badge-Fully-Approved";
//        } elseif($row['name_en'] == "Revised") {
//                      $activebadge = "badge-Revised";
//        } elseif($row['name_en'] == "Rejected") {
//                      $activebadge = "badge-Rejected"; 
//        } elseif($row['name_en'] == "Cancelled") {
//                      $activebadge = "badge-Cancelled";                
//        } else {
//                      $activebadge = "badge-Closed";
// }

// $rmintf = '<a href="#" data-toggle="modal" data-target="#FormDisplayApproverSPVUP" onclick="editApprovalSPVUPMember(`'.$row['ipp_reqno'].'`)" data-backdrop="static" class="
//                         py-3
//                         px-2
//                         border-bottom
//                         d-flex
//                         align-items-start
//                         text-decoration-none
//                       ">
//                       <div class="user-img position-relative d-inline-block me-2">
//                         <span class="
//                             round
//                             text-white
//                             d-inline-block
//                             text-center
//                             rounded-circle
                            
//                           " style="background: #b5b5b5;">2022</span>
//                       </div>
//                       <div class="w-75 d-inline-block v-middle pl-2">
//                         <h5 style="margin-top: 5px; color: orange; border: 5px; cursor:pointer;font-weight: bold;font-size: 13px;" class="
//                             text-truncate
//                             mb-0
//                           ">
//                           '.$row['ipp_reqno'].'
//                         </h5>
//                         <h6 style="margin-top: 5px; color: #757575; border: 5px; cursor:pointer;font-weight: bold;font-size: 11px;">'.$row['Full_Name'].' | ['.$row['emp_no'].']</h6>
//                         <span class="
//                             mail-desc
//                             fs-2
//                             mt-1
//                             text-truncate
//                             overflow-hidden
//                             text-nowrap
//                             d-block
//                             fw-normal
//                             text-muted
//                           "><span class="badge '.$activebadge.'">'.$row['name_en'].'</span> </span>
                      
//                       </div>
//                     </a>';

// 	$prn = '<a type="button" nowrap="nowrap" data-toggle="modal" data-target="#FormDisplayDelete" data-backdrop="static" style="color: blue; border: 5px; cursor:pointer" onclick="editdelMember(`'.$row['category_code'].'`)"> <input type="image" src="../../asset/dist/img/ios7-close-outline.png" title="delete" width="22px"/></a>';

// 	$output['data'][] = array(
// 		$rmintf
// 	);

// 	$x++;
// }

// // database connection close
// $connect->close();
// echo json_encode($output);

// // KASIH KUTIP TUH DI NIP