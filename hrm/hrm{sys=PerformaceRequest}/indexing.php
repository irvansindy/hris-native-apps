<!DOCTYPE html>
<html>
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> 
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <link rel="icon" href="dk.png">
    <title>Dewan Autocomplete - www.dewankomputer.com</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <script src="js/jquery.min.js"></script>
    <style>
      ul{
        background-color:#eee;
        cursor:pointer;
        position: absolute;
        width: 95%;
      }
      li{
        padding:10px;
        border:thin solid #F0F8FF;
      }
      li:hover{
        background-color: #ffc107;
      }
    </style>
  </head>

    <div class="container">
      <div class="row">
        <div class="col-sm-6 offset-sm-3">
          <label>Nama employee</label>  
          <input type="text" name="employee" id="employee" class="form-control" placeholder="Employee" />  
          <div id="employeeList"></div>
        </div>
      </div>
    </div>
</body>  
 </html>  
 <script>  
 $(document).ready(function(){  
      $('#employee').focus(function(){  
           var query = $(this).val();  
           if(query != '')  
           {  
                $.ajax({
                     url:"search.php",
                     method:"POST",
                     data:{query:query},
                     success:function(data)
                     {
                          $('#employeeList').fadeIn();
                          $('#employeeList').html(data);
                     }
                });
           }
      });
      $('#employee').keyup(function(){  
           var query = $(this).val();  
           if(query != '')  
           {  
                $.ajax({
                     url:"search.php",
                     method:"POST",
                     data:{query:query},
                     success:function(data)
                     {
                          $('#employeeList').fadeIn();
                          $('#employeeList').html(data);
                     }
                });
           }
      });
      
      $('#employee').blur(function(){  
           $('#employeeList').fadeOut();
      });
      $(document).on('click', 'li', function(){  
           $('#employee').val($(this).text());  
           $('#employeeList').fadeOut();

           var employee = $("#employee").val();
                          alert(employee);

      });  
 });  
 </script>  

