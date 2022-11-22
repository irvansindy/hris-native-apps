<!-- <div class="card-header d-flex align-items-center">
                       

                                        <div class="card-actions ml-auto">
                                        <table>

                                        <td>
                                          <div class="toolbar sprite-toolbar-reload" id="refresh" title="Reload"
                                                 onclick="">
                                          </div>
                                        </td>

                                     
                                        
                                        </table>
                                          

                                        </div>
</div> -->
<table id="datatable" width="99%" border="1"
                                                class="table table-bordered table-striped table-hover table-head-fixed">


                                                <thead>
                                                        <tr>
                                                               <th class="fontCustom" style="z-index: 1;" nowrap="nowrap">No</th>
                                                               <th class="fontCustom" style="z-index: 1;">Request No</th>
                                                               <th class="fontCustom" style="z-index: 1;">Employee No</th>
                                                               <th class="fontCustom" style="z-index: 1;">Requester Name</th>                                                     
                                                               <th class="fontCustom" style="z-index: 1;">Request Type</th>
                                                               <th class="fontCustom" style="z-index: 1;">Request Date</th>
                                                               <th class="fontCustom" style="z-index: 1;">Request Status</th>
                                                        </tr>
                                                     

                                                </thead>
                                                       

</table>


<script type="text/javascript" language="javascript" >
$(document).ready(function(){
     
        // Load data
       dataTable = $("#datatable").DataTable({
              
              dom: "B<'row'<'col-sm-12 col-md-9'l><'col-sm-12 col-md-9'f>>" +
                   "<'row'<'col-sm-12'tr>>" +
                   "<'row'<'col-sm-12 col-md-6'i><'col-sm-12 col-md-7'p>>",

              processing: true,
              // retrieve: true,
              searching: true,
              paging: true,
              order: [
                     [0, "asc"]
              ],
               pagingType: "simple",
              bPaginate: true,
              bLengthChange: false,
              bFilter: false,
              bInfo: true,
              bAutoWidth: true,
              language: {
                     "processing": "Please wait..",
              },
              destroy: true,
              columnDefs:[
                     {
                            
                     },
              ], 
              "ajax": "ajax/data_inbox.php"
       });
        //    Load data

               // Refresh Page
       $("#refresh").click(function(e) {
              dataTable.ajax.reload();

              setTimeout(function(){
                     mymodalss.style.display = "none";
                     document.getElementById("msg").innerHTML = "Data refreshed";
                     return false;
              }, 2000);

              mymodalss.style.display = "block";
              document.getElementById("msg").innerHTML = "Data refreshed";
              return false;
                   
       });
       // Refresh Page

       $(document).on('click', '#modal_view_request', function(){

// Loader
mymodalss.style.display = "block";
document.getElementById("msg").innerHTML = "Data refreshed";
// Loader

$('#title_modal').html('View Approval');

var nc    = $(this).attr('id1');

// alert(nc);  
$.ajax({
    url: "ajax/view_approval.php",
    type: "POST",
            data: {
                    nc: nc,
            },
            success: function(ajaxData) {
                    $("#yanampilmodal").html(ajaxData);
                    

                    // Loader
                    mymodalss.style.display = "none";
                    document.getElementById("msg").innerHTML = "Data refreshed";
                    return false;
                    // Loader
            }
    });

});
})
</script>