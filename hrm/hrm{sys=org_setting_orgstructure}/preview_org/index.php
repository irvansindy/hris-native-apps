<?php include "../../../application/config.php"; ?>
<!-- 

<div class="modal right fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel2" data-backdrop="false">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <form method="post" id="myform">
                    <fieldset id="fset_1" style="margin-top: 25px;border-radius: 5px;border: 1px solid #e4e8ea;">
                        <legend>Searching</legend>
                        <div class="form-row">
                            <div class="col-4 name">Leave Request</div>
                            <div class="col-sm-8">
                                <div class="input-group">

                                    <select class="input--style-6" name="parent_path" id="parent_path" style="height: 30px;">
                                        <option value="0">Choose Departement</option>
                                        <php
                                        $query_departement = mysqli_query($connect, "SELECT a.*,b.Full_Name,b.cost_code FROM hrmorgstrucdev a
                                                                                        LEFT JOIN view_employee b on a.emp_no=b.emp_no
                                                                                        WHERE a.emp_no <> ''
                                                                                        ORDER BY b.Full_Name asc");
                                        while ($data_departement = mysqli_fetch_assoc($query_departement)) {

                                            $var1 = array(",");
                                            $var2 = array("','");
                                            $conversion_formula = str_replace($var1, $var2, $data_departement['parent_path']);

                                        ?>
                                            <option value="<?php echo $conversion_formula; ?>"><?php echo $data_departement['emp_no']; ?> <?php echo $data_departement['Full_Name']; ?></option>
                                        <php }
                                        ?>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <br>

                        <button type="submit" name="submit_add" id="submit_add" type="button" class="btn btn-warning button_bot">
                            Filter
                        </button>

                    </fieldset>

                </form>
            </div>

        </div><!-- modal-content -->
    </div><!-- modal-dialog -->
</div><!-- modal -->


<br> -->


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

$conn = new DBConnection();
$connection = $conn->getConnection();

function getPeopleById($id, $connection)
{
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

function getOrgData($connection)
{

    $parent_path                 = '';
    if (!empty($_POST['parent_path'])) {
        $parent_path          = $_POST['parent_path'];
        $frameworks           = "WHERE position_id IN ('$parent_path')";
    } else {
        $parent_path          = $_POST['parent_path'];
        $frameworks           = "";
    }

    $posisiAcess = array();
    $sql = "SELECT * FROM hrmorgstrucdev";

    echo $sql;

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
        $posisi->setPeopleId(getPeopleById($v['emp_no'], $connection));
        $posisiAcess[] = $posisi;
    }
    return $posisiAcess;
}

$all = getOrgData($connection);

//untuk mendapatkan menu
function has_children($rows, $id)
{
    foreach ($rows as $row) {
        if ($row->getParent() == $id)
            return true;
    }
    return false;
}

function build_menu($rows, $parent = 0, $vert = 0)
{
    if ($vert == 1) {
        $result = "<ul type=\"horizontal\">";
    } else {
        $result = "<ul>";
    }
    foreach ($rows as $row) {
        if ($row->getParent() == $parent) {

            if ($row->getFlagAdd() == 0) {
                if ($row->getOrgStatus() == 'Vacant') {
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
    <link href="./orgchart/orgchart.css" rel="stylesheet" type="text/css" />
    <script type="text/javascript" src="./orgchart/orgchart.js"></script>
    <script>
        $(document).ready(function() {
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

    <p id="box_add_training_topic" style="position: absolute;margin-top: -10px;">
    <p>

    <div style="margin-left: 144px;">
        <center>
            <div class="container">
                <ul id="tree-data" style="display:none">
                    <li id="root" style="background-color: #0000ff0f;">
                        <b>Struktir Organisasi</b>
                        <?php echo build_menu($all); ?>
                    </li>
                </ul>
                <div id="tree-view"></div>
            </div>
        </center>
    </div>
</body>

</html>



<script>
    $(document).ready(function() {

        $("#box_add_training_topic").load("jobtitle.php",
            function(responseTxt, statusTxt, jqXHR) {
                if (statusTxt == "success") {
                    $("#box_add_training_topic").show();

                }
            }
        );
    });
</script>