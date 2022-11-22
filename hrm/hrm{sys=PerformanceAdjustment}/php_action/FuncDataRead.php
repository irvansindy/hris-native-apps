<?php
require_once '../../../application/config.php';
include "../../../model/pr/GMPerformancePlanSearchComparatioGen.php";
include "../../../model/pr/GMPerformancePlan.php";

$output = array('data' => array());

$sql = $qListRenderPerformanceFinalComparatioResult;

$query = mysqli_query($connect, $sql);

$x = 1;
while ($row = mysqli_fetch_assoc($query)) {

       if ($row['pa_grade'] != $row['pa_grade_adjust']) {
              $status = '<td align=center><span style="color: #a6a1a1;
              background-color: rgb(243, 242, 239);
              padding: 7px;
              width: 100px;
              font-weight: bold;
              border: 1px solid;" class="badge badge-Fully-Approved"> Adjust</span></td>';
       } else {
              $status = '';
       }


       $prn = '<a type="button" nowrap="nowrap" data-toggle="modal" data-target="#UpdateForm" data-backdrop="static" data-backdrop="static" style="color: blue; border: 5px; cursor:pointer" onclick="UpdateForm(`' . $row['ipp_reqno'] . '`)"> <input type="image" src="../../asset/dist/img/icons/icon-addinfo.png" title="delete" width="22px"/></a>';

       $sel = '<select class="adata" name="pa_grading_adj" id="pa_grading_adj' . $row['ipp_reqno'] . '" onchange="AdjustTable(`' . $row['ipp_reqno'] . '`)">
                     <option value="'.$row['pa_grade_adjust'].'">'.$row['pa_grade_adjust'].'</option>
                     <option value="A">A</option>
                     <option value="B">B</option>
                     <option value="C">C</option>
                     <option value="D">D</option>
                     <option value="E">E</option>
              </select>';

       $output['data'][] = array(
              $x,
              $row['emp_no'],
              $row['Full_Name'],
              $row['pa_grade'],
              $sel,
              number_format($row['pa_result_adjust'], 4) . '%',
              $status,
              $prn
       );

       $x++;
}

// database connection close
$connect->close();
echo json_encode($output);
// KASIH KUTIP TUH DI NIP