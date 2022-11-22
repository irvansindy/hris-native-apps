<?php
include "../../../application/config.php";
$employee       = $_GET['employee'];
$requestno      = $_GET['requestno'];
$category       = $_GET['category'];
$question_type  = $_GET['question_type'];
//$modal_id = '1';
$no = 1;
$modal = mysqli_query($connect, "SELECT * FROM trnmquestion a WHERE a.course_category = '$category' GROUP BY a.question_code ORDER BY rand()");

$datarows = mysqli_num_rows($modal);

echo '<input id="datarows" name="datarows" type="hidden" value="' . $datarows . '">';
echo '<input id="employee" name="employee" type="hidden" value="' . $employee . '">';
echo '<input id="requestno" name="requestno" type="hidden" value="' . $requestno . '">';
echo '<input id="question_type" name="question_type" type="hidden" value="' . $question_type . '">';
echo '<input id="category" name="category" type="hidden" value="' . $category . '">';

$SFG = "SELECT 
            COUNT(*) as total,
            total_value,
            final_result
        FROM trndanswer b
        WHERE b.emp_id = '$employee' AND b.question_type = '$question_type' AND b.request_no = '$requestno'";
        $checkifexist = mysqli_fetch_array(mysqli_query($connect, $SFG));

if($checkifexist['total'] > 0) {
    echo '<div class="alert alert-blue" style="width: 100%;cursor: pointer;">
                <img src="../../asset/dist/img/favicon.png" style="width: 17px;">
                <strong>Your Score For This Test : ' . $checkifexist['total_value'] . ' ' . $checkifexist['final_result'] . '</strong> 
            </div>';
}


while ($row = mysqli_fetch_array($modal)) {


    $key_0 = $row['question_description'];
    $key = $row['question_code'];

?>



    <div class="form-row">
        <div class="col-sm-12"><?php echo $no++; ?>. <?php echo $key_0; ?> <span class="required">*</span></div>
        <div class="col-lg-12">
            <div class="input-group">
                <!-- <div class="quiz" id="quiz" data-toggle="buttons"> -->
                <!-- <style>
                        input[type="radio"] {
                            visibility: hidden;
                            height: 0;
                            width: 0;
                        }
                    </style> -->
                <?php
                $detail_answer = mysqli_query($connect, "SELECT 
                                                                a.*,
                                                                CASE 
                                                                    WHEN a.question_index = 1 THEN 'A'
                                                                    WHEN a.question_index = 2 THEN 'B'
                                                                    WHEN a.question_index = 3 THEN 'C'
                                                                    WHEN a.question_index = 4 THEN 'D'
                                                                ELSE 'D'
                                                                END AS choice,
                                                                CASE 
                                                                    WHEN  b.question_index IS NOT NULL THEN 'checked=checked'
                                                                    ELSE ''
                                                                END AS chek,
                                                                CASE 
                                                                    WHEN  b.question_index IS NOT NULL THEN 'disabled'
                                                                    ELSE ''
                                                                END AS dis
                                                                
                                                                FROM trndquestion a
                                                                LEFT JOIN trndanswer b ON a.question_code=b.question_code AND b.emp_id = '$employee' AND a.question_index=b.question_index AND b.question_type = '$question_type' AND b.course_category = '$category'
                                                                WHERE a.question_code = '$key'");

                while ($row_answer = mysqli_fetch_array($detail_answer)) {
                ?>
                    <div class="col-lg-6">
                        <label class="element-animation1 btn btn-lg btn-primary btn-block" style="font-size: 12px;/*! padding-bottom: 28px; */margin-bottom: 5px;min-height: 60px;padding-left: 39px;">
                            <span style="padding-top: 8px;" class="btn-label"><?php echo $row_answer['choice']; ?> .</span>
                            <input type="radio" <?php echo $row_answer['chek']; ?> id="q_answer<?php echo $key; ?><?php echo $row_answer['question_index']; ?>" name="q_answer<?php echo $key; ?>" value="<?php echo $row_answer['question_code']; ?>-<?php echo $row_answer['question_index']; ?>" style=""><?php echo $row_answer['question_description']; ?>
                            <script>
                                $('#q_answer<?php echo $key; ?><?php echo $row_answer['question_index']; ?>').click(function() {
                                    $('input[id="cek<?php echo $key; ?><?php echo $row_answer['question_index']; ?>"]').prop('checked', true);
                                });
                            </script>
                            <input type="checkbox" style="display:none" id="cek<?php echo $key; ?><?php echo $row_answer['question_index']; ?>" name="update[]" value="<?php echo $key; ?>">

                        </label>
                    </div>

                    <script>
                        $("#FormSettlement").unbind('submit').bind('submit', function() {
                            mymodalss.style.display = "block";

                            // remove error messages
                            $(".text-danger").remove();

                            var form = $(this);

                            var regex = /^[a-zA-Z]+$/;

                            var radi = $(':checkbox[name="update[]"]:checked, :checkbox[name="update[]"]:checked').length;
                            var datarows = $("#datarows").val();

                            if (datarows > radi) {
                                mymodalss.style.display = "none";
                                modals.style.display = "block";
                                document.getElementById("msg").innerHTML = "Please fill question";
                                return false;
                            }

                            if (settlement_emp_id) {

                                $.ajax({

                                    url: form.attr('action'),
                                    type: form.attr('method'),
                                    // data: form.serialize(),

                                    // data: $("#myform").serialize(),
                                    data: new FormData(this),
                                    processData: false,
                                    contentType: false,

                                    dataType: 'json',
                                    success: function(response) {

                                        if (response.code == 'success_message_update') {

                                            mymodalss.style.display = "none";

                                            $.ajax({
                                                url: 'php_action/getSelectedAnswer.php',
                                                type: 'post',
                                                data: {
                                                    requestno: '<?php echo $requestno; ?>',
                                                    employee: '<?php echo $employee; ?>',
                                                    event: '<?php echo $course_code; ?>',
                                                    question_type: '<?php echo $question_type; ?>',
                                                    training_category : '<?php echo $category; ?>' 
                                                },
                                                dataType: 'json',

                                                success: function(response) {

                                                    if (response.final_result == 'Failed') {
                                                        modals_href_failed.style.display = "block";
                                                        document.getElementById("msg_href_failed").innerHTML = "We are sorry, you have failed on this test<br>Your Score : " + response.total_value + "/100";
                                                    } else {
                                                        modals_href_passed.style.display = "block";
                                                        document.getElementById("msg_href_passed").innerHTML = "Congratulation, you have passed on this test see you on the next training<br>Your Score : " + response.total_value + "/100";
                                                    }

                                                    mymodalss.style.display = "none";

                                                } // /success
                                            }); // /fetch selected member info
                                        } else {

                                            modals.style.display = "block";
                                            document.getElementById("msg").innerHTML = response.messages;

                                        }
                                    } // /success
                                }); // /ajax
                            } // /if
                            return false;
                        });
                    </script>
                <?php } ?>
            </div>
        </div>
    </div>
    </div>
    <br>
<?php } ?>