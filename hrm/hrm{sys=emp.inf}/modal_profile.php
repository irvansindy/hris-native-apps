<?php 
include "../../application/session/session.php";

$username = $_POST['id'];

$sql_info_umum = mysqli_query($connect, "SELECT 
CONCAT(a.Full_Name, ' (',a.emp_no,') ', a.pos_name_en, ', ', b.pos_name_en) AS info
FROM view_employee a
LEFT JOIN hrmorgstruc b ON b.position_id = a.parent_id 
WHERE a.emp_no = '$username'");

$info_umum = mysqli_fetch_assoc($sql_info_umum);

?>

<fieldset id="fset_1">
    <legend>General Information</legend>
        <p><?php echo $info_umum['info']; ?></p>
</fieldset>

<div class="col-md-12">
       <div class="card">
              <div class="card-header d-flex align-items-center">
                     <!-- <h4 class="card-title mb-0">Employee Access Menu Information</h4> -->


                     <div class="card-actions ml-auto">
                            


                     </div>
              </div>

              <style>
              body {
                     font-family: Arial;
              }

              /* Style the tab */
              .tab {
                     overflow: hidden;
                     border: 1px solid #ccc;
                     background-color: #f1f1f1;
              }

              /* Style the buttons inside the tab */
              .tab button {
                     background-color: inherit;
                     float: left;
                     border: none;
                     outline: none;
                     cursor: pointer;
                     padding: 14px 16px;
                     transition: 0.3s;
                     font-size: 12px;
              }

              /* Change background color of buttons on hover */
              .tab button:hover {
                     background-color: #ddd;
              }

              /* Create an active/current tablink class */
              .tab button.active {
                     background-color: #ccc;
              }

              /* Style the tab content */
              .tabcontent {
                     display: none;
                     padding: 6px 12px;
                     border: 1px solid #ccc;
                     border-top: none;
              }

              /* Style the close button */
              .topright {
                     float: right;
                     cursor: pointer;
                     font-size: 28px;
              }

              .topright:hover {
                     color: red;
              }
              </style>


                     <body>


                            <div class="tab">
                                    <button class="tablinks" id="personal">Personal</button>
                                    <button class="tablinks" id="bank">Bank</button>
                                    <button class="tablinks" id="education">Education</button>
                                    <button class="tablinks" id="contact">Emergency Contact</button>
                                    <button class="tablinks" id="family">Family Depent</button>
                            </div>

                            <!-- TAB STARTTED -->

                                <div class="card-body table-responsive p-0" style="width: 100vw;height: 78vh; width: 98.8%; margin: 5px; margin: 5px;overflow: scroll;">  

                                    <div id="tampilansetting" class=""></div>

                                   
                                </div>

                            




                     </body>



                     
              <!-- </div> -->

              <div class='card-footer' style='background-color: #eee;height: 37px;padding-top: 5px;'>

                    

              </div>

       </div>
</div>


<script>
$(document).ready(function() {
    // Default active button
    var element1 = document.getElementById("personal");
    element1.classList.add("active");
    // Default active button

    var id = '<?php echo $username ?>';

    profile();

    $(document).on('click', '#personal', function(){
       var element1 = document.getElementById("personal");
       var element2 = document.getElementById("bank");
       var element3 = document.getElementById("education");
       var element4 = document.getElementById("contact");
       var element5 = document.getElementById("family");

       element1.classList.add("active");
       element2.classList.remove("active");
       element3.classList.remove("active");
       element4.classList.remove("active");
       element5.classList.remove("active");

       profile();
       
    });

    $(document).on('click', '#bank', function(){
       var element1 = document.getElementById("personal");
       var element2 = document.getElementById("bank");
       var element3 = document.getElementById("education");
       var element4 = document.getElementById("contact");
       var element5 = document.getElementById("family");

       element1.classList.remove("active");
       element2.classList.add("active");
       element3.classList.remove("active");
       element4.classList.remove("active");
       element5.classList.remove("active");

       bank();

    });

    $(document).on('click', '#education', function(){
       var element1 = document.getElementById("personal");
       var element2 = document.getElementById("bank");
       var element3 = document.getElementById("education");
       var element4 = document.getElementById("contact");
       var element5 = document.getElementById("family");

       element1.classList.remove("active");
       element2.classList.remove("active");
       element3.classList.add("active");
       element4.classList.remove("active");
       element5.classList.remove("active");

       education();
       
    });

    $(document).on('click', '#contact', function(){
       var element1 = document.getElementById("personal");
       var element2 = document.getElementById("bank");
       var element3 = document.getElementById("education");
       var element4 = document.getElementById("contact");
       var element5 = document.getElementById("family");

       element1.classList.remove("active");
       element2.classList.remove("active");
       element3.classList.remove("active");
       element4.classList.add("active");
       element5.classList.remove("active");

       contact();
       
    });

    $(document).on('click', '#family', function(){
       var element1 = document.getElementById("personal");
       var element2 = document.getElementById("bank");
       var element3 = document.getElementById("education");
       var element4 = document.getElementById("contact");
       var element5 = document.getElementById("family");

       element1.classList.remove("active");
       element2.classList.remove("active");
       element3.classList.remove("active");
       element4.classList.remove("active");
       element5.classList.add("active");

       family();
       
    });


    function profile(){
       $.ajax({
                url: "ajax/profile.php",
                type: "POST",
                        data: {
                                id: id,
                        },
                        success: function(ajaxData) {
                                $("#tampilansetting").html(ajaxData);
                                
                        }
       });
    }

    function bank(){
       $.ajax({
                url: "ajax/bank.php",
                type: "POST",
                        data: {
                                id: id,
                        },
                        success: function(ajaxData) {
                                $("#tampilansetting").html(ajaxData);
                                
                        }
       });
    }

    function education(){
       $.ajax({
                url: "ajax/education.php",
                type: "POST",
                        data: {
                                id: id,
                        },
                        success: function(ajaxData) {
                                $("#tampilansetting").html(ajaxData);
                                
                        }
       });
    }

    function contact(){
       $.ajax({
                url: "ajax/contact.php",
                type: "POST",
                        data: {
                                id: id,
                        },
                        success: function(ajaxData) {
                                $("#tampilansetting").html(ajaxData);
                                
                        }
       });
    }

    function family(){
       $.ajax({
                url: "ajax/family.php",
                type: "POST",
                        data: {
                                id: id,
                        },
                        success: function(ajaxData) {
                                $("#tampilansetting").html(ajaxData);
                                
                        }
       });
    }
});
</script>



