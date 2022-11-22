<?php
/*
 *  ----------------------------------------------------------------
 *  File ini adalah milik Asep Komarudin
 *  Dilarang mengubah dan mengunakan tanpa seizin pembuat
 *  Untuk lebih jelas silahkan menghubungi
 *      Nama    : Asep Komarudin
 *      Telepon : 082121232730
 *      Email   : aasseepp@gmail.com
 *      Blog    : www.pojokcode.com
 *  Kami tidak bertanggung jawab atas apapun yang terjadi
 *  dari pengunaan tanpa izin
 *  ----------------------------------------------------------------
 */

require_once './DBConnection.php';
require_once './People.php';
require_once './Posisi.php';

$conn= new DBConnection();
$connection=$conn->getConnection();

function getPeopleById($id,$connection) {
    $people = new People();
    $sql = "SELECT * FROM view_employee where emp_no='$id'";
    $stmt = $connection->prepare($sql);
    $stmt->execute();
    if ($v = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $people = new People();
        $people->setPeopleId($v['emp_no']);
        $people->setName($v['Full_Name']);
        $people->setGender($v['gender']);
    }
    return $people;
}

function getOrgData($connection) {
    $posisiAcess = array();
    $sql = "SELECT * FROM hrmorgstruclevel";
    $stmt = $connection->prepare($sql);
    $stmt->execute();
    foreach ($stmt->fetchAll() as $k => $v) {
        $posisi = new Posisi();
        $posisi->setPosisiId($v['position_id']);
        $posisi->setKodePosisi($v['pos_code']);
        $posisi->setParent($v['parent_id']);
        $posisi->setNamaPosisi($v['pos_name_en']);
        $posisi->setParentPath($v['parent_path']);
        $posisi->setFlagAdd($v['flag_add']);
        $posisi->setOrgStatus($v['org_status']);
        $posisi->setPeopleId(getPeopleById($v['emp_no'],$connection));
        $posisiAcess[] = $posisi;
    }
    return $posisiAcess;
}

$all = getOrgData($connection);

//untuk mendapatkan menu
function has_children($rows, $id) {
    foreach ($rows as $row) {
        if ($row->getParent() == $id)
            return true;
    }
    return false;
}

function build_menu($rows, $parent = 0, $vert = 0) {
    if ($vert == 1) {
        $result = "<ul type=\"horizontal\">";
    } else {
        $result = "<ul>";
    }
    foreach ($rows as $row) {
        if ($row->getParent() == $parent) {

            if ($row->getFlagAdd() == 0) {
                    if($row->getOrgStatus() == 'Vacant') {
                        $css_add = 'style="border-top: 10px solid #9db798;"';
                    } else {
                        $css_add = '';
                    }
                if ($row->getPeopleId()->getGender() == 1) {
                    
                    $result .= "<li {$css_add} idflag=0>
                    <table>
                        <tr>
                            <td rowspan='2' style='text-align:left'><b style='font-family: Arial;'><img src='images/man.png' width='50'></td>
                            <td style='text-align:left'><b style='font-family: Arial;'>{$row->getPeopleId()->getName()}</td>
                        </tr>
                        <tr>
                            <td style='text-align:left'><b style='font-family: Arial;'><b>{$row->getNamaPosisi()}<br></b></td>
                        </tr>
                    </table>";
                } else if ($row->getPeopleId()->getGender() == 0) {
                    $result .= "<li {$css_add} idflag=0>
                    <table>
                        <tr>
                            <td rowspan='2' style='text-align:left'><b style='font-family: Arial;'><img src='images/girl.png' width='50'></td>
                            <td style='text-align:left'><b style='font-family: Arial;'>{$row->getPeopleId()->getName()}</td>
                        </tr>
                        <tr>
                            <td style='text-align:left'><b style='font-family: Arial;'><b>{$row->getNamaPosisi()}<br></b></td>
                        </tr>
                    </table>";  
                }
                if (has_children($rows, $row->getPosisiId()))
                    $result .= build_menu($rows, $row->getPosisiId(), $row->getPembinaan());
                $result .= "</li>";
            } else if ($row->getFlagAdd() == 1) {
                $result .= "<li idflag=1 id='id1'>";
                if (has_children($rows, $row->getPosisiId()))
                    $result .= build_menu($rows, $row->getPosisiId(), $row->getPembinaan());
                $result .= "</li>";
            }
        }
    }
    $result .= "</ul>";

    return $result;
}
?>
<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <script src="./jquery.min.js"></script>
        <link href="./orgchart/orgchart.css" rel="stylesheet" type="text/css"/>
        <script type="text/javascript" src="./orgchart/orgchart.js"></script>
        <script>
            $(document).ready(function () {
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
    </head>
    <body>
    <div id="tes"> 
    <div>
            <center>
                <div class="container">
                    <ul id="tree-datas" style="display:none">
                        <li id="roots" style="background-color: #0000ff0f;">
                            <b>Struktir Organisasi</b>
                            <?php echo build_menu($all); ?>
                        </li>
                    </ul>
                    <div id="tree-views"></div>		
                </div>
            </center>
        </div>
    </body>
</html>
