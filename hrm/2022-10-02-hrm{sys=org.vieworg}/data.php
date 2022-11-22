<!-- <div class="loader"></div> -->

<script>
            $(document).ready(function () {

                // var gradex = document.getElementById("gradex").value;
                // create a tree
                $("#tree-data").jOrgChart({
                    chartElement: $("#tree-view"),
                    nodeClicked: nodeClicked
                });

                // lighting a node in the selection
                function nodeClicked(node, type) {
                    node = node || $(this);
                    $('.jOrgChart .selected').removeClass('selected');
                    node.addClass('selected');
                }
            });
        </script>
<?php
require_once './DBConnection.php';
require_once './People.php';
require_once './Posisi.php';

$conn= new DBConnection();
$connection=$conn->getConnection();

function getPeopleById($id,$connection) {
    $people = new People();
    $sql = "select * from od_simpeople where people_id='$id'";
//     echo"<script type='text/javascript'>
// window.alert('mulai2'); 
// </script>";
    $stmt = $connection->prepare($sql);
    $stmt->execute();
    if ($v = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $people = new People();
        $people->setPeopleId1($v['people_id']);
        $people->setName($v['name']);
        $people->setTelepon($v['telepon']);
        $people->setAdress($v['address']);
        $people->setStatusId($v['status_id']);
        $people->setJoindate($v['join_date']);
        $people->setEmail($v['email']);
        $people->setEndDate($v['end_date']);
        $people->setKomitment($v['komitment']);
        $people->setActiveStatus($v['active_status']);
        $people->setUsername($v['username']);
        $people->setPassword($v['password']);
        $people->setCabang($v['cabang']);
		$people->setGrade($v['grade']);
		$people->setLos($v['los']);
        $people->setPicture($v['picture']);
        $people->setAge($v['age']);
        $people->setLastpos($v['lastPOS']);
        $people->setLastposyear($v['lastPOSyear']);
    }
    return $people;
}




// exit();

function getOrgData($connection) {
    $level      = $_POST['tampunglevel'];
    if(isset($_POST['posisiuntuktampil'])){
        $page   = $_POST['posisiuntuktampil'];
        $filter = $_POST['filter'];



        // echo"<script type='text/javascript'>
        //         window.alert('Pertama'); 
        //      </script>"; 


        if($filter == '3'){
            // echo"<script type='text/javascript'>
            //     window.alert('".$filter."'); 
            //  </script>";
            if($page == 'all'){
            //     echo"<script type='text/javascript'>
            //     window.alert('Alert 0'); 
            //  </script>"; 
            $sql    = "select 
            a.posisi_id,
            a.kode_posisi,
            a.nama_posisi,
            case when a.posisi_id = headone.posisi_id then 'x'else a.parent end as parent,
            a.parent_path,
            a.parent_path_reference,
            a.cabang_id,
            a.active_status,
            x.emp_no as people_id,
            a.pembinaan,
            a.hari,
            a.jam,
            a.flagadd,
            a.up,
            a.down,
            a.orderId
            from od_simposisidir a 
            LEFT JOIN  
                (	select posisi_id from od_simposisidir 
                    where orderId IS NOT NULL
                    order by orderId,kode_posisi ASC limit 1 
                )headone ON headone.posisi_id = a.posisi_id
            left join od_tempmigrateemp x on x.posisi_id = a.posisi_id
            ORDER BY a.nama_posisi ASC
                
           ";

        //    exit;

            }else{
            if($level != '1'){
            //     var_dump('Masuk 0');
            //     echo"<script type='text/javascript'>
            //     window.alert('Alert 1'); 
            //  </script>";   
            $sql    = "select 
            a.posisi_id,
            a.kode_posisi,
            a.nama_posisi,
            case when a.posisi_id = headone.posisi_id then 'x'else a.parent end as parent,
            a.parent_path,
            a.parent_path_reference,
            a.cabang_id,
            a.active_status,
            x.emp_no as people_id,
            a.pembinaan,
            a.hari,
            a.jam,
            a.flagadd,
            a.up,
            a.down,
            a.orderId
            from od_simposisi a 
            LEFT JOIN  
                (	select posisi_id from od_simposisi 
                    where (direktorat_id = '$page') 
                    AND orderId IS NOT NULL
                    order by orderId,kode_posisi ASC limit 1 
                )headone ON headone.posisi_id = a.posisi_id
            left join od_tempmigrateemp x on x.posisi_id = a.posisi_id
            where (a.direktorat_id = '$page')
            ORDER BY a.nama_posisi ASC";
            }else{
            //     var_dump('Masuk 1');
            //     echo"<script type='text/javascript'>
            //     window.alert('Alert 2'); 
            //  </script>";  
            $sql    = "select 
            a.posisi_id,
            a.kode_posisi,
            a.nama_posisi,
            case when a.posisi_id = headone.posisi_id then 'x'else a.parent end as parent,
            a.parent_path,
            a.parent_path_reference,
            a.cabang_id,
            a.active_status,
            x.emp_no as people_id,
            a.pembinaan,
            a.hari,
            a.jam,
            a.flagadd,
            a.up,
            a.down,
            a.orderId
            from od_simposisi a 
            LEFT JOIN  
                (	select posisi_id from od_simposisi 
                    where (direktorat_id = '$page' ) 
                    AND orderId IS NOT NULL
                    order by orderId,kode_posisi ASC limit 1 
                )headone ON headone.posisi_id = a.posisi_id
            left join od_tempmigrateemp x on x.posisi_id = a.posisi_id
            where (a.direktorat_id = '$page')
            ORDER BY a.nama_posisi ASC";
            }

            
        }
        }elseif($filter == '2'){
            // var_dump('Masuk 2');
            // echo"<script type='text/javascript'>
            //     window.alert('Alert 3'); 
            //  </script>";  

            if($page == '30145'){
                $sql = "SELECT 
                a.posisi_id,
                a.kode_posisi,
                a.nama_posisi,
                a.parent,
                a.restruct_remark,
                a.parent_path,
                a.parent_path_reference,
                a.cabang_id,
                a.active_status,
                x.emp_no as people_id,
                a.pembinaan,
                a.hari,
                a.jam,
                a.flagadd,
                a.flag_del,
                a.up,
                a.down,
                a.orderId,
                a.departemen_id,
                a.division_id,
                a.direktorat_id
                from od_simposisi a 
                left join od_tempmigrateemp x on x.posisi_id = a.posisi_id
                where (a.division_id = '$page' OR a.division_id = '$page')
    UNION
    SELECT * FROM od_simposisi b
    WHERE b.posisi_id = (SELECT c.parent FROM od_simposisi c WHERE c.division_id = '$page' ORDER BY c.orderId ASC LIMIT 1)
    AND b.flagadd = '1'
    UNION 
    SELECT * FROM od_simposisi e WHERE e.posisi_id = (SELECT d.parent FROM od_simposisi d
    WHERE d.posisi_id = (SELECT c.parent FROM od_simposisi c WHERE c.division_id = '$page' ORDER BY c.orderId ASC LIMIT 1))
    AND e.flagadd = '1'
    UNION 
    SELECT * FROM od_simposisi f WHERE f.posisi_id = (SELECT e.parent FROM od_simposisi e WHERE e.posisi_id = (SELECT d.parent FROM od_simposisi d
    WHERE d.posisi_id = (SELECT c.parent FROM od_simposisi c WHERE c.division_id = '$page' ORDER BY c.orderId ASC LIMIT 1)))
    AND f.flagadd = '1'
    UNION 
    SELECT
    '12003' AS posisi_id, 
    'INSERT_GAP-6-1_5855' AS kode_posisi, 
    '' AS nama_posisi,
    '5846' AS parent,
    '' AS restruct_remark,
    '14774,5846' AS parent_path,
    '0' AS parent_path_reference,
    '0' AS cabang_id,
    '1' AS active_status,
    '0' AS people_id,
    '' AS pembinaan,
    '' AS hari,
    '' AS jam,
    '1' AS flagadd,
    '0' AS flag_del,
    '' AS up,
    '' AS down,
    '3' AS orderId,
    '' AS departemen_id,
    '30145' AS division_id,
    '50131' AS direktorat_id
    UNION 
    SELECT 
    g.posisi_id AS posisi_id, 
    g.kode_posisi AS kode_posisi, 
    g.nama_posisi AS nama_posisi,
    'x' AS parent,
    g.restruct_remark AS restruct_remark,
    g.parent_path AS parent_path,
    g.parent_path_reference AS parent_path_reference,
    g.cabang_id AS cabang_id,
    g.active_status AS active_status,
    '99-0517' AS people_id,
    g.pembinaan AS pembinaan,
    g.hari AS hari,
    g.jam AS jam,
    g.flagadd AS flagadd,
    g.flag_del AS flag_del,
    g.up AS up,
    g.down AS down,
    g.orderId AS orderId,
    '' AS departemen_id,
    '30145' AS division_id,
    '50131' AS direktorat_id
    FROM od_simposisi g WHERE g.posisi_id = '5846'";
            }else{
            $sql    = "select 
            a.posisi_id,
            a.kode_posisi,
            a.nama_posisi,
            case when a.posisi_id = headone.posisi_id then 'x'else a.parent end as parent,
            a.parent_path,
            a.parent_path_reference,
            a.cabang_id,
            a.active_status,
            x.emp_no as people_id,
            a.pembinaan,
            a.hari,
            a.jam,
            a.flagadd,
            a.up,
            a.down,
            a.orderId
            from od_simposisi a 
            LEFT JOIN  
                (	select posisi_id from od_simposisi 
                    where (division_id = '$page' OR division_id = '$page') 
                    AND orderId IS NOT NULL
                    order by orderId,kode_posisi ASC limit 1 
                )headone ON headone.posisi_id = a.posisi_id
            left join od_tempmigrateemp x on x.posisi_id = a.posisi_id
            where (a.division_id = '$page' OR a.division_id = '$page')
            ORDER BY a.nama_posisi ASC";
            }        }elseif($filter == '1'){
            // echo"<script type='text/javascript'>
            //     window.alert('Alert 4'); 
            //  </script>"; 
            $sql    = "select 
            a.posisi_id,
            a.kode_posisi,
            a.nama_posisi,
            case when a.posisi_id = headone.posisi_id then 'x'else a.parent end as parent,
            a.parent_path,
            a.parent_path_reference,
            a.cabang_id,
            a.active_status,
            x.emp_no as people_id,
            a.pembinaan,
            a.hari,
            a.jam,
            a.flagadd,
            a.up,
            a.down,
            a.orderId
            from od_simposisi a 
            LEFT JOIN  
                (	select posisi_id from od_simposisi 
                    where (departemen_id = '$page' OR departemen_id = '$page') 
                    AND orderId IS NOT NULL
                    order by orderId,kode_posisi ASC limit 1 
                )headone ON headone.posisi_id = a.posisi_id
                left join od_tempmigrateemp x on x.posisi_id = a.posisi_id
            where (a.departemen_id = '$page' OR a.departemen_id = '$page')
            ORDER BY a.nama_posisi ASC
            ";
        }
        
    }else{
        // echo"<script type='text/javascript'>
        //         window.alert('Alert 5'); 
        //      </script>"; 
        if($level == '1'){
            // echo"<script type='text/javascript'>
            //     window.alert('Alert 6'); 
            //  </script>"; 
            $sql    = "SELECT * FROM od_simposisi a WHERE a.direktorat_id = '121212'";
        }else{
            // echo"<script type='text/javascript'>
            //     window.alert('Alert 7'); 
            //  </script>"; 
        }
    }

    // echo"<script type='text/javascript'>
    //             window.alert('Alert Exit'); 
    //          </script>"; 
    //          echo $sql;
    // exit();
    $posisiAcess = array();
    $stmt = $connection->prepare($sql);
    $stmt->execute();
    foreach ($stmt->fetchAll() as $k => $v) {
        // echo"<script type='text/javascript'>
        //         window.alert('Alert Looping'); 
        //      </script>"; 
        $posisi = new Posisi();
        $posisi->setPosisiId($v['posisi_id']);
        $posisi->setKodePosisi($v['kode_posisi']);
        $posisi->setParent($v['parent']);
        $posisi->setNamaPosisi($v['nama_posisi']);
        $posisi->setParent($v['parent']);
        $posisi->setParentPath($v['parent_path']);
        $posisi->setCabangId($v['cabang_id']);
        $posisi->setActiveStatus($v['active_status']);
        $posisi->setPeopleId(getPeopleById($v['people_id'],$connection));
        $posisi->setPembinaan($v['pembinaan']);
        $posisi->setHari($v['hari']);
        $posisi->setJam($v['jam']);
        $posisi->setFlagadd($v['flagadd']);
        $posisi->setUp($v['up']);
        $posisi->setorderId($v['orderId']);
        $posisiAcess[] = $posisi;
    }
    return $posisiAcess;
}

$all = getOrgData($connection);
//echo var_dump($all)."<br>";
//echo var_dump($rows)."<br>";
//echo var_dump($id)."<br>";
//untuk mendapatkan menu
function has_children($rows, $id) {
    foreach ($rows as $row) {
        if ($row->getParent() == $id)
            return true;
    }
    return false;
}

function build_menu($rows, $parent = 0, $vert = 0) {
    $view   = isset($_POST['filter']) ? $_POST['filter'] : 0;

    if ($vert == 1) {
        $result = "<ul type=\"vertical\">";
    } else {
        $result = "<ul>";
    }
    foreach ($rows as $row) {
        $i = $row->getFlagadd();
        $y = 1+$i;
        if ($row->getParent() == $parent) {
                // $type = '0';
			if (empty($row->getPeopleId()->getGrade()) && empty($row->getPeopleId()->getName()) )
				{
					$gradex = '0';
					$infox = 'VACANT';
                    $type = 'lurus';
				}
			else{

					$gradex = '1';
					$infox = 'XX';
                    $type = '0';
				};
			
			if (empty($row->getPeopleId()->getLos())) 
				{
					$losx = '0';
				}
			else{
					$losx = ($row->getPeopleId()->getLos());
				};
                
               
                // $row->getFlagadd()===undifined;
                //  echo var_dump($row->getFlagadd())."<br>";
            if($row->getFlagadd() == 1){
                $result .= "<li id='{$row->getFlagadd()}' id1='{$row->getUp()}' id2='{$row->getPeopleId()->getPicture()}' id3='{$row->getorderId()}' id4='{$row->getPeopleId()->getPeopleId1()}'>";
            }elseif($gradex != '0'){
                if($row->getPeopleId()->getGrade() == '0'){
                    $grade  = 'NA';
                }else{
                    $grade  = $row->getPeopleId()->getGrade();
                }
                $result .= "<li id='{$row->getFlagadd()}' id1='{$row->getUp()}' id2='{$row->getPeopleId()->getPicture()}' id3='{$row->getorderId()}' id4='{$row->getPeopleId()->getPeopleId1()}'>
                <table>
                    <tr>
                        <td style='text-align:left'><b style='font-family: Arial;'>{$row->getPeopleId()->getName()}</b></td>
                    </tr>
                    <tr>
                        <td style='text-align:left'><p style='margin-top:0px;margin-bottom:0px; font-family: Arial;'>{$row->getNamaPosisi()}</p></td>
                    </tr>
                    <tr>
                        <td>
                            <table>
                            <tr>
                                <td style='width:100%; text-align:left;'><b style='font-family: Arial; font-size:15px'>Join date : {$row->getPeopleId()->getJoindate()}</b></td>
                            </tr>
                            <tr>
                                <td>
                                    <table>
                                        <tr>
                                        <td style='text-align:left; '><b style='font-family: Arial; font-size:15px; margin-right:10px'>Age : {$row->getPeopleId()->getAge()}</b></td>
                                        <td>|</td>
                                        <td style='text-align:left;'><b style='margin-left: 5px; font-family: Arial; font-size:15px; margin-right:10px'>Grade : {$grade}</b></td>
                                        <td>|</td>
                                        <td style='text-align:left'><b style='margin-left:5px; font-family: Arial; font-size:15px'>LOS : {$losx}</b></td>
                            


                                        </tr>
                                    </table>
                                </td>
                                
                            </tr>
                            
                            </table>
                        </td>
                    </tr>
                    
                </table>";
                // <tr>
                //         <table style='margin-top:5px'>
                //             <tr>
                //                 <td style='text-align:left'>
                //                     <i><b style='font-family: Arial; font-size:12px'>For more detail, click the profile picture !</b></i>
                //                 </td>
                //             </tr>
                //         </table>
                //     </tr>
            }elseif($gradex == '0'){
                if($row->getorderId() != '0'){
                    $result .= "<li id='{$row->getFlagadd()}' id1='{$row->getUp()}' id2='{$row->getPeopleId()->getPicture()}' id3='{$row->getorderId()}' id4='{$row->getPeopleId()->getPeopleId1()}'>
                    <table>
                        <tr>
                            <td style='text-align:left'>
                                <b style='font-family: Arial; font-size:18px'>VACANT</b>
                            </td>
                        </tr>
                        <tr>
                            <td style='text-align:left'>
                                <p style='margin-top:0px;margin-bottom:0px; font-family: Arial;'>{$row->getNamaPosisi()}</p>
                            </td>
                        </tr>
                        
                    </table>";
                }else{
                    $result .= "<li id='{$row->getFlagadd()}' id1='{$row->getUp()}' id2='{$row->getPeopleId()->getPicture()}' id3='{$row->getorderId()}' id4='{$row->getPeopleId()->getPeopleId1()}'>
                    <table align='center' style='margin-top:25%'><tr><td style='text-align:left'><b style='font-family: Arial; font-size:18px'>PT GAJAH TUNGGAL Tbk</b></td></tr></table>";
                }
            }
            if (has_children($rows, $row->getPosisiId()))
                $result .= build_menu($rows, $row->getPosisiId(), $row->getPembinaan());
            // $result .= "</div>";
            $result .= "</li>";
            // $result .= "<input type='hidden' id='view' value='{$view}'>";
            $y++;
          
        }
        // $i++;
        
    }
    
    $result .= "</ul>";

    return $result;
}
?>

            
<input type="hidden" id="validate" value="test">
           
        <div class="modal fade" id="modal-default">
          <div class="modal-dialog modal-lg">
            <div class="modal-content">
              <div class="modal-header">
                
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"><b>Detail Profile</b></h4>
              </div>
              <div class="modal-body" id="yanampilmodal">
                
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default pull-right" data-dismiss="modal">Close</button>
                <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
              </div>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->
       
  

            
                
                <!-- <input type="hidden" class="filterview" id="bisa" value="<?php echo $view; ?>">
                <input type="hidden" class="valpage" id="valpage" value="<?php echo $page; ?>"> -->
                

               


                <!-- <center> -->
                <div style="height: 1681.5 px ; text-align:center; width:" id="main">
                    <center>
                    <div id="strukturorg" style="width: max-content !important; height: max-content !important;">
                        <div class="container" >
                            <ul id="tree-data" style="display:none">
                                <!-- <li id="root" style="background-color: ;">
                                    <b>Struktur Organisasi</b> -->
                                    <?php echo build_menu($all); ?>
                                <!-- </li> -->
                            </ul>
                            <div id="tree-view" class="background"></div>		
                        </div>
                    </div>
                    <div id="preview"></div>
                    </center>
                    
                </div>
                <!-- </center> -->
            

        <script>
// Get the modal
var modal = document.getElementById("myModal");

// Get the button that opens the modal
var btn = document.getElementById("jancuk1");

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// When the user clicks the button, open the modal 
btn.onclick = function() {
  modal.style.display = "block";
}

// When the user clicks on <span> (x), close the modal
span.onclick = function() {
  modal.style.display = "none";
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
}
</script>