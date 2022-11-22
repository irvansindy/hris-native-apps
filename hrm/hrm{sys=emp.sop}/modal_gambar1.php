<?php
include "../../application/config.php";
$nc = $_POST['id'];
?>

<link rel="stylesheet" href="w3.css">

<div class="modal-body">
            <fieldset id="fset_1">
                <div class="form-row">
                    <?php
                        $sqlBusinessPic = "SELECT * FROM hrdprosedurupload where idProsedur = '$nc' ORDER BY bpOrder ASC";
                        $businessPic = mysqli_query($connect, $sqlBusinessPic);

                        if(mysqli_num_rows($businessPic) == 0){
                            echo'<b style = "margin-left : auto; margin-right : auto; margin-top : 20px">No data Uploaded</b>';
                        } else {
                                    echo '
                                <div class="w3-content w3-display-container">';
                                    
                                    while($myPic = mysqli_fetch_array($businessPic)) {
                                        echo '<img class="mySlides1" src="image/'.$myPic['businessPicture'].'" style="width:100%; height : 100%">';
                                    }

                                if(mysqli_num_rows($businessPic) > 1) {
                                        echo'
                                        <button class="w3-button w3-black w3-display-left" onclick="plusDivs(-1)">&#10094;</button>
                                            <button class="w3-button w3-black w3-display-right" onclick="plusDivs(1)">&#10095;</button>
                                        </div>
                                        ';
                                } else {
                                    echo'</div>';
                                }
                        }
                    ?>
             </fieldset>
           </div>
</div>

<div class="modal-footer">

                    <?php   
                            $sqlGetData = "SELECT * FROM hrdprosedurdoc where idProsedur = '$nc'";
                            $getData = mysqli_query($connect, $sqlGetData);

                            if(mysqli_num_rows($getData) == 0) {
                                echo '<div class="mr-auto">';
                                echo'<font style = "margin-right : auto; margin-left : auto;"><b>';
                                echo 'No document file';
                                echo'</b></font>';
                                echo '</div>';
                            } else {
                                $arrayGetData = mysqli_fetch_array($getData);
                                $data = $arrayGetData['businessPictureDoc'];
                                echo'<div class="mr-auto">';
                                echo '<b>Supporting Document : </b>';
                                echo '<font size = "3"><i>';
                                echo $data;
                                echo '</i></font>';
                                echo '
                                <a href="image/'.$data.'" style = "color : black">
                                <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" style = "padding-left : 3px" class="bi bi-download" viewBox="0 0 16 16">
                                    <path d="M.5 9.9a.5.5 0 0 1 .5.5v2.5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2.5a.5.5 0 0 1 1 0v2.5a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2v-2.5a.5.5 0 0 1 .5-.5z"/>
                                    <path d="M7.646 11.854a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 10.293V1.5a.5.5 0 0 0-1 0v8.793L5.354 8.146a.5.5 0 1 0-.708.708l3 3z"/>
                                </svg>
                                </a>
                                ';
                                echo'</div>';
                            }
                    ?>

                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>

<script>
    var slideIndex = 1;
    showDivs(slideIndex);

    function plusDivs(n) {
    showDivs(slideIndex += n);
    }

    function showDivs(n) {
    var i;
    var x = document.getElementsByClassName("mySlides1");

    if (n > x.length) {slideIndex = 1}
    if (n < 1) {slideIndex = x.length}
    for (i = 0; i < x.length; i++) {
        x[i].style.display = "none";  
    }
        x[slideIndex-1].style.display = "block";  
    }
</script>
