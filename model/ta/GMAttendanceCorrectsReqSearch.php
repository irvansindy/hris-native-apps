<?php 
       if (!empty($_GET['src_training_request'])) {
              $inp_req             = $_POST['inp_req'];
              $inp_date            = $_POST['inp_date'];
              $inp_enddate         = $_POST['inp_enddate'];
              $where               = "WHERE ((c.emp_no='$username') or (a.created_by='$username')) AND  
                                          (a.request_no like '$inp_req')";
       } else{
              
              $where               = "WHERE ((c.emp_no='$username') or (a.created_by='$username'))";
       }