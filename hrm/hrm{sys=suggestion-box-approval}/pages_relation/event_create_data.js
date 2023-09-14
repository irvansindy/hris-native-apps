$(document).ready(function () {
    // global variable for master planing step
    var list_input_master_planing_step = []
    // for create first data suggestion innov pralon
    $(document).on('click', '#create_data_Suggestion', function(e) {
        e.preventDefault();
        $.ajax({
            url: 'php_action/fetchIdentifyCategoryMaster',
            type: 'POST',
            timeout: 120000,
            dataType: 'json',
            async: true,
            success:function(response) {
                $('#data_list_root_cause').empty()
                for (let index = 0; index < response.length; index++) {
                    $('#data_list_root_cause').append(
                        `
                        <tr>
                            <td>
                                ${response[index].name}
                            </td>
                            <td>
                                <div class="row">
                                    <div class="col-10">
                                    <input type="hidden" value="${response[index].id}" name="input_category_id_${response[index].id}[]">
                                    <input class="input--style-6 border-0" id="input_possible_direct_cause_${response[index].name.replace(/ /g,"_")}" placeholder="Possible Direct Cause ${response[index].name}" name="input_possible_direct_cause_${response[index].name.replace(/ /g,"_")}[]" type="Text" value="" placeholder="Room Code">
                                    </div>
                                    <div class="col-sm">
                                        <button class="btn btn-primary btn-sm" id="add_dynamic_form_${response[index].name.replace(/ /g,"_")}" data-categoryId="${response[index].id}" type="button">
                                            <i class="fa-solid fa-plus"></i>
                                        </button>
                                    </div>
                                </div>
                                <div id="dynamic_form_${response[index].name.replace(/ /g,"_")}"></div>
                            </td>
                        </tr>
                        ` 
                    )
                }
            }
        })

    })
    
    // append list data planing root cause
    $('#data_list_planing_root_cause').empty()
    $('#data_list_planing_root_cause').append(
        `
            <tr>
                <td>
                    <input class="input--style-6 border-0 input_planing_root_cause" id="input_planing_root_cause" placeholder="Planing Root Cause" name="input_planing_root_cause[]" type="Text" value="" placeholder="Room Code">
                </td>
                <td style="text-align: center;">
                    <button class="btn btn-primary btn-sm add_dynamic_form_root_cause" id="add_dynamic_form_root_cause" type="button">
                        <i class="fa-solid fa-plus"></i>
                    </button>
                </td>
            </tr>
        `
    )

    // add dynamic form planing root cause
    $(document).on('click', '#add_dynamic_form_root_cause', function(e) {
        e.preventDefault()
        $('#data_list_planing_root_cause').append(
            `
                <tr class="array_form_planing_root_cause">
                    <td>
                        <input class="input--style-6 border-0 input_planing_root_cause" id="input_planing_root_cause" placeholder="Planing Root Cause" name="input_planing_root_cause[]" type="Text" value="" placeholder="Room Code">
                    </td>
                    <td style="text-align: center;">
                        <button class="btn btn-danger btn-sm pop_dynamic_form_root_cause" id="pop_dynamic_form_root_cause" type="button">
                            <i class="fa-solid fa-minus"></i>
                        </button>
                    </td>
                </tr>
            `
        )
    })

    // pop dynamic form planing root cause
    $(document).on('click', '#pop_dynamic_form_root_cause', function(e) {
        e.preventDefault()
        $(this).closest('.array_form_planing_root_cause').remove()
    })

    // call api summernote 
    $('.suggestion_summernote').summernote({
        tabsize: 2,
        height: 150,
        // width: 600,
        spellCheck: true,
        // placeholder: 'Problem Identification'
    });

    // add dynamical form for Possible Direct Cause Man
    $(document).on('click', '#add_dynamic_form_Man', function() {
        $('#dynamic_form_Man').append(
            `
            <div class="row array_dynamic_form_Man mt-2">
                <div class="col-10">
                    <input type="hidden" value="1" name="input_category_id_1[]">
                    <input class="input--style-6 border-0" id="input_possible_direct_cause_Man" placeholder="Possible Direct Cause Man" name="input_possible_direct_cause_Man[]" type="Text" value="" placeholder="Room Code">
                </div>
                <div class="col-sm">
                    <button class="btn btn-danger btn-sm" id="pop_dynamic_form_Man" data-categoryId="" type="button">
                    <i class="fa-solid fa-minus"></i>
                    </button>
                </div>
            </div>
            `
        )
    })

    // delete dynamical form for Possible Direct Cause Man
    $(document).on('click', '#pop_dynamic_form_Man', function () {
        $(this).closest('.array_dynamic_form_Man').remove();
    });
    
    // add dynamical form for Possible Direct Cause Machine
    $(document).on('click', '#add_dynamic_form_Machine', function() {
        $('#dynamic_form_Machine').append(
            `
            <div class="row array_dynamic_form_Machine mt-2">
                <div class="col-10">
                    <input type="hidden" value="2" name="input_category_id_2[]">
                    <input class="input--style-6 border-0" id="input_possible_direct_cause_Machine" placeholder="Possible Direct Cause Machine" name="input_possible_direct_cause_Machine[]" type="Text" value="" placeholder="Room Code">
                </div>
                <div class="col-sm">
                    <button class="btn btn-danger btn-sm" id="pop_dynamic_form_Machine" data-categoryId="" type="button">
                    <i class="fa-solid fa-minus"></i>
                    </button>
                </div>
            </div>
            `
        )
    })

    // delete dynamical form for Possible Direct Cause Machine
    $(document).on('click', '#pop_dynamic_form_Machine', function () {
        $(this).closest('.array_dynamic_form_Machine').remove();
    });

    // add dynamical form for Possible Direct Cause Method
    $(document).on('click', '#add_dynamic_form_Method', function() {
        $('#dynamic_form_Method').append(
            `
            <div class="row array_dynamic_form_Method mt-2">
                <div class="col-10">
                    <input type="hidden" value="3" name="input_category_id_3[]">
                    <input class="input--style-6 border-0" id="input_possible_direct_cause_Method" placeholder="Possible Direct Cause Method" name="input_possible_direct_cause_Method[]" type="Text" value="" placeholder="Room Code">
                </div>
                <div class="col-sm">
                    <button class="btn btn-danger btn-sm" id="pop_dynamic_form_Method" data-categoryId="" type="button">
                    <i class="fa-solid fa-minus"></i>
                    </button>
                </div>
            </div>
            `
        )
    })

    // delete dynamical form for Possible Direct Cause Method
    $(document).on('click', '#pop_dynamic_form_Method', function () {
        $(this).closest('.array_dynamic_form_Method').remove();
    });
    
    // add dynamical form for Possible Direct Cause Material
    $(document).on('click', '#add_dynamic_form_Material', function() {
        $('#dynamic_form_Material').append(
            `
            <div class="row array_dynamic_form_Material mt-2">
                <div class="col-10">
                    <input type="hidden" value="4" name="input_category_id_4[]">
                    <input class="input--style-6 border-0" id="input_possible_direct_cause_Material" placeholder="Possible Direct Cause Material" name="input_possible_direct_cause_Material[]" type="Text" value="" placeholder="Room Code">
                </div>
                <div class="col-sm">
                    <button class="btn btn-danger btn-sm" id="pop_dynamic_form_Material" data-categoryId="" type="button">
                    <i class="fa-solid fa-minus"></i>
                    </button>
                </div>
            </div>
            `
        )
    })

    // delete dynamical form for Possible Direct Cause Material
    $(document).on('click', '#pop_dynamic_form_Material', function () {
        $(this).closest('.array_dynamic_form_Material').remove();
    });
    
    // add dynamical form for Possible Direct Cause Mother_Nature
    $(document).on('click', '#add_dynamic_form_Mother_Nature', function() {
        $('#dynamic_form_Mother_Nature').append(
            `
            <div class="row array_dynamic_form_Mother_Nature mt-2">
                <div class="col-10">
                    <input type="hidden" value="5" name="input_category_id_5[]">
                    <input class="input--style-6 border-0" id="input_possible_direct_cause_Mother_Nature" placeholder="Possible Direct Cause Mother Nature" name="input_possible_direct_cause_Mother_Nature[]" type="Text" value="" placeholder="Room Code">
                </div>
                <div class="col-sm">
                    <button class="btn btn-danger btn-sm" id="pop_dynamic_form_Mother_Nature" data-categoryId="" type="button">
                    <i class="fa-solid fa-minus"></i>
                    </button>
                </div>
            </div>
            `
        )
    })

    // delete dynamical form for Possible Direct Cause Mother_Nature
    $(document).on('click', '#pop_dynamic_form_Mother_Nature', function () {
        $(this).closest('.array_dynamic_form_Mother_Nature').remove();
    });
    
    // add dynamical form for Possible Direct Cause Measurement
    $(document).on('click', '#add_dynamic_form_Measurement', function() {
        $('#dynamic_form_Measurement').append(
            `
            <div class="row array_dynamic_form_Measurement mt-2">
                <div class="col-10">
                <input type="hidden" value="6" name="input_category_id_6[]">
                    <input class="input--style-6 border-0" id="input_possible_direct_cause_Measurement" placeholder="Possible Direct Cause Measurement" name="input_possible_direct_cause_Measurement[]" type="Text" value="" placeholder="Room Code">
                </div>
                <div class="col-sm">
                    <button class="btn btn-danger btn-sm" id="pop_dynamic_form_Measurement" data-categoryId="" type="button">
                    <i class="fa-solid fa-minus"></i>
                    </button>
                </div>
            </div>
            `
        )
    })

    // delete dynamical form for Possible Direct Cause Measurement
    $(document).on('click', '#pop_dynamic_form_Measurement', function(e) {
        e.preventDefault()
        $(this).closest('.array_dynamic_form_Measurement').remove();
    })

    // append confirm_master_planing_root_cause
    // $(document).on('click', '#confirm_master_planing_root_cause', function(e) {
    //     e.preventDefault()

    //     var master_root_cause = []
    //     var list_master_root_cause = document.getElementsByName('input_planing_root_cause[]')
        
    //     for (let index = 0; index < list_master_root_cause.length; index++) {
    //         master_root_cause.push(list_master_root_cause[index].value)
    //     }
    //     master_root_cause = Array.from(new Set(master_root_cause))
    //     var result_root_cause = [...new Set(master_root_cause)]

    //     $('#list_detail_planing_step').empty()

    //     for (let index = 0; index < result_root_cause.length; index++) {
    //         if (result_root_cause[index] == '') {
    //             mymodalss.style.display = "none";
    //             modals.style.display = "block";
    //             document.getElementById("msg").innerHTML = "Planing root cause cannot empty";
    //             return false;
    //         }

    //         // initial data master planing step
    //         var format_master_plan_step = 'planing_step_'+result_root_cause[index].toLowerCase().replace(/ /g,"_")
    //         list_input_master_planing_step.push(format_master_plan_step)

    //         // set add dinamic form planing step
    //         let id_add_button_form_dynamic_planing_step = '#add_dynamic_form_'+format_master_plan_step
    //         let data_list_detail_planing_step = '#data_list_detail_'+format_master_plan_step
    //         let array_dynamic_form_planing_step = '.array_dynamic_form_'+format_master_plan_step
    //         $(data_list_detail_planing_step).empty()
    //         $('#list_detail_planing_step').append(
    //             `
    //             <table class="table table-striped table-bordered table-hover" id="${format_master_plan_step}">
    //                 <thead class="thead-light">
    //                     <tr>
    //                         <td rowspan="2" style="vertical-align: inherit;background: #e9ecef;font-weight: bold;color: #495057; text-align: center;">Step  / Langkah untuk ${result_root_cause[index].toLowerCase().replace(/(?<= )[^\s]|^./g, a=>a.toUpperCase())}</td>
    //                         <td rowspan="2" style="vertical-align: inherit;background: #e9ecef;font-weight: bold;color: #495057; text-align: center;">PIC</td>
    //                         <td rowspan="2" style="vertical-align: inherit;background: #e9ecef;font-weight: bold;color: #495057; text-align: center;">Plan / Act</td>
    //                         <td colspan="3" rowspan="1" style="vertical-align: inherit;background: #e9ecef;font-weight: bold;color: #495057; text-align: center;">Jadwal Untuk ${result_root_cause[index].toLowerCase().replace(/(?<= )[^\s]|^./g, a=>a.toUpperCase())}</td>
    //                     </tr>
    //                     <tr>
    //                         <td style="background: #e9ecef;font-weight: bold;color: #495057; text-align: center;">
    //                             Start</td>
    //                         <td style="background: #e9ecef;font-weight: bold;color: #495057; text-align: center;">
    //                             End</td>
    //                         <td rowspan="2" style="vertical-align: inherit;background: #e9ecef;font-weight: bold;color: #495057; text-align: center;">
    //                             #</td>
    //                     </tr>
    //                 </thead>
    //                 <tbody id="data_list_detail_${format_master_plan_step}">
    //                     <tr>
    //                         <td>
    //                             <input class="input--style-6 border-0" name="input_master_${format_master_plan_step}[]" type="hidden" value="${format_master_plan_step}" placeholder="Master root cause"></input>
    //                             <input class="input--style-6 border-0" name="input_detail_${format_master_plan_step}[]" id="input_detail_${format_master_plan_step}" placeholder="Langkah / Step"></input>
    //                         </td>
    //                         <td>
    //                             <input class="input--style-6 border-0" id="input_pic_${format_master_plan_step}" placeholder="Planing PIC" name="input_pic_${format_master_plan_step}[]" type="Text" value="">
    //                         </td>
    //                         <td>
    //                             <select class="input--style-6 border-0 input_planing_type" name="input_type_${format_master_plan_step}[]" id="input_type_${format_master_plan_step}">
    //                                 <option value="">Select One</option>
    //                                 <option value="planing">Planing</option>
    //                                 <option value="action">Action</option>	
    //                             </select>
    //                         </td>
    //                         <td>
    //                             <input class="input--style-6 border-0" id="input_start_date_${format_master_plan_step}" name="input_start_date_${format_master_plan_step}[]" type="date" value="">
    //                         </td>
    //                         <td>
    //                             <input class="input--style-6 border-0" id="input_end_date_${format_master_plan_step}" name="input_end_date_${format_master_plan_step}[]" type="date" value="">
    //                         </td>
    //                         <td>
    //                             <button class="btn btn-primary btn-sm" id="add_dynamic_form_${format_master_plan_step}" type="button">
    //                                 <i class="fa-solid fa-plus"></i>
    //                             </button>
    //                         </td>
    //                     </tr>
    //                 </tbody>
    //             </table>
    //             `
    //         )
            
    //         $(document).on('click', id_add_button_form_dynamic_planing_step, function(e) {
    //             // alert('add dynamic form planing step')
    //             $(data_list_detail_planing_step).append(
    //                 `
    //                     <tr class="array_dynamic_form_${format_master_plan_step}">
    //                         <td>
    //                             <input class="input--style-6 border-0" name="input_master_${format_master_plan_step}[]" type="hidden" value="${format_master_plan_step}" placeholder="Master root cause"></input>
    //                             <input class="input--style-6 border-0" name="input_detail_${format_master_plan_step}[]" id="input_detail_${format_master_plan_step}" placeholder="Langkah / Step"></input>
    //                         </td>
    //                         <td>
    //                             <input class="input--style-6 border-0" id="input_pic_${format_master_plan_step}" placeholder="Planing PIC" name="input_pic_${format_master_plan_step}[]" type="Text" value="">
    //                         </td>
    //                         <td>
    //                             <select class="input--style-6 border-0 input_planing_type" name="input_type_${format_master_plan_step}[]" id="input_type_${format_master_plan_step}">
    //                                 <option value="">Select One</option>
    //                                 <option value="planing">Planing</option>
    //                                 <option value="action">Action</option>	
    //                             </select>
    //                         </td>
    //                         <td>
    //                             <input class="input--style-6 border-0" id="input_start_date_${format_master_plan_step}" name="input_start_date_${format_master_plan_step}[]" type="date" value="">
    //                         </td>
    //                         <td>
    //                             <input class="input--style-6 border-0" id="input_end_date_${format_master_plan_step}" name="input_end_date_${format_master_plan_step}[]" type="date" value="">
    //                         </td>
    //                         <td>
    //                             <button class="btn btn-danger btn-sm" id="pop_dynamic_form_${format_master_plan_step}" type="button">
    //                                 <i class="fa-solid fa-minus"></i>
    //                             </button>
    //                         </td>
    //                     </tr>
    //                 `
    //             )
    //         })

    //         let pop_dynamic_form_planing_step = '#pop_dynamic_form_'+format_master_plan_step
    //         // delete dynamical form for planing step
    //         $(document).on('click', pop_dynamic_form_planing_step, function(e) {
    //             e.preventDefault()
    //             $(this).closest(array_dynamic_form_planing_step).remove()
    //         })

    //         // empty reset_master_planing_root_cause
    //         $(document).on('click', '#reset_master_planing_root_cause', function(e) {
    //             e.preventDefault()
    //             $('#list_detail_planing_step').empty()
    //             // $('#list_detail_planing_step').remove()
    //             // $(data_list_detail_planing_step).empty()
    //             $(data_list_detail_planing_step).remove()
    //             // $(array_dynamic_form_planing_step).empty()
    //             $(array_dynamic_form_planing_step).remove()
    //             $('#reset_master_planing_root_cause').attr('hidden', true)
    //             $('#confirm_master_planing_root_cause').attr('hidden', false)
    //             $('.input_planing_root_cause').attr('readonly', false)
    //             $('.add_dynamic_form_root_cause').attr('disabled', false)
    //             $('.pop_dynamic_form_root_cause').attr('disabled', false)
    //         })
    //     }
        
    //     // console.log(list_input_master_planing_step)
        
    //     $('#reset_master_planing_root_cause').attr('hidden', false)
    //     $('#confirm_master_planing_root_cause').attr('hidden', true)
    //     $('.input_planing_root_cause').attr('readonly', true)
    //     $('.add_dynamic_form_root_cause').attr('disabled', true)
    //     $('.pop_dynamic_form_root_cause').attr('disabled', true)

    // })

    // for klik button submit draft
    $(document).on('click', '#submit_draft', function(e) {
        e.preventDefault()
        let submit_draft = $(this).data('type_submit')

        // set data 
        var input_suggestion_title = $('#input_suggestion_title').val()
        // var input_diagram = $('#input_diagram').val()
        var input_diagram = $('#input_diagram')[0].files[0]
        // var input_diagram = $('#input_diagram').prop('files')[0]
        var input_problem_identification = $('#input_problem_identification').val()
        var input_problem_background = $('#input_problem_background').val()
        var input_target_specify = $('#input_target_specify').val()
        var input_possible_direct_cause_Man = $('input[name="input_possible_direct_cause_Man[]"]').map(function(){
            return $(this).val()
        }).get()
        var input_possible_direct_cause_Machine = $('input[name="input_possible_direct_cause_Machine[]"]').map(function(){
            return $(this).val()
        }).get()
        var input_possible_direct_cause_Method = $('input[name="input_possible_direct_cause_Method[]"]').map(function(){
            return $(this).val()
        }).get()
        var input_possible_direct_cause_Material = $('input[name="input_possible_direct_cause_Material[]"]').map(function(){
            return $(this).val()
        }).get()
        var input_possible_direct_cause_Mother_Nature = $('input[name="input_possible_direct_cause_Mother_Nature[]"]').map(function(){
            return $(this).val()
        }).get()
        var input_possible_direct_cause_Measurement = $('input[name="input_possible_direct_cause_Measurement[]"]').map(function(){
            return $(this).val()
        }).get()
        var input_planing_root_cause = $('input[name="input_planing_root_cause[]"]').map(function(){
            return $(this).val()
        }).get()


        // let result_detail_planing_step = []

        // for (let index = 0; index < list_input_master_planing_step.length; index++) {
        //     // set variable for send to backend
        //     var result_detail_plan_step = []
        //     let input_master_plan_step = $('input[name="input_master_'+list_input_master_planing_step[index]+'[]"]').map(function(){
        //         return $(this).val()
        //     }).get()
        //     let input_detail_plan_step = $('input[name="input_detail_'+list_input_master_planing_step[index]+'[]"]').map(function(){
        //         return $(this).val()
        //     }).get()
        //     let input_pic_plan_step = $('input[name="input_pic_'+list_input_master_planing_step[index]+'[]"]').map(function(){
        //         return $(this).val()
        //     }).get()
        //     let input_type_plan_step = $('select[name="input_type_'+list_input_master_planing_step[index]+'[]"]').map(function(){
        //         return $(this).val()
        //     }).get()
        //     let input_start_date_plan_step = $('input[name="input_start_date_'+list_input_master_planing_step[index]+'[]"]').map(function(){
        //         return $(this).val()
        //     }).get()
        //     let input_end_date_plan_step = $('input[name="input_end_date_'+list_input_master_planing_step[index]+'[]"]').map(function(){
        //         return $(this).val()
        //     }).get()

        //     let input_master_plan_step = []
        //     let input_detail_plan_step = []
        //     let input_pic_plan_step = []
        //     let input_type_plan_step = []
        //     let input_start_date_plan_step = []
        //     let input_end_date_plan_step = []
            
        //     // console.log(input_detail_plan_step)

        //     $.each(list_input_master_planing_step, function(ind) {
        //         result_detail_plan_step.push({
        //             [list_input_master_planing_step[ind]]: {
        //                 master_plan_step: input_master_plan_step,
        //                 detail_plan_step: input_detail_plan_step,
        //                 pic_plan_step: input_pic_plan_step,
        //                 type_plan_step: input_type_plan_step,
        //                 start_date_plan_step: input_start_date_plan_step,
        //                 end_date_plan_step: input_end_date_plan_step
        //             }
        //         })
        //     })

        // }
        // console.log(input_planing_root_cause)
        // console.log(JSON.stringify(input_planing_root_cause))

        if (input_suggestion_title == '') {
            mymodalss.style.display = "none";
            modals.style.display = "block";
            document.getElementById("msg").innerHTML = "Title cannot empty";
            return false;
        }

        let result_data = {
            'input_suggestion_title': input_suggestion_title,
            'input_diagram': input_diagram,
            'input_problem_identification': input_problem_identification,
            'input_problem_background': input_problem_background,
            'input_target_specify': input_target_specify,
            'input_possible_direct_cause_Man': input_possible_direct_cause_Man,
            'input_possible_direct_cause_Machine': input_possible_direct_cause_Machine,
            'input_possible_direct_cause_Method': input_possible_direct_cause_Method,
            'input_possible_direct_cause_Material': input_possible_direct_cause_Material,
            'input_possible_direct_cause_Mother_Nature': input_possible_direct_cause_Mother_Nature,
            'input_possible_direct_cause_Measurement': input_possible_direct_cause_Measurement,
            'input_planing_root_cause': input_planing_root_cause,
        }

        console.log(JSON.stringify(result_data))

        $.ajax({
            url: 'php_action/CreateDataAsDraft.php',
            type: 'POST',
            data: new FormData($('#form_create_data')[0]),
            // data: result_data,
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
    
    // for klik button submit full
    $(document).on('click', '#submit_full', function(e) {
        e.preventDefault()
        let type_submit = $(this).data('type_submit')
        let total_full_direct_cause_man = $('input[name="input_possible_direct_cause_Man[]"]').map(function(){
            return this.value;
        }).get();
        // console.log(total_full_direct_cause_man[0])
        console.log(type_submit)
        total_full_direct_cause_man[0] == '' ? alert('ga boleh kosong') : alert(total_full_direct_cause_man.length)
    })

})