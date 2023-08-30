$(document).ready(function () {
    $(document).on('click', '#get_detail_suggestion', function(e) {
        let request_no = $(this).data('request_no')
        // alert(request_no)
        $.ajax({
            url: 'php_action/FetchDataById.php',
			type: 'GET',
			data: {
				request_no: request_no
			},
			dataType: 'json',
			async: true,
            success: function(response) {

            },
            error: function(xhr, status, error) {
                mymodalss.style.display = "none";
                modals.style.display = "block";
                document.getElementById("msg").innerHTML = xhr.responseJSON.messages;
            }
        })
    })
})