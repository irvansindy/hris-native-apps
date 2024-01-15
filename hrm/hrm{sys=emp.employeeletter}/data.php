<script src="vendor/modal/bootstrap.min.js"></script>

<?php
$search_en             = '';
$search_ea             = '';
// jika nip dan nama terisi
if (!empty($_POST['search_en'])) {
	$search_en             = $_POST['search_en'];
	// AgusPrass 04/03/2021 menambahkan kondisi saat memfilter
}
if (!empty($_POST['search_ea'])) {
	$search_ea                = $_POST['search_ea'];
}
?>


<?php
if (!empty($_POST['cari'])) {
	$filter = $_POST['cari'];
	$filterprint = 'Filter: Ticketing Number Is ' . $_POST['cari'];
} else {
	$filter = '';
	$filterprint = '';
}

?>


<!-- Modal -->
<div class="modal right fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel2"
	data-backdrop="false">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-body">

				<a type="button" class="close" onclick='return stopload()' data-dismiss="modal" aria-label="Close"
					style="margin-top: -15px;">
					<span aria-hidden="true"><img src="../../asset/dist/img/icons/icon_del.png"></span>
				</a>
				<form method="post" id="myform">
					<fieldset id="fset_1" style="margin-top: 25px;border-radius: 5px;border: 1px solid #e4e8ea;">
						<legend>Searching</legend>
						<div class="form-row">
							<div class="col-4 name">Employee No</div>
							<div class="col-sm-8">
								<div class="input-group">

									<input class="input--style-6" autocomplete="off" autofocus="on" id="search_en"
										name="search_en" type="Text" value="" onfocus="hlentry(this)" size="30"
										maxlength="50" validate="NotNull:Invalid Form Entry"
										onchange="formodified(this);" title="">
								</div>
							</div>
						</div>

						<div class="form-row">
							<div class="col-4 name">Employee Name</div>
							<div class="col-sm-8">
								<div class="input-group">

									<input class="input--style-6" autocomplete="off" autofocus="on" name="search_ea"
										id="search_ea" type="Text" value="" onfocus="hlentry(this)" size="30"
										maxlength="50" validate="NotNull:Invalid Form Entry"
										onchange="formodified(this);" title="">
								</div>
							</div>
						</div>

					</fieldset>

					<button class="btn btn-warning" type="submit"
						style="width: 100%;border-radius: 17px;font-weight: bold;letter-spacing: 1px;font-size: 12px;">
						Filter
					</button>
				</form>
			</div>

		</div><!-- modal-content -->
	</div><!-- modal-dialog -->
</div><!-- modal -->





<div class="MaximumFrameHeight card-body table-responsive p-0"
	style="width: 50vw;height: 80vh; width: 60%; margin-right: 5px;overflow: scroll;overflow-x: hidden;margin-top: 17px;">
	<div class="col-12 col-fit" style="margin-top: 17px;">
		<table id="datatable" width="100%" border="1" align="left"
			class="table table-bordered table-striped table-hover table-head-fixed">
			<thead>
				<tr>
					<th class="fontCustom" style="z-index: 1;" nowrap="nowrap">No</th>
					<th class="fontCustom" style="z-index: 1;">Employee No</th>
					<th class="fontCustom" style="z-index: 1;">Employee Name</th>
					<th class="fontCustom" style="z-index: 1;">Position Name</th>
					<th class="fontCustom" style="z-index: 1;">Employement Status</th>
				</tr>
			</thead>
		</table>
	</div>
</div>


<!-- Modal untuk reqest requester -->
<div class="modal fade" id="modal-view-nationality">
	<div class="modal-dialog modal-md">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title" id="title_modal"></h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close" style="margin-top: -15px;">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div id="yanampilmodal"></div>

		</div>
		<!-- /.modal-content -->
	</div>
	<!-- /.modal-dialog -->
</div>
<!-- /.modal -->
<!-- Modal untuk reqest requester -->




<!-- Modal untuk reqest requester -->
<div class="modal fade" id="modal-default">
	<div class="modal-dialog modal-md">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title" id="title_tambah"></h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close" style="margin-top: -15px;">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>

			<div id="tampil_tambah"></div>
		</div>


		<!-- /.modal-content -->
	</div>
	<!-- /.modal-dialog -->
</div>
<!-- /.modal -->
<!-- Modal untuk reqest requester -->

<!-- Modal untuk reqest requester -->
<div class="modal fade" id="modal-preview_approver">
	<div class="modal-dialog modal-md">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title" id="title_preview_app"></h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close" style="margin-top: -15px;">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<!-- <div class="card-body table-responsive p-0" style="width: 100vw; height: 89vh; width: 100%; margin: 5px; overflow: scroll;"> -->
			<div id="tampil_view_app">

			</div>
			<!-- </div> -->

		</div>
		<!-- /.modal-content -->
	</div>
	<!-- /.modal-dialog -->
</div>
<!-- /.modal -->
<!-- Modal untuk reqest requester -->

<script src="../../asset/vendor/datatable/datatables.min.js"></script>

<script type="text/javascript" language="javascript">
	$(document).ready(function () {

		// Load data
		dataTable = $("#datatable").DataTable({

			processing: true,
			lengthMenu: [
				[200, 10, 25, 50, -1],
				[200, 10, 25, 50, 'All Records'],
			],
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
			columnDefs: [{
				orderable: false,
				targets: 0
			}],
			destroy: true,
			"ajax": "ajax/data.php?data1=<?php echo $search_en ?>&data2=<?php echo $search_ea ?>"
		});
		//    Load data

		// Refresh Page
		$("#refresh").click(function (e) {
			dataTable.ajax.reload();

			setTimeout(function () {
				mymodalss.style.display = "none";
				document.getElementById("msg").innerHTML = "Data refreshed";
				return false;
			}, 2000);

			mymodalss.style.display = "block";
			document.getElementById("msg").innerHTML = "Data refreshed";
			return false;

		});
		// Refresh Page
		
		// .fetch_employee_decree
		// $(document).on('click', '.fetch_employee_decree', function() {
		// 	// e.preventDefault()
		// 	let data_emp_id = $(this).data('emp_id')
		// 	console.log(data_emp_id)
		// 	$('#create_data_decree').attr('data-emp_id', data_emp_id);
		// })


	});
</script>