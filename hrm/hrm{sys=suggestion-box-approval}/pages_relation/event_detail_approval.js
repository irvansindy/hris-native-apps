$(document).ready(function() {
    $(document).on('click', '#detail_suggestion_approval', function(e) {
        e.preventDefault();
        let request_no = $(this).data('request_no')
        $('#list_user_approval_detail').empty()
        $.ajax({
            url: 'php_action/GetDataApprovalById',
            type: 'GET',
            data : {
                request_no:request_no
            },
            timeout: 120000,
            dataType: 'json',
            async: true,
            success: function(response){
                document.getElementById('detail_approval_request_no').innerHTML = response[0].request_no
                document.getElementById('detail_approval_request_title').innerHTML = response[0].title
                document.getElementById('detail_approval_request_employee').innerHTML = response[0].name
                document.getElementById('detail_approval_request_date').innerHTML = response[0].request_date

                var no = 1;
                for (let index = 0; index < response[1].length; index++) {

                    $('#list_user_approval_detail').append(
                        `
                        <tr>
                            <td style="width:20%;text-align:left;">
                                ${no++}
                            </td>
                            <td style="width:20%;text-align:left;">
                                ${response[1][index]['Full_Name'] == null ? '' : response[1][index]['Full_Name']} - ${response[1][index]['emp_no'] == null ? '' : response[1][index]['emp_no']}
                            </td>
                            <td style="width:20%;text-align:left;">
                                ${response[1][index]['req'] == null ? '' : response[1][index]['req']}
                                </td>
                            <td style="width:20%;text-align:left;">
                                ${response[1][index]['status_approve'] == null ? '' : response[1][index]['status_approve']}
                            </td>
                        </tr>
                        `
                    );
                }
                $('#submit_reject_suggestion_approval').attr('data-reject_request_no', response[0].request_no);
            }
        })
    })

    $(document).on('click', '#submit_reject_suggestion_approval', function(e) {
        e.preventDefault()
        let reject_request_no = $(this).data('reject_request_no')
        alert(reject_request_no)
        document.getElementById("value_reject_request_no").innerHTML = "Are you sure to reject request " + reject_request_no + " ?";
        $("#sel_reject_request").val(reject_request_no);
    })

})