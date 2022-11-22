<link rel="stylesheet" href="../../asset/gt_developer/developer_hris_form.css" />
<script src="vendor/modal/bootstrap.min.js"></script>
<script src="sweetalert.js"></script>
<link rel="stylesheet" href="w3.css">

<div class="col-md-12">
<div class="card">
<div class="card-header d-flex align-items-center" style = "padding-left : 20px; padding-top : 40px; padding-bottom : 40px">
<h4 class="card-title mb-0" style = "font-size : 15px">SOP Setting User Authorization</h4>
<div class="card-actions ml-auto">
</div>
</div>

<!-- Isi Data -->
<div class="card-body table-responsive p-0" style="width: 100vw;height: 78vh; width: 98%; margin: 5px; overflow: scroll;">

<div style = "margin-bottom : 10px; float : right; text-align : right; margin-right : 5px; margin-top : 5px">
<div id="contact">
    <a href = "input.php">
       <button class = "btn btn-primary" style = "width : 100px">Input</button>
    </a>
</div>
</div>

<table class="table table-striped table-hover table-sm table-bordered">
       <thead style = "text-align : center; background-color : black; color : white">
           <th style = "width : 10px; text-align : center">No</th>
           <th style = "width : 150px">Nama Group</th>
           <th style = "width : 100px; text-align : center">Created By</th>
           <th style = "width : 100px; text-align : center">Created Date</th>
           <th style = "width : 100px; text-align : center">Modified By</th>
           <th style = "width : 100px; text-align : center">Modified Date</th>
           <th style = "text-align : center; width :100px">Action</th>
       </thead>

       <tbody>
       <?php
           $sqlDataIndex = "SELECT * FROM hrmgroupotorisasi WHERE status = 'Aktif'";
           $dataIndex = mysqli_query($connect, $sqlDataIndex);

           $no = 1;
           for($i = 0; $i < mysqli_num_rows($dataIndex); $i++) {
               $data = mysqli_fetch_array($dataIndex);
               ?>
                     <tr>
                       <td style = "text-align : center"><?php echo $no; ?></td>
                       <td><?php echo $data['namaGroup']; ?></td>
                       <td style = "text-align : center"><?php echo $data['created_by']; ?></td>
                       <td style = "text-align : center"><?php echo $data['created_date']; ?></td>
                       <td style = "text-align : center"><?php echo $data['modified_by']; ?></td>
                       <td style = "text-align : center"><?php echo $data['modified_date']; ?></td>
                       <td style = "text-align : center">
                           
                           <a href = "edit.php?id=<?php echo $data['idGroup']; ?>">
                               <img src="gambar/image4.png" style = "width : 35px; height : 35px">
                           </a>
                           
                           <button onclick="<?php echo 'deleting'.$data['namaGroup'].'()' ?>" class = "btn btn-primary" style = "background-color : green; border : none; outline : none">Delete</button>
                           <script>
                               function <?php echo 'deleting'.$data['namaGroup'].'()' ?> {  
                                   Swal.fire({
                                   title: 'Are you sure?',
                                   text: "You won't be able to revert this!",
                                   icon: 'warning',
                                   showCancelButton: true,
                                   confirmButtonColor: '#3085d6',
                                   cancelButtonColor: '#d33',
                                   confirmButtonText: 'Yes, delete it!'
                                   
                                   }).then((result) => {
                                   if (result.value) {
                                       Swal.fire({
                                           title: 'Successfully Delete Data',
                                           icon: 'success',
                                           confirmButtonColor: '#3085d6',
                                           confirmButtonText: 'Ok'
                                       }).then((result) => {
                                           if (result.value) {
                                               window.location.href = "delete.php?id=<?php echo $data['idGroup']; ?>";
                                           }
                                       }); 
                                   }
                                   }); 
                               }
                       </script>

                       </td>
                     </tr>
              <?php
              $no++;
              }
              ?>
       </tbody>
</table>
        
</div>

<!-- Footer -->
<div class='card-footer' style='background-color: #eee;height: 37px;padding-top: 5px;'>
<div class='row mb-2'>
<div class='col-sm-10'>
       <?php 
       echo $filterprint; 
       echo '<h6>Still On Development</h6?';
       ?>
</div>
<div class='col-sm-2'>
</div>
</div>
</div>
</div>

<script src="../../asset/vendor/datatable/datatables.min.js"></script>