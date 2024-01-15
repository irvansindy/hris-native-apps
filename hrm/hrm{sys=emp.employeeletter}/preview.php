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

<?php
$letter = $_GET['letter'];

	//OBJECT ORIENTED STYLE
	$query 					= "SELECT
                                    tclmletterdocument.letter_no,
                                    tclmletterdocument.letter_date,
                                    x1.emp_no as emp_no_signee,
                                    UC_Words(x1.Full_Name) as full_name_signee,
                                    x2.emp_no as emp_no_receiver,
                                    UC_Words(x2.Full_Name) as full_name_receiver,
                                    xx1.pos_name as pos_signee,
                                    xx2.pos_name as pos_receiver,

                                    x3.emp_no as emp_no_signee2,
                                    UC_Words(x3.Full_Name) as full_name_signee2,
                                    xx3.pos_name as pos_signee2,

                                    DATE_FORMAT(tclmletterdocument.letter_date , '%Y-%m-%d') AS letter_date,
                                    DATE_FORMAT(tclmletterdocument.effective_date , '%Y-%m-%d') AS effective_date,
                                    w1.pos_name AS new_position,
                                    w2.pos_name AS old_position,

                                    y1.grade_code AS new_grade,
                                    y2.grade_code AS old_grade,

                                    teomcostcenter.costcenter_name_en

                                FROM tclmletterdocument
                                LEFT JOIN view_employee x1 on tclmletterdocument.letter_signee=x1.emp_id
                                LEFT JOIN view_employee x2 on tclmletterdocument.letter_receiver=x2.emp_id
                                LEFT JOIN view_employee x3 on tclmletterdocument.letter_signee2=x3.emp_id

                                LEFT JOIN hrmorgstruc xx1 ON x1.emp_no=xx1.emp_no
                                LEFT JOIN hrmorgstruc xx2 ON x2.emp_no=xx2.emp_no
                                LEFT JOIN hrmorgstruc xx3 ON x3.emp_no=xx3.emp_no

                                LEFT JOIN hrmemploymenthistory y1 ON y1.history_no = tclmletterdocument.letter_reference 
                                LEFT JOIN
                                				(
															SELECT 
																sub1.history_no,
																sub1.emp_id,
																sub1.careertransition_code,
                                                                sub1.grade_code,
																sub1.position_code
															FROM hrmemploymenthistory sub1
															ORDER BY sub1.effectivedt DESC
														) y2 ON y2.emp_id = y1.emp_id AND y2.history_no <> y1.history_no
										  LEFT JOIN hrmorgstruc w1 ON y1.position_code = w1.pos_code
										  LEFT JOIN hrmorgstruc w2 ON y2.position_code = w2.pos_code
                                LEFT JOIN teomcostcenter ON x2.cost_code = teomcostcenter.costcenter_code
                                WHERE tclmletterdocument.letter_no = '$letter'";

	$result 				= $connect->query($query);
	$row 					= $result->fetch_array(MYSQLI_ASSOC);
	$arr_signee 		    = $row["full_name_signee"];
    $arr_signee2 		    = $row["full_name_signee2"];
    $arr_receiver 		    = $row["full_name_receiver"];
    $arr_emp_no_signee 		= $row["emp_no_signee"];
    $arr_emp_no_receiver 	= $row["emp_no_receiver"];
    $arr_signee_pos 		= $row["pos_signee"];
    $arr_signee2_pos 		= $row["pos_signee2"];
    $arr_receiver_pos 		= $row["pos_receiver"];
    $letter_date            = tgl_indo(date($row["letter_date"]));
    $effective_date         = tgl_indo(date($row["effective_date"]));
    $costcenter_name_en     = $row["costcenter_name_en"];
    $old_position           = $row['old_position'];
    $new_position           = $row['new_position'];
    $old_grade              = $row['old_grade'];
    $new_grade              = $row['new_grade'];
	//OBJECT ORIENTED STYLE

    function tgl_indo($tanggal){
        $bulan = array (
            1 =>   'Januari',
            'Februari',
            'Maret',
            'April',
            'Mei',
            'Juni',
            'Juli',
            'Agustus',
            'September',
            'Oktober',
            'November',
            'Desember'
        );
        $pecahkan = explode('-', $tanggal);
     
        return $pecahkan[2] . ' ' . $bulan[ (int)$pecahkan[1] ] . ' ' . $pecahkan[0];
    }

?>


<?php 
include "../../../application/session/session_ess.php";
$id = $_POST['nc'];

$sql_ambil_template = mysqli_query($connect, "SELECT 
                                                    b.template_content_en
                                                FROM tclmletterdocument a 
                                                LEFT JOIN tsfmlettertemplate b ON a.template_code = b.template_code
                                                WHERE a.letter_no = '$letter'");

$template = mysqli_fetch_assoc($sql_ambil_template);

$var1 = array(
                "{LETTER_NO}",
                "{LETTER_RECEIVER}",
                "{LETTER_SIGNEE}",
                "{RECEIVER_EMP_NO}",
                "{SIGNEE_POSITION}",
                "{RECEIVER_POSITION}",
                "{LETTER_SIGNEE2}",
                "{SIGNEE2_POSITION}",
                "{EFFECTIVE_DATE}",
                "{LETTER_DATE}",
                "{COST_CODE}",
                "{OLD_POSITION}",
                "{NEW_POSITION}",
                "{OLD_GRADE}",
                "{NEW_GRADE}"
            );
$var2 = array(
                "$letter",
                "$arr_receiver",
                "$arr_signee",
                "$arr_emp_no_receiver",
                "$arr_signee_pos",
                "$arr_receiver_pos",
                "$arr_signee2",
                "$arr_signee2_pos",
                "$effective_date",
                "$letter_date",
                "$costcenter_name_en",
                "$old_position",
                "$new_position",
                "$old_grade",
                "$new_grade"
            );
$conversion = str_replace($var1, $var2, $template['template_content_en']); 

?>
<?php echo $conversion ?>








<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns:o="urn:schemas-microsoft-com:office:office" xmlns:x="urn:schemas-microsoft-com:office:excel" xmlns="http://www.w3.org/TR/REC-html40">

<head>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <style>
        body {
            background-color: white;
            font-family: Verdana;
            font-size: 8pt;
        }

        table {
            border-collapse: collapse;
        }

        td {
            background-color: white;
            padding: 2px 4px 2px 4px;
            font: 8pt Verdana;
            vertical-align: top;
        }

        .boxborder {
            padding-left: 1px;
            padding-right: 1px;
            width: 24px;
            height: 25px;
            font: 8pt Verdana;
            border-top: 1px solid white;
            border-left: 1px solid gray;
            border-right: 1px solid gray;
            border-bottom: 1px solid gray;
            vertical-align: middle;
            text-align: center;
            color: black;
        }

        .noboxborder {
            padding-left: 1px;
            padding-right: 1px;
            width: 15px;
            height: 25px;
            font: 8pt Verdana;
            border: 0px none;
            vertical-align: top;
        }

        .smallborder {
            padding-left: 1px;
            padding-right: 1px;
            width: 18px;
            height: 25px;
            font: 8pt Verdana;
            border-top: 1px solid white;
            border-left: 1px solid gray;
            border-right: 1px solid gray;
            border-bottom: 1px solid gray;
            vertical-align: middle;
            text-align: center;
            color: black;
        }

        .noborder {
            background-color: white;
            padding: 2px 4px 2px 4px;
            font: 8pt Verdana;
            border: 0px none;
            vertical-align: top;
        }

        .title {
            font: 8pt Verdana;
            font-weight: bold;
            text-align: center;
            vertical-align: middle;
        }

        a {
            text-decoration: underline;
            color: blue;
            cursor: pointer;
        }

        a:hover {
            color: red;
            background-color: e9e9e9;
        }

        .panel {
            border: none;
            padding: 6px;
            font: 8pt Verdana;
            cursor: pointer;
        }

        .panel:hover {
            color: red;
            background-color: e9e9e9;
        }

        #cross {
            color: black;
            background-image: url(/sf6lib/images/icons/cross.gif);
            background-repeat: no-repeat;
            /*	width:100%;
height:100%;*/
            margin: 0px;
        }

        .classhid {
            display: none;
        }
    </style>
    <script>
        function shwSpan(flag) {
            /*	osps=document.getElementsByTagName("SPAN");
            for (var i=0;i<osps.length;i++) {
            osps[i].style.display=flag;
            }*/
            odiv = document.getElementById('Layerprint');
            odiv.style.display = flag;
            obody = document.body;
            if (flag == "none") {
                for (ib = 0; ib < obody.childNodes.length; ib++) {
                    if (obody.childNodes[ib].tagName != null) {
                        if (obody.childNodes[ib].tagName.toUpperCase() == "TABLE") {
                            if (obody.childNodes[ib].className == "cfdebug") {
                                otmp = obody.removeChild(obody.childNodes[ib]);
                            }
                        }
                    }
                }
            }
        }

        function do_preview() {
            shwSpan('none');
            var OLECMDID = 7;
            /* OLECMDID values:
             * 6 - print
             * 7 - print preview
             * 1 - open window
             * 4 - Save As
             */
            var PROMPT = 1; // 2 DONTPROMPTUSER
            var WebBrowser = '<OBJECT ID="WebBrowser1" WIDTH=0 HEIGHT=0 CLASSID="CLSID:8856F961-340A-11D0-A96B-00C04FD705A2"></OBJECT>';
            document.body.insertAdjacentHTML('beforeEnd', WebBrowser);
            WebBrowser1.ExecWB(OLECMDID, PROMPT);
            WebBrowser1.outerHTML = "";
            setTimeout("shwSpan('');", 1000);
            var btnc = document.getElementById("btnClose");
            if (btnc) btnc.style.display = "none";
        }

        function do_print() {
            shwSpan('none');
            window.print();
            setTimeout("shwSpan('');", 1000);
        }

        function do_excel() {
            window.location = "/sf6/index.cfm?rpid%3DViewTrackComPolicy%26policy%5Fcode%3DCOM%2D2105%2D000001%26origin%3DOrganization%257CCompany%2520Policy%26lreqts%3D1681270148248&media=excel";
        }
    </script>
</head>

<body>


    &nbsp;
    <br>
    <style>
        .colheader {
            position: relative;
        }
    </style>
    







    <br>
    <!-- <span style="font-size: smaller;">
        <em>
            <br>
            <br>
            Printed&nbsp;on&nbsp;:&nbsp;
            <?php echo $SFdatetime; ?>&nbsp;
            <br>Printed&nbsp;by&nbsp;:&nbsp;
            <?php echo $nama; ?>
        </em>
        <br>
    </span>
</body> -->
</html>