$(document).ready(function () {
    $(document).on('click', '#get_detail_suggestion', function(e) {
        e.preventDefault()
        let request_no = $(this).data('request_no')
        $('#icon_file_upload').empty();
        $.ajax({
            url: 'php_action/FetchDataById.php',
			type: 'GET',
			data: {
				request_no: request_no
			},
			dataType: 'json',
			async: true,
            success: function(response) {
                $('#form_detail_data_suggestion')[0].reset()
                $('#detail_request_no').val(response[0].request_no)
                $('#detail_suggestion_title').val(response[0].suggestion_title)

                // set file diagram attachment
                var attachment_diagram = response[0].diagram
                if (attachment_diagram == '') {
                    $('.file-attachment-data').hide()
                    $('#detail_upload_diagram').show()
                } else {
                    $('.file-attachment-data').show()
                    $('#detail_upload_diagram').hide()
                    let file_extension = attachment_diagram.replace(/^.*\./, '');
                    if (file_extension == 'pdf') {
						$('#icon_file_upload').append(`<svg xmlns="http://www.w3.org/2000/svg" width="64" height="64" fill="currentColor" class="bi bi-filetype-pdf" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M14 4.5V14a2 2 0 0 1-2 2h-1v-1h1a1 1 0 0 0 1-1V4.5h-2A1.5 1.5 0 0 1 9.5 3V1H4a1 1 0 0 0-1 1v9H2V2a2 2 0 0 1 2-2h5.5L14 4.5ZM1.6 11.85H0v3.999h.791v-1.342h.803c.287 0 .531-.057.732-.173.203-.117.358-.275.463-.474a1.42 1.42 0 0 0 .161-.677c0-.25-.053-.476-.158-.677a1.176 1.176 0 0 0-.46-.477c-.2-.12-.443-.179-.732-.179Zm.545 1.333a.795.795 0 0 1-.085.38.574.574 0 0 1-.238.241.794.794 0 0 1-.375.082H.788V12.48h.66c.218 0 .389.06.512.181.123.122.185.296.185.522Zm1.217-1.333v3.999h1.46c.401 0 .734-.08.998-.237a1.45 1.45 0 0 0 .595-.689c.13-.3.196-.662.196-1.084 0-.42-.065-.778-.196-1.075a1.426 1.426 0 0 0-.589-.68c-.264-.156-.599-.234-1.005-.234H3.362Zm.791.645h.563c.248 0 .45.05.609.152a.89.89 0 0 1 .354.454c.079.201.118.452.118.753a2.3 2.3 0 0 1-.068.592 1.14 1.14 0 0 1-.196.422.8.8 0 0 1-.334.252 1.298 1.298 0 0 1-.483.082h-.563v-2.707Zm3.743 1.763v1.591h-.79V11.85h2.548v.653H7.896v1.117h1.606v.638H7.896Z"/>
                        </svg>`)
					} else if (file_extension == 'doc') {
						$('#icon_file_upload').append(`<svg xmlns="http://www.w3.org/2000/svg" width="64" height="64" fill="currentColor" class="bi bi-file-earmark" viewBox="0 0 16 16">
                        <path d="M14 4.5V14a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2h5.5L14 4.5zm-3 0A1.5 1.5 0 0 1 9.5 3V1H4a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1V4.5h-2z"/>
                        </svg>`)
					} else if (file_extension == 'docx') {
						$('#icon_file_upload').append(`<svg xmlns="http://www.w3.org/2000/svg" width="64" height="64" fill="currentColor" class="bi bi-filetype-docx" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M14 4.5V11h-1V4.5h-2A1.5 1.5 0 0 1 9.5 3V1H4a1 1 0 0 0-1 1v9H2V2a2 2 0 0 1 2-2h5.5L14 4.5Zm-6.839 9.688v-.522a1.54 1.54 0 0 0-.117-.641.861.861 0 0 0-.322-.387.862.862 0 0 0-.469-.129.868.868 0 0 0-.471.13.868.868 0 0 0-.32.386 1.54 1.54 0 0 0-.117.641v.522c0 .256.04.47.117.641a.868.868 0 0 0 .32.387.883.883 0 0 0 .471.126.877.877 0 0 0 .469-.126.861.861 0 0 0 .322-.386 1.55 1.55 0 0 0 .117-.642Zm.803-.516v.513c0 .375-.068.7-.205.973a1.47 1.47 0 0 1-.589.627c-.254.144-.56.216-.917.216a1.86 1.86 0 0 1-.92-.216 1.463 1.463 0 0 1-.589-.627 2.151 2.151 0 0 1-.205-.973v-.513c0-.379.069-.704.205-.975.137-.274.333-.483.59-.627.257-.147.564-.22.92-.22.357 0 .662.073.916.22.256.146.452.356.59.63.136.271.204.595.204.972ZM1 15.925v-3.999h1.459c.406 0 .741.078 1.005.235.264.156.46.382.589.68.13.296.196.655.196 1.074 0 .422-.065.784-.196 1.084-.131.301-.33.53-.595.689-.264.158-.597.237-.999.237H1Zm1.354-3.354H1.79v2.707h.563c.185 0 .346-.028.483-.082a.8.8 0 0 0 .334-.252c.088-.114.153-.254.196-.422a2.3 2.3 0 0 0 .068-.592c0-.3-.04-.552-.118-.753a.89.89 0 0 0-.354-.454c-.158-.102-.361-.152-.61-.152Zm6.756 1.116c0-.248.034-.46.103-.633a.868.868 0 0 1 .301-.398.814.814 0 0 1 .475-.138c.15 0 .283.032.398.097a.7.7 0 0 1 .273.26.85.85 0 0 1 .12.381h.765v-.073a1.33 1.33 0 0 0-.466-.964 1.44 1.44 0 0 0-.49-.272 1.836 1.836 0 0 0-.606-.097c-.355 0-.66.074-.911.223-.25.148-.44.359-.571.633-.131.273-.197.6-.197.978v.498c0 .379.065.704.194.976.13.271.321.48.571.627.25.144.555.216.914.216.293 0 .555-.054.785-.164.23-.11.414-.26.551-.454a1.27 1.27 0 0 0 .226-.674v-.076h-.765a.8.8 0 0 1-.117.364.699.699 0 0 1-.273.248.874.874 0 0 1-.401.088.845.845 0 0 1-.478-.131.834.834 0 0 1-.298-.393 1.7 1.7 0 0 1-.103-.627v-.495Zm5.092-1.76h.894l-1.275 2.006 1.254 1.992h-.908l-.85-1.415h-.035l-.852 1.415h-.862l1.24-2.015-1.228-1.984h.932l.832 1.439h.035l.823-1.439Z"/>
                        </svg>`)
					} else {
						$('#icon_file_upload').append(`<img id="data_detail_file" class="img-fluid img-thumbnail" src="" alt="file attachment" width="100" height="140">`)
					}
                }

                $('#detail_fileupload').attr("href", 'hrstudio.presfst/'+attachment_diagram)
				$('#data_detail_file').attr("src", 'hrstudio.presfst/'+attachment_diagram)

                $('#detail_problem_identification').summernote({   
                    tabsize: 2,
                    height: 150,
                    spellCheck: true,
                    // focus: true
                })
                $('#detail_problem_identification').summernote('code', response[0].problem_identification)
                $('#detail_problem_background').summernote({   
                    tabsize: 2,
                    height: 150,
                    spellCheck: true,
                    // focus: true
                })
                $('#detail_problem_background').summernote('code', response[0].problem_background)
                $('#detail_target_specify').summernote({   
                    tabsize: 2,
                    height: 150,
                    spellCheck: true,
                    // focus: true
                })
                $('#detail_target_specify').summernote('code', response[0].target_specify)

                // for data detail list category root cause
                $('#detail_data_list_root_cause').empty()
                let master_root_cause = response[3]
                let detail_category_direct_cause = response[1]
                let total_detail_category_direct_cause = detail_category_direct_cause.length

                // check length from detail category direct cause
                if (total_detail_category_direct_cause == 0) {
                    for (let i = 0; i < master_root_cause.length; i++) {
                        $('#detail_data_list_root_cause').append(
                            `
                            <tr>
                                <td>
                                    ${master_root_cause[i].category_name}
                                </td>
                                <td>
                                    <div class="row">
                                        <div class="col-10">
                                        <input type="hidden" value="${master_root_cause[i].id}" name="detail_category_id_${master_root_cause[i].id}[]">
                                        <input class="input--style-6 border-0" id="detail_possible_direct_cause_${master_root_cause[i].category_name.replace(/ /g,"_")}" placeholder="Possible Direct Cause ${master_root_cause[i].category_name}" name="detail_possible_direct_cause_${master_root_cause[i].category_name.replace(/ /g,"_")}[]" type="Text" value="" placeholder="Room Code">
                                        </div>
                                        <div class="col-sm">
                                            <button class="btn btn-primary btn-sm" id="add_detail_dynamic_form_${master_root_cause[i].category_name.replace(/ /g,"_")}" type="button">
                                                <i class="fa-solid fa-plus"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <div id="detail_dynamic_form_${master_root_cause[i].category_name.replace(/ /g,"_")}"></div>
                                </td>
                            </tr>
                            ` 
                        )
                        
                    }
                } else {
                    for (let i = 0; i < master_root_cause.length; i++) {

                        // set variable for data direct cause
                        let value_category_direct_cause = []

                        for (let j = 0; j < detail_category_direct_cause[i].length; j++) {
                            // set variable for check index direct cause
                            let length_category_direct_cause = Object.keys(detail_category_direct_cause[i][j])
                            let list_detail_category_direct_cause = ''
                            if(length_category_direct_cause == 0) {
                                list_detail_category_direct_cause = ``
                            } else {
                                // check index for button direct cause
                                let index_for_button_add_or_pop_direct_cause = detail_category_direct_cause[i].indexOf(detail_category_direct_cause[i][j])
                                // set varibale for result button dynamic form
                                let result_button_add_or_pop_direct_cause = ''
                                // final result button
                                let result_detail_dynamic_form_direct_cause = ''
                                // set variable for add class array dynamic form
                                let class_array_detail_dynamic_form_direct_cause = ''

                                if (index_for_button_add_or_pop_direct_cause == 0) {
                                    result_button_add_or_pop_direct_cause = `<button class="btn btn-primary btn-sm" id="add_detail_dynamic_form_${master_root_cause[i].category_name.replace(/ /g,"_")}" type="button">
                                        <i class="fa-solid fa-plus"></i>
                                    </button>`
                                    result_detail_dynamic_form_direct_cause = ''
                                } else {
                                    result_button_add_or_pop_direct_cause = `<button class="btn btn-danger btn-sm" id="pop_detail_dynamic_form_${master_root_cause[i].category_name.replace(/ /g,"_")}" type="button">
                                        <i class="fa-solid fa-minus"></i>
                                    </button>`
                                    result_detail_dynamic_form_direct_cause = `<div id="detail_dynamic_form_${master_root_cause[i].category_name.replace(/ /g,"_")}"></div>`
                                    class_array_detail_dynamic_form_direct_cause = 'array_detail_dynamic_form_'+master_root_cause[i].category_name.replace(/ /g,"_")
                                }
                                // set data direct cause
                                list_detail_category_direct_cause = `
                                    <div class="row ${class_array_detail_dynamic_form_direct_cause} mt-2">
                                        <div class="col-10">
                                            <input type="hidden" value="${master_root_cause[i].id}" name="detail_category_id_${master_root_cause[i].id}[]">
                                            <input class="input--style-6 border-0" id="detail_possible_direct_cause_${master_root_cause[i].category_name.replace(/ /g,"_")}" placeholder="Possible Direct Cause ${master_root_cause[i].category_name}" name="detail_possible_direct_cause_${master_root_cause[i].category_name.replace(/ /g,"_")}[]" type="Text" value="${detail_category_direct_cause[i][j].possible_direct_cause}" placeholder="Room Code">
                                        </div>
                                        <div class="col-sm">
                                            ${result_button_add_or_pop_direct_cause}
                                        </div>
                                    </div>
                                    ${result_detail_dynamic_form_direct_cause}
                                `
                                // push all data direct cause
                                value_category_direct_cause.push(list_detail_category_direct_cause)
                            }
                        }

                        // result all data list category direct cause for root cause
                        $('#detail_data_list_root_cause').append(
                            `
                            <tr>
                                <td>
                                    ${master_root_cause[i].category_name}
                                </td>
                                <td>
                                    <div id="detail_list_${master_root_cause[i].category_name.replace(/ /g,"_")}"></div>
                                    <div id="detail_dynamic_form_${master_root_cause[i].category_name.replace(/ /g,"_")}"></div>
                                </td>
                            </tr>
                            ` 
                        )

                        let direct_cause_length = value_category_direct_cause.length
                        let id_value_category_direct_cause = '#detail_list_'+master_root_cause[i].category_name.replace(/ /g,"_")
                        if (direct_cause_length == 0) {
                            $(id_value_category_direct_cause).append(
                                `
                                <div class="row">
                                    <div class="col-10">
                                        <input type="hidden" value="${master_root_cause[i].id}" name="detail_category_id_${master_root_cause[i].id}[]">
                                        <input class="input--style-6 border-0" id="detail_possible_direct_cause_${master_root_cause[i].category_name.replace(/ /g,"_")}" placeholder="Possible Direct Cause ${master_root_cause[i].category_name}" name="detail_possible_direct_cause_${master_root_cause[i].category_name.replace(/ /g,"_")}[]" type="Text" value="" placeholder="Room Code">
                                    </div>
                                    <div class="col-sm">
                                        <button class="btn btn-primary btn-sm" id="add_detail_dynamic_form_${master_root_cause[i].category_name.replace(/ /g,"_")}" data-categoryId="${master_root_cause[i].id}" type="button">
                                            <i class="fa-solid fa-plus"></i>
                                        </button>
                                    </div>
                                </div>
                                `
                            )
                        } else {
                            $(id_value_category_direct_cause).append(value_category_direct_cause)
                        }
                    }
                }
                
                // for data list master planing
                $('#detail_data_list_planing_root_cause').empty()
                let total_planing = response[2].length
                if (total_planing == 0) {
                    $('#detail_data_list_planing_root_cause').append(
                        `
                        <tr>
                            <td>
                                <input class="input--style-6 border-0 detail_planing_root_cause" id="detail_planing_root_cause" placeholder="Planing Root Cause" name="detail_planing_root_cause[]" type="Text" value="" placeholder="Room Code">
                            </td>
                            <td style="text-align: center;">
                            
                                <button class="btn btn-primary btn-sm add_detail_dynamic_form_root_cause" id="add_detail_dynamic_form_root_cause" type="button">
                                    <i class="fa-solid fa-plus"></i>
                                </button>
                            </td>
                        </tr>
                        `
                    )
                } else {
                    for (let i = 0; i < total_planing; i++) {
                        let index_planing = response[2].indexOf(response[2][i], 0)
                        let button_detail_planing = ''
                        let class_planing_root_cause = ''
                        if (index_planing == 0) {
                            button_detail_planing = `<button class="btn btn-primary btn-sm add_detail_dynamic_form_root_cause" id="add_detail_dynamic_form_root_cause" type="button">
                                <i class="fa-solid fa-plus"></i>
                            </button>`
                            class_planing_root_cause = ''
                        } else {
                            button_detail_planing = `<button class="btn btn-danger btn-sm pop_detail_dynamic_form_root_cause" id="pop_detail_dynamic_form_root_cause" type="button">
                            <i class="fa-solid fa-minus"></i>
                            </button>`
                            class_planing_root_cause = 'array_detail_form_planing_root_cause'
                        }
                        $('#detail_data_list_planing_root_cause').append(
                            `
                            <tr class="${class_planing_root_cause}">
                                <td>
                                    <input class="input--style-6 border-0 detail_planing_root_cause" id="detail_planing_root_cause" placeholder="Planing Root Cause" name="detail_planing_root_cause[]" type="Text" value="${response[2][i].root_cause}" placeholder="Room Code">
                                </td>
                                <td style="text-align: center;">
                                    ${button_detail_planing}
                                </td>
                            </tr>
                            `
                        )
                        
                    }
                }
                
                // add detail dynamic form planing root cause
                $(document).on('click', '#add_detail_dynamic_form_root_cause', function(e) {
                    e.preventDefault()
                    // alert('detail planing can append')
                    $('#detail_data_list_planing_root_cause').append(
                        `
                            <tr class="array_detail_form_planing_root_cause">
                                <td>
                                    <input class="input--style-6 border-0 detail_planing_root_cause" id="detail_planing_root_cause" placeholder="Planing Root Cause" name="detail_planing_root_cause[]" type="Text" value="" placeholder="Room Code">
                                </td>
                                <td style="text-align: center;">
                                    <button class="btn btn-danger btn-sm pop_detail_dynamic_form_root_cause" id="pop_detail_dynamic_form_root_cause" type="button">
                                        <i class="fa-solid fa-minus"></i>
                                    </button>
                                </td>
                            </tr>
                        `
                    )
                })

                // pop detail dynamic form planing root cause
                $(document).on('click', '#pop_detail_dynamic_form_root_cause', function(e) {
                    e.preventDefault()
                    $(this).closest('.array_detail_form_planing_root_cause').remove()
                })

                // $('#detail_data_list_root_cause').append()

            },
            error: function(xhr, status, error) {
                mymodalss.style.display = "none";
                modals.style.display = "block";
                document.getElementById("msg").innerHTML = xhr.responseJSON.messages;
            }
        })
    })

    // add_detail_dynamic_form_Man
    $(document).on('click', '#add_detail_dynamic_form_Man', function(e) {
        e.preventDefault()
        $('#detail_dynamic_form_Man').append(
            `
            <div class="row array_detail_dynamic_form_Man mt-2">
                <div class="col-10">
                    <input type="hidden" value="1" name="input_category_id_1[]">
                    <input class="input--style-6 border-0" id="detail_possible_direct_cause_Man" placeholder="Possible Direct Cause Man" name="detail_possible_direct_cause_Man[]" type="Text" value="" placeholder="Room Code">
                </div>
                <div class="col-sm">
                    <button class="btn btn-danger btn-sm" id="pop_detail_dynamic_form_Man" data-categoryId="" type="button">
                    <i class="fa-solid fa-minus"></i>
                    </button>
                </div>
            </div>
            `
        )
    })

    // pop_detail_dynamic_form_Man
    $(document).on('click', '#pop_detail_dynamic_form_Man', function(e) {
        e.preventDefault()
        $(this).closest('.array_detail_dynamic_form_Man').remove();
    });

    // add_detail_dynamic_form_Machine
    $(document).on('click', '#add_detail_dynamic_form_Machine', function(e) {
        e.preventDefault()
        $('#detail_dynamic_form_Machine').append(
            `
            <div class="row array_detail_dynamic_form_Machine mt-2">
                <div class="col-10">
                    <input type="hidden" value="1" name="input_category_id_1[]">
                    <input class="input--style-6 border-0" id="detail_possible_direct_cause_Machine" placeholder="Possible Direct Cause Machine" name="detail_possible_direct_cause_Machine[]" type="Text" value="" placeholder="Room Code">
                </div>
                <div class="col-sm">
                    <button class="btn btn-danger btn-sm" id="pop_detail_dynamic_form_Machine" data-categoryId="" type="button">
                    <i class="fa-solid fa-minus"></i>
                    </button>
                </div>
            </div>
            `
        )
    })

    // pop_detail_dynamic_form_Machine
    $(document).on('click', '#pop_detail_dynamic_form_Machine', function(e) {
        e.preventDefault()
        $(this).closest('.array_detail_dynamic_form_Machine').remove();
    });

    // add_detail_dynamic_form_Method
    $(document).on('click', '#add_detail_dynamic_form_Method', function(e) {
        e.preventDefault()
        $('#detail_dynamic_form_Method').append(
            `
            <div class="row array_detail_dynamic_form_Method mt-2">
                <div class="col-10">
                    <input type="hidden" value="1" name="input_category_id_1[]">
                    <input class="input--style-6 border-0" id="detail_possible_direct_cause_Method" placeholder="Possible Direct Cause Method" name="detail_possible_direct_cause_Method[]" type="Text" value="" placeholder="Room Code">
                </div>
                <div class="col-sm">
                    <button class="btn btn-danger btn-sm" id="pop_detail_dynamic_form_Method" data-categoryId="" type="button">
                    <i class="fa-solid fa-minus"></i>
                    </button>
                </div>
            </div>
            `
        )
    })

    // pop_detail_dynamic_form_Method
    $(document).on('click', '#pop_detail_dynamic_form_Method', function (e) {
        e.preventDefault()
        $(this).closest('.array_detail_dynamic_form_Method').remove();
    });

    // add_detail_dynamic_form_Material
    $(document).on('click', '#add_detail_dynamic_form_Material', function(e) {
        e.preventDefault()
        $('#detail_dynamic_form_Material').append(
            `
            <div class="row array_detail_dynamic_form_Material mt-2">
                <div class="col-10">
                    <input type="hidden" value="1" name="input_category_id_1[]">
                    <input class="input--style-6 border-0" id="detail_possible_direct_cause_Material" placeholder="Possible Direct Cause Material" name="detail_possible_direct_cause_Material[]" type="Text" value="" placeholder="Room Code">
                </div>
                <div class="col-sm">
                    <button class="btn btn-danger btn-sm" id="pop_detail_dynamic_form_Material" data-categoryId="" type="button">
                    <i class="fa-solid fa-minus"></i>
                    </button>
                </div>
            </div>
            `
        )
    })

    // pop_detail_dynamic_form_Material
    $(document).on('click', '#pop_detail_dynamic_form_Material', function(e) {
        e.preventDefault()
        $(this).closest('.array_detail_dynamic_form_Material').remove();
    });
    
    // add_detail_dynamic_form_Mother_Nature
    $(document).on('click', '#add_detail_dynamic_form_Mother_Nature', function(e) {
        e.preventDefault()
        $('#detail_dynamic_form_Mother_Nature').append(
            `
            <div class="row array_detail_dynamic_form_Mother_Nature mt-2">
                <div class="col-10">
                    <input type="hidden" value="1" name="input_category_id_1[]">
                    <input class="input--style-6 border-0" id="detail_possible_direct_cause_Mother_Nature" placeholder="Possible Direct Cause Mother Nature" name="detail_possible_direct_cause_Mother_Nature[]" type="Text" value="" placeholder="Room Code">
                </div>
                <div class="col-sm">
                    <button class="btn btn-danger btn-sm" id="pop_detail_dynamic_form_Mother_Nature" data-categoryId="" type="button">
                    <i class="fa-solid fa-minus"></i>
                    </button>
                </div>
            </div>
            `
        )
    })

    // pop_detail_dynamic_form_Mother_Nature
    $(document).on('click', '#pop_detail_dynamic_form_Mother_Nature', function(e) {
        e.preventDefault()
        $(this).closest('.array_detail_dynamic_form_Mother_Nature').remove();
    });

    // add_detail_dynamic_form_Measurement
    $(document).on('click', '#add_detail_dynamic_form_Measurement', function(e) {
        e.preventDefault()
        $('#detail_dynamic_form_Measurement').append(
            `
            <div class="row array_detail_dynamic_form_Measurement mt-2">
                <div class="col-10">
                    <input type="hidden" value="1" name="input_category_id_1[]">
                    <input class="input--style-6 border-0" id="detail_possible_direct_cause_Measurement" placeholder="Possible Direct Cause Mother Nature" name="detail_possible_direct_cause_Measurement[]" type="Text" value="" placeholder="Room Code">
                </div>
                <div class="col-sm">
                    <button class="btn btn-danger btn-sm" id="pop_detail_dynamic_form_Measurement" data-categoryId="" type="button">
                    <i class="fa-solid fa-minus"></i>
                    </button>
                </div>
            </div>
            `
        )
    })

    // pop_detail_dynamic_form_Measurement
    $(document).on('click', '#pop_detail_dynamic_form_Measurement', function(e) {
        e.preventDefault()
        $(this).closest('.array_detail_dynamic_form_Measurement').remove();
    });

    // update draft
    $(document).on('click', '#detail_update_draft', function(e) {
        // e.preventDefault()
        if(e.keyCode == 13) {
            e.preventDefault();
            return false;
        }

        // set all variable in form
        let detail_suggestion_title = $('#detail_suggestion_title').val()
        let detail_problem_identification = $('#detail_problem_identification').val()
        let detail_problem_background = $('#detail_problem_background').val()
        let detail_target_specify = $('#detail_target_specify').val()
        let detail_possible_direct_cause_Man = $('input[name="detail_possible_direct_cause_Man[]"]').map(function(){
            return $(this).val()
        }).get()
        let detail_possible_direct_cause_Machine = $('input[name="detail_possible_direct_cause_Machine[]"]').map(function(){
            return $(this).val()
        }).get()
        let detail_possible_direct_cause_Method = $('input[name="detail_possible_direct_cause_Method[]"]').map(function(){
            return $(this).val()
        }).get()
        let detail_possible_direct_cause_Material = $('input[name="detail_possible_direct_cause_Material[]"]').map(function(){
            return $(this).val()
        }).get()
        let detail_possible_direct_cause_Mother_Nature = $('input[name="detail_possible_direct_cause_Mother_Nature[]"]').map(function(){
            return $(this).val()
        }).get()
        let detail_possible_direct_cause_Measurement = $('input[name="detail_possible_direct_cause_Measurement[]"]').map(function(){
            return $(this).val()
        }).get()
        let detail_planing_root_cause = $('input[name="detail_planing_root_cause[]"]').map(function(){
            return $(this).val()
        }).get()

        if (detail_suggestion_title == '') {
            mymodalss.style.display = "none";
            modals.style.display = "block";
            document.getElementById("msg").innerHTML = "Title cannot empty";
            return false;
        } 
        // else if (detail_problem_identification == '') {
        //     mymodalss.style.display = "none";
        //     modals.style.display = "block";
        //     document.getElementById("msg").innerHTML = "Problem identification cannot empty";
        //     return false;
        // } else if (detail_problem_background == '') {
        //     mymodalss.style.display = "none";
        //     modals.style.display = "block";
        //     document.getElementById("msg").innerHTML = "Problem identification cannot empty";
        //     return false;
        // }

        $.ajax({
            url: 'php_action/UpdateDraft.php',
            type: 'POST',
            data: new FormData($('#form_detail_data_suggestion')[0]),
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

    // submit full data and send to approver
    $(document).on('submit', '#form_detail_data_suggestion', function(e) {
        // alert('Send to approver')
        if(e.keyCode == 13) {
            e.preventDefault();
            return false;
        }

        // set all variable in form
        let detail_suggestion_title = $('#detail_suggestion_title').val()
        let detail_problem_identification = $('#detail_problem_identification').val()
        let detail_problem_background = $('#detail_problem_background').val()
        let detail_target_specify = $('#detail_target_specify').val()
        let detail_possible_direct_cause_Man = $('input[name="detail_possible_direct_cause_Man[]"]').map(function(){
            return $(this).val()
        }).get()
        let detail_possible_direct_cause_Machine = $('input[name="detail_possible_direct_cause_Machine[]"]').map(function(){
            return $(this).val()
        }).get()
        let detail_possible_direct_cause_Method = $('input[name="detail_possible_direct_cause_Method[]"]').map(function(){
            return $(this).val()
        }).get()
        let detail_possible_direct_cause_Material = $('input[name="detail_possible_direct_cause_Material[]"]').map(function(){
            return $(this).val()
        }).get()
        let detail_possible_direct_cause_Mother_Nature = $('input[name="detail_possible_direct_cause_Mother_Nature[]"]').map(function(){
            return $(this).val()
        }).get()
        let detail_possible_direct_cause_Measurement = $('input[name="detail_possible_direct_cause_Measurement[]"]').map(function(){
            return $(this).val()
        }).get()
        let detail_planing_root_cause = $('input[name="detail_planing_root_cause[]"]').map(function(){
            return $(this).val()
        }).get()

        if (detail_suggestion_title == '') {
            mymodalss.style.display = "none";
            modals.style.display = "block";
            document.getElementById("msg").innerHTML = "Title cannot empty";
            return false;
        } 
        else if (detail_problem_identification == '') {
            mymodalss.style.display = "none";
            modals.style.display = "block";
            document.getElementById("msg").innerHTML = "Problem identification cannot empty";
            return false;
        } else if (detail_problem_background == '') {
            mymodalss.style.display = "none";
            modals.style.display = "block";
            document.getElementById("msg").innerHTML = "Problem background cannot empty";
            return false;
        } else if (detail_target_specify == '') {
            mymodalss.style.display = "none";
            modals.style.display = "block";
            document.getElementById("msg").innerHTML = "Target specify cannot empty";
            return false;
        } else if (detail_planing_root_cause == '') {
            mymodalss.style.display = "none";
            modals.style.display = "block";
            document.getElementById("msg").innerHTML = "Planning root cause cannot empty";
            return false;
        }

        $.ajax({
            url: 'php_action/SubmitAndSendToApprover.php',
            type: 'POST',
            data: new FormData($('#form_detail_data_suggestion')[0]),
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

    // add and update suggestion planing step
    $(document).on('click', '#add_suggestion_planing_step', function(e) {
        // alert('buat nambahin planing step')
        if(e.keyCode == 13) {
            e.preventDefault();
            return false;
        }
    })

    // submit suggestion planing step
    $(document).on('submit', '#form_suggestion_planing_step', function(e) {
        // alert('Send to approver')
        if(e.keyCode == 13) {
            e.preventDefault();
            return false;
        }
    })
})