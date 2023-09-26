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
                // $('#submit_reject_suggestion_approval').attr('data-reject_request_no', response[0].request_no);
                $('#create_suggestion_approval').attr('data-suggestion_approval', response[0].request_no);
            }
        })
    })

    // create submit suggestion box
    $(document).on('click', '#create_suggestion_approval', function(e) {
        $('#form_suggestion_approval')[0].reset()
        let suggestion_approval = $(this).data('suggestion_approval')
        if(e.keyCode == 13) {
            e.preventDefault();
            return false;
        }
        $('#submit_suggestion_approval').attr('data-submit_suggestion_approval', suggestion_approval);
        
        const ratingStars = [...document.getElementsByClassName("rating__star")];

        function executeRating(stars) {
            const starClassActive = "rating__star fas fa-star fa-2xl";
            const starClassInactive = "rating__star far fa-star fa-2xl";
            const starsLength = stars.length;
            let i;
            stars.map((star) => {
                star.onclick = () => {
                    i = stars.indexOf(star);
            
                    if (star.className===starClassInactive) {        
                        for (i; i >= 0; --i) stars[i].className = starClassActive;
                    } else {
                        for (i; i < starsLength; ++i) stars[i].className = starClassInactive;
                    }
                };
            });
        }
        executeRating(ratingStars);        
    })

    // full submit suggestion box approval
    $(document).on('click', '#submit_suggestion_approval', function(e) {
        let submit_suggestion_approval = $(this).data('submit_suggestion_approval')
        let data_rating = [...document.getElementsByClassName("rating__star fas fa-star fa-2xl")]
        $('#request_no_suggestion_approval').val(submit_suggestion_approval)
        let request_no_suggestion_approval = $('#request_no_suggestion_approval').val()
        $('#input_data_rating').val(data_rating.length)
        let input_data_rating = $('#input_data_rating').val()
        let input_remark_approval = $('#input_remark_approval').val()
        console.log([
            request_no_suggestion_approval,
            data_rating.length,
            input_data_rating,
            input_remark_approval
        ])
        // return false
        $.ajax({
            url: 'php_action/SubmitApproval.php',
            type: 'POST',
            data : new FormData($('#form_suggestion_approval')[0]),
            timeout: 120000,
            processData: false,
            contentType: false,
            dataType: 'json',
            async: true,
            success: function(response) {
                $(".form-group").removeClass('has-error').removeClass('has-success');
                mymodalss.style.display = "none";
                modals.style.display = "block";
                document.getElementById("msg").innerHTML = response.messages;

                $('#create_data_sub_menu').modal('hide');
                $("[data-dismiss=modal]").trigger({type: "click"});

                datatable.ajax.reload(null, false);
                location.reload();
            },
            error: function(xhr, status, error) {
                mymodalss.style.display = "none";
                modals.style.display = "block";
                document.getElementById("msg").innerHTML = xhr.responseJSON.messages;
            }
        })
    })


    // call api summernote 
    $('.suggestion_summernote_approval').summernote({
        tabsize: 2,
        height: 110,
        spellCheck: true,
        placeholder: 'Remark or Comment'
    });

    // $(document).on('click', '#submit_reject_suggestion_approval', function(e) {
    //     e.preventDefault()
    //     let reject_request_no = $(this).data('reject_request_no')
    //     alert(reject_request_no)
    //     document.getElementById("value_reject_request_no").innerHTML = "Are you sure to reject request " + reject_request_no + " ?";
    //     $("#sel_reject_request").val(reject_request_no);
    // })

})