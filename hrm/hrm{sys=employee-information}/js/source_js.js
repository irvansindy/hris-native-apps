$(document).ready( function(){
    $('#section_list_data').show()
    $('#section_create_data').hide()
    $('#section_detail_data').hide()
    $('#CancelButton').hide()

    $(document).on('click', '#CreateButton', function(e) {
        e.preventDefault()
        let data_emp_no = $(this).data('emp_no')
        // alert(data_emp_no)
        $.ajax({
            url: 'php_action/getUserDataById',
            type: 'GET',
            data: {
                data_emp_no: data_emp_no
            },
            // timeout: 120000,
            dataType: 'json',
            async: true,
            success: function(res){
                $('#FormDisplayCreate')[0].reset()
                
                $('#section_list_data').hide()
                $('#section_create_data').show()
                $('#CreateButton').hide()
                $('#CancelButton').show()

                $('#detail_emp_id').val(res[0].emp_id)
                $('#inp_full_name').val(res[0].Full_Name)
                $('#inp_nip').val(res[0].emp_no)
                $('#inp_birth_place').val(res[0].birthplace)
                $('#inp_birthdate').val(res[0].birthdate)
                $('#inp_nik').val(res[0].idnumber)
                $('#inp_kk').val(res[0].familyidnumber)
                $('#inp_start_date').val(res[0].start_date)
                $('#inp_gender').val(res[0].gender)
                $('#inp_religion').val(res[0].religion)
                $('#inp_maritalstatus').val(res[0].maritalstatus)
                $('#inp_nationality').val(res[0].nationality)
                $('#inp_phone_number').val(res[0].phone)
                $('#inp_email').val(res[0].email)
                $('#inp_email_personal').val(res[0].email_personal)
                $('#inp_address_ktp').val(res[0].address)

                let static_education = ['SD', 'SLTP/MTS/SMP', 'SMA/SMK/MA', 'D1/D2/D3 **', 'S1', 'S2', 'S3'];
                let value_static_education = ['SD', 'SMP', 'SMA', 'D3', 'S1', 'S2', 'S3'];
                $('#data_list_employee_education').empty()
                for (let index = 0; index < static_education.length; index++) {
                    $('#data_list_employee_education').append(
                        `
                            <tr>
                                <td>
                                    <input class="input--style-6 border-0 input_employee_education" id="input_employee_education" placeholder="Pendidikan" name="input_employee_education[]" type="Text" value="${static_education[index]}" readonly>
                                    <input class="input--style-6 border-0 input_employee_education_value" id="input_employee_education_value" placeholder="Pendidikan" name="input_employee_education_value[]" type="Text" value="${value_static_education[index]}" readonly>
                                </td>
                                <td>
                                    <input class="input--style-6 border-0 input_school_name" id="input_school_name" placeholder="Nama Sekolah" name="input_school_name[]" type="Text" value="">
                                </td>
                                <td>
                                    <input class="input--style-6 border-0 input_school_place" id="input_school_place" placeholder="Tempat / Kota" name="input_school_place[]" type="Text" value="">
                                </td>
                                <td>
                                    <input class="input--style-6 border-0 input_school_major" id="input_school_major" placeholder="Jurusan" name="input_school_major[]" type="Text" value="">
                                </td>
                                <td>
                                <input class="input--style-6 border-0 input_school_start_date" id="input_school_start_date" placeholder="Tahun Mulai" name="input_school_start_date[]" type="Text" value="" style="width:40% !important"> s/d
                                    <input class="input--style-6 border-0 input_school_end_date" id="input_school_end_date" placeholder="Tahun Selesai" name="input_school_end_date[]" type="Text" value="" style="width:40% !important">
                                    
                                </td>
                                <td>
                                    <input class="input--style-6 border-0 input_school_ipk" id="input_school_ipk" placeholder="Jurusan" name="input_school_ipk[]" type="Text" value="">
                                </td>
                            </tr>
                        `
                    )
                }

                $('#data_list_emergency_contact').empty()
                $('#data_list_emergency_contact').append(
                    `
                    <tr>
                        <td>
                            <input class="input--style-6 border-0 input_contact_name" id="input_contact_name" placeholder="Nama Kontak" name="input_contact_name[]" type="Text" value="">
                        </td>
                        <td>
                            <input class="input--style-6 border-0 input_contact_relation" id="input_contact_relation" placeholder="Hubungan" name="input_contact_relation[]" type="Text" value="">
                        </td>
                        <td>
                            <input class="input--style-6 border-0 input_contact_number" id="input_contact_number" placeholder="Nomor" name="input_contact_number[]" type="Text" value="">
                        </td>
                        <td>
                            <input class="input--style-6 border-0 input_contact_address" id="input_contact_address" placeholder="Alamat" name="input_contact_address[]" type="Text" value="">
                        </td>
                    </tr>
                    `
                )
                
                $('#data_list_family_dependent').empty()
                for (let i = 0; i < res[1].length; i++) {
                    $('#data_list_family_dependent').append(
                        `
                        <tr>
                            <td>
                                <input class="input--style-6 border-0 input_family_member" id="input_family_member" placeholder="" name="input_family_member[]" type="Text" value="${res[1][i].relationship_name_id}">
                                <input class="input--style-6 border-0 input_family_member_value" id="input_family_member_value" placeholder="" name="input_family_member_value[]" type="Text" value="${res[1][i].order}">
                            </td>
                            <td>
                                <input class="input--style-6 border-0 input_family_name" id="input_family_name" placeholder="Nama" name="input_family_name[]" type="Text" value="">
                            </td>
                            <td>
                                <input class="input--style-6 border-0 input_family_birth_date" id="input_family_birth_date" placeholder="Nomor" name="input_family_birth_date[]" type="date" value="">
                            </td>
                            <td>
                                <input class="input--style-6 border-0 input_family_status" id="input_family_status" placeholder="Status" name="input_family_status[]" type="Text" value="">
                            </td>
                        </tr>
                        `
                    )
                }
            }
        })
    })

    $(document).on('click', '#CancelButton', function(e) {
        $('#FormDisplayCreate')[0].reset()
        $('#section_list_data').show()
        $('#section_create_data').hide()
        $('#section_detail_data').hide()
        $('#CreateButton').show()
        $('#CancelButton').hide()
    })

    // add dynamic form education employee
    $(document).on('click', '#add_dynamic_form_employee_education', function(e) {
        e.preventDefault()
        $('#data_list_employee_education').append(
            `
                <tr class="array_form_employee_education">
                    <td>
                        <input class="input--style-6 border-0 input_employee_education" id="input_employee_education" placeholder="Pendidikan" name="input_employee_education[]" type="Text" value="">
                    </td>
                    <td>
                        <input class="input--style-6 border-0 input_school_name" id="input_school_name" placeholder="Nama Sekolah" name="input_school_name[]" type="Text" value="">
                    </td>
                    <td>
                        <input class="input--style-6 border-0 input_school_place" id="input_school_place" placeholder="Tempat / Kota" name="input_school_place[]" type="Text" value="">
                    </td>
                    <td>
                        <input class="input--style-6 border-0 input_school_major" id="input_school_major" placeholder="Jurusan" name="input_school_major[]" type="Text" value="">
                    </td>
                    <td>
                    <input class="input--style-6 border-0 input_school_start_date" id="input_school_start_date" placeholder="Tahun Mulai" name="input_school_start_date[]" type="Text" value="" style="width:40% !important"> s/d
                        <input class="input--style-6 border-0 input_school_end_date" id="input_school_end_date" placeholder="Tahun Selesai" name="input_school_end_date[]" type="Text" value="" style="width:40% !important">
                        
                    </td>
                    <td>
                        <input class="input--style-6 border-0 input_school_ipk" id="input_school_ipk" placeholder="Jurusan" name="input_school_ipk[]" type="Text" value="">
                    </td>
                    <td style="text-align: center;">
                        <button class="btn btn-danger btn-sm pop_dynamic_form_employee_education" id="pop_dynamic_form_employee_education" type="button">
                            <i class="fa-solid fa-minus"></i>
                        </button>
                    </td>
                </tr>
            `
        )
    })

    // pop dynamic form education employee
    $(document).on('click', '#pop_dynamic_form_employee_education', function(e) {
        e.preventDefault()
        $(this).closest('.array_form_employee_education').remove()
    })

    // add dynamic form emergency contact
    $(document).on('click', '#add_dynamic_form_contact_emergency', function(e) {
        e.preventDefault()
        $('#data_list_emergency_contact').append(`
            <tr class="array_form_emergency_contact">
                <td>
                    <input class="input--style-6 border-0 input_contact_name" id="input_contact_name" placeholder="Nama Kontak" name="input_contact_name[]" type="Text" value="">
                </td>
                <td>
                    <input class="input--style-6 border-0 input_contact_relation" id="input_contact_relation" placeholder="Hubungan" name="input_contact_relation[]" type="Text" value="">
                </td>
                <td>
                    <input class="input--style-6 border-0 input_contact_number" id="input_contact_number" placeholder="Nomor" name="input_contact_number[]" type="Text" value="">
                </td>
                <td>
                    <input class="input--style-6 border-0 input_contact_address" id="input_contact_address" placeholder="Alamat" name="input_contact_address[]" type="Text" value="">
                </td>
                <td style="text-align: center;">
                    <button class="btn btn-danger btn-sm pop_dynamic_form_emergency_contact" id="pop_dynamic_form_emergency_contact" type="button">
                        <i class="fa-solid fa-minus"></i>
                    </button>
                </td>
            </tr>
        `)
    })

    // pop dynamic form emergency contact
    $(document).on('click', '#pop_dynamic_form_emergency_contact', function(e) {
        e.preventDefault()
        $(this).closest('.array_form_emergency_contact').remove()
    })

    // add dynamic form family
    $(document).on('click', '#add_dynamic_form_family_dependent', function(e) {
        e.preventDefault()
        $('#data_list_family_dependent').append(
            `
            <tr class="array_form_family_dependent">
                <td>
                    <input class="input--style-6 border-0 input_family_member" id="input_family_member" placeholder="Nama Kontak" name="input_family_member[]" type="Text" value="">
                </td>
                <td>
                    <input class="input--style-6 border-0 input_family_name" id="input_family_name" placeholder="Hubungan" name="input_family_name[]" type="Text" value="">
                </td>
                <td>
                    <input class="input--style-6 border-0 input_family_birth_date" id="input_family_birth_date" placeholder="Nomor" name="input_family_birth_date[]" type="date" value="">
                </td>
                <td>
                    <input class="input--style-6 border-0 input_family_status" id="input_family_status" placeholder="Alamat" name="input_family_status[]" type="Text" value="">
                </td>
                <td style="text-align: center;">
                    <button class="btn btn-danger btn-sm pop_dynamic_form_family_dependent" id="pop_dynamic_form_family_dependent" type="button">
                        <i class="fa-solid fa-minus"></i>
                    </button>
                </td>
            </tr>
            `
        )
    })

    // pop dynamic form family
    $(document).on('click', '#pop_dynamic_form_family_dependent', function(e) {
        e.preventDefault()
        $(this).closest('.array_form_family_dependent').remove()
    })

    // save as draft
    $(document).on('click', '#save_draft', function(e) {
        e.preventDefault()
        $.ajax({
            url: 'php_action/CreateDataAsDraft.php',
			type: 'POST',
			data: new FormData($('#FormDisplayCreate')[0]),
			processData: false,
			contentType: false,
			dataType: 'json',
			async: true,
            success: function(res) {
                $(".form-group").removeClass('has-error').removeClass('has-success');
				mymodalss.style.display = "none";
				modals.style.display = "block";
				document.getElementById("msg").innerHTML = res.messages;

				$('#FormDisplayCreate')[0].reset()
                $('#section_create_data').hide()
                $('#section_detail_data').hide()
                $('#CreateButton').show()
                $('#CancelButton').hide()
				$('#CreateForm').modal('toggle');
				// location.reload();
				datatable.ajax.reload(null, false);
            },
            error: function (xhr, status, error) {
				var errorMessage = JSON.parse(xhr.responseText);
				mymodalss.style.display = "none";
				modals.style.display = "block";
				document.getElementById("msg").innerHTML = errorMessage.messages;
			}
        })
    })

    // save submit
    $(document).on('click', '#save_submit', function(e) {
        e.preventDefault()

        // set variable check data
        let inp_full_name = $('#inp_full_name').val()
        let inp_birth_place = $('#inp_birth_place').val()
        let inp_birthdate = $('#inp_birthdate').val()
        let inp_nik = $('#inp_nik').val()
        let inp_kk = $('#inp_kk').val()
        let inp_start_date = $('#inp_start_date').val()
        let inp_gender = $('#inp_gender').val()
        let inp_blood_type = $('#inp_blood_type').val()
        let inp_religion = $('#inp_religion').val()
        let inp_marital_status = $('#inp_marital_status').val()
        let inp_nationality = $('#inp_nationality').val()
        let inp_phone_number = $('#inp_phone_number').val()
        let inp_email = $('#inp_email').val()
        let inp_email_personal = $('#inp_email_personal').val()
        let inp_address_ktp = $('#inp_address_ktp').val()
        let inp_npwp = $('#inp_npwp').val()
        let inp_bpjs_ks = $('#inp_bpjs_ks').val()
        let inp_bpjs_tk = $('#inp_bpjs_tk').val()
        let inp_insurance = $('#inp_insurance').val()
        let inp_bank_name = $('#inp_bank_name').val()
        let inp_bank_number = $('#inp_bank_number').val()
        let inp_bank_user_account = $('#inp_bank_user_account').val()
        let inp_bank_branch_office = $('#inp_bank_branch_office').val()

        let input_employee_education = $('input[name="input_employee_education[]"]').map(function(){
            return $(this).val()
        }).get()
        let input_school_name = $('input[name="input_school_name[]"]').map(function(){
            return $(this).val()
        }).get()
        let input_school_place = $('input[name="input_school_place[]"]').map(function(){
            return $(this).val()
        }).get()
        let input_school_major = $('input[name="input_school_major[]"]').map(function(){
            return $(this).val()
        }).get()
        let input_school_start_date = $('input[name="input_school_start_date[]"]').map(function(){
            return $(this).val()
        }).get()
        let input_school_end_date = $('input[name="input_school_end_date[]"]').map(function(){
            return $(this).val()
        }).get()
        let input_school_ipk = $('input[name="input_school_ipk[]"]').map(function(){
            return $(this).val()
        }).get()

        let input_contact_name = $('input[name="input_contact_name[]"]').map(function(){
            return $(this).val()
        }).get()
        let input_contact_relation = $('input[name="input_contact_relation[]"]').map(function(){
            return $(this).val()
        }).get()
        let input_contact_number = $('input[name="input_contact_number[]"]').map(function(){
            return $(this).val()
        }).get()
        let input_contact_address = $('input[name="input_contact_address[]"]').map(function(){
            return $(this).val()
        }).get()
        let input_family_member = $('input[name="input_family_member[]"]').map(function(){
            return $(this).val()
        }).get()
        let input_family_name = $('input[name="input_family_name[]"]').map(function(){
            return $(this).val()
        }).get()
        let input_family_birth_date = $('input[name="input_family_birth_date[]"]').map(function(){
            return $(this).val()
        }).get()
        let input_family_status = $('input[name="input_family_status[]"]').map(function(){
            return $(this).val()
        }).get()

        let input_employee_education_condition = input_employee_education[0] == '' && input_employee_education.length <= 1
        let input_school_name_condition = input_school_name[0] == '' && input_school_name.length <= 1
        let input_school_major_condition = input_school_major[0] == '' && input_school_major.length <= 1
        let input_school_place_condition = input_school_place[0] == '' && input_school_place.length <= 1
        let input_school_start_date_condition = input_school_start_date[0] == '' && input_school_start_date.length <= 1
        let input_school_end_date_condition = input_school_end_date[0] == '' && input_school_end_date.length <= 1
        let input_school_ipk_condition = input_school_ipk[0] == '' && input_school_ipk.length <= 1
        
        let input_contact_name_condition = input_contact_name[0] == '' && input_contact_name.length <= 1
        let input_contact_relation_condition = input_contact_relation[0] == '' && input_contact_relation.length <= 1
        let input_contact_number_condition = input_contact_number[0] == '' && input_contact_number.length <= 1
        let input_contact_address_condition = input_contact_address[0] == '' && input_contact_address.length <= 1
        let input_family_member_condition = input_family_member[0] == '' && input_family_member.length <= 1
        let input_family_name_condition = input_family_name[0] == '' && input_family_name.length <= 1
        let input_family_birth_date_condition = input_family_birth_date[0] == '' && input_family_birth_date.length <= 1
        let input_family_status_condition = input_family_status[0] == '' && input_family_status.length <= 1

        if (inp_full_name == '') {
            mymodalss.style.display = "none";
            modals.style.display = "block";
            document.getElementById("msg").innerHTML = "Full name cannot empty";
            return false;
        }
        if (inp_birth_place == '') {
            mymodalss.style.display = "none";
            modals.style.display = "block";
            document.getElementById("msg").innerHTML = "Birth place cannot empty";
            return false;
        }
        if (inp_birthdate == '') {
            mymodalss.style.display = "none";
            modals.style.display = "block";
            document.getElementById("msg").innerHTML = "Birth date cannot empty";
            return false;
        }
        if (inp_nik == '') {
            mymodalss.style.display = "none";
            modals.style.display = "block";
            document.getElementById("msg").innerHTML = "NIK cannot empty";
            return false;
        }
        if (inp_kk == '') {
            mymodalss.style.display = "none";
            modals.style.display = "block";
            document.getElementById("msg").innerHTML = "KK cannot empty";
            return false;
        }
        if (inp_start_date == '') {
            mymodalss.style.display = "none";
            modals.style.display = "block";
            document.getElementById("msg").innerHTML = "Start date cannot empty";
            return false;
        }
        if (inp_gender == '') {
            mymodalss.style.display = "none";
            modals.style.display = "block";
            document.getElementById("msg").innerHTML = "Gender cannot empty";
            return false;
        }
        if (inp_blood_type == '') {
            mymodalss.style.display = "none";
            modals.style.display = "block";
            document.getElementById("msg").innerHTML = "Blood type cannot empty";
            return false;
        }
        if (inp_religion == '') {
            mymodalss.style.display = "none";
            modals.style.display = "block";
            document.getElementById("msg").innerHTML = "Religion cannot empty";
            return false;
        }
        if (inp_marital_status == '') {
            mymodalss.style.display = "none";
            modals.style.display = "block";
            document.getElementById("msg").innerHTML = "Marital status cannot empty";
            return false;
        }
        if (inp_nationality == '') {
            mymodalss.style.display = "none";
            modals.style.display = "block";
            document.getElementById("msg").innerHTML = "Nasionality cannot empty";
            return false;
        }
        if (inp_phone_number == '') {
            mymodalss.style.display = "none";
            modals.style.display = "block";
            document.getElementById("msg").innerHTML = "Phone number cannot empty";
            return false;
        }
        if (inp_email == '') {
            mymodalss.style.display = "none";
            modals.style.display = "block";
            document.getElementById("msg").innerHTML = "Email cannot empty";
            return false;
        }
        if (inp_email_personal == '') {
            mymodalss.style.display = "none";
            modals.style.display = "block";
            document.getElementById("msg").innerHTML = "Email personal cannot empty";
            return false;
        }
        if (inp_address_ktp == '') {
            mymodalss.style.display = "none";
            modals.style.display = "block";
            document.getElementById("msg").innerHTML = "Address cannot empty";
            return false;
        }
        if (inp_npwp == '') {
            mymodalss.style.display = "none";
            modals.style.display = "block";
            document.getElementById("msg").innerHTML = "NPWP cannot empty";
            return false;
        }
        if (inp_bpjs_ks == '') {
            mymodalss.style.display = "none";
            modals.style.display = "block";
            document.getElementById("msg").innerHTML = "BPJS Kesehatan cannot empty";
            return false;
        }
        if (inp_bpjs_tk == '') {
            mymodalss.style.display = "none";
            modals.style.display = "block";
            document.getElementById("msg").innerHTML = "BPJS Ketenagakerjaan cannot empty";
            return false;
        }
        if (inp_insurance == '') {
            mymodalss.style.display = "none";
            modals.style.display = "block";
            document.getElementById("msg").innerHTML = "Insurance cannot empty";
            return false;
        }
        if (inp_bank_name == '') {
            mymodalss.style.display = "none";
            modals.style.display = "block";
            document.getElementById("msg").innerHTML = "Bank name cannot empty";
            return false;
        }
        if (inp_bank_number == '') {
            mymodalss.style.display = "none";
            modals.style.display = "block";
            document.getElementById("msg").innerHTML = "Bank number cannot empty";
            return false;
        }
        if (inp_bank_user_account == '') {
            mymodalss.style.display = "none";
            modals.style.display = "block";
            document.getElementById("msg").innerHTML = "Bank user account cannot empty";
            return false;
        }
        if (inp_bank_branch_office == '') {
            mymodalss.style.display = "none";
            modals.style.display = "block";
            document.getElementById("msg").innerHTML = "Bank branch office cannot empty";
            return false;
        }
        
        if (input_employee_education_condition) {
            mymodalss.style.display = "none";
            modals.style.display = "block";
            document.getElementById("msg").innerHTML = "Education cannot empty";
            return false;
        }
        if (input_school_name_condition) {
            mymodalss.style.display = "none";
            modals.style.display = "block";
            document.getElementById("msg").innerHTML = "School name cannot empty";
            return false;
        }
        if (input_school_place_condition) {
            mymodalss.style.display = "none";
            modals.style.display = "block";
            document.getElementById("msg").innerHTML = "School place cannot empty";
            return false;
        }
        if (input_school_major_condition) {
            mymodalss.style.display = "none";
            modals.style.display = "block";
            document.getElementById("msg").innerHTML = "School major cannot empty";
            return false;
        }
        if (input_school_start_date_condition) {
            mymodalss.style.display = "none";
            modals.style.display = "block";
            document.getElementById("msg").innerHTML = "School start date cannot empty";
            return false;
        }
        if (input_school_end_date_condition) {
            mymodalss.style.display = "none";
            modals.style.display = "block";
            document.getElementById("msg").innerHTML = "School end date cannot empty";
            return false;
        }
        if (input_school_ipk_condition) {
            mymodalss.style.display = "none";
            modals.style.display = "block";
            document.getElementById("msg").innerHTML = "IPK cannot empty";
            return false;
        }

        if (input_contact_name_condition) {
            mymodalss.style.display = "none";
            modals.style.display = "block";
            document.getElementById("msg").innerHTML = "Contact name cannot empty";
            return false;
        }
        if (input_contact_relation_condition) {
            mymodalss.style.display = "none";
            modals.style.display = "block";
            document.getElementById("msg").innerHTML = "Relation cannot empty";
            return false;
        }
        if (input_contact_number_condition) {
            mymodalss.style.display = "none";
            modals.style.display = "block";
            document.getElementById("msg").innerHTML = "Contact number cannot empty";
            return false;
        }
        if (input_contact_address_condition) {
            mymodalss.style.display = "none";
            modals.style.display = "block";
            document.getElementById("msg").innerHTML = "Contact address cannot empty";
            return false;
        }
        
        if (input_family_member_condition) {
            mymodalss.style.display = "none";
            modals.style.display = "block";
            document.getElementById("msg").innerHTML = "Family member cannot empty";
            return false;
        }
        if (input_family_name_condition) {
            mymodalss.style.display = "none";
            modals.style.display = "block";
            document.getElementById("msg").innerHTML = "Family name cannot empty";
            return false;
        }
        if (input_family_birth_date_condition) {
            mymodalss.style.display = "none";
            modals.style.display = "block";
            document.getElementById("msg").innerHTML = "Family birth date cannot empty";
            return false;
        }
        if (input_family_status_condition) {
            mymodalss.style.display = "none";
            modals.style.display = "block";
            document.getElementById("msg").innerHTML = "Family status cannot empty";
            return false;
        }

        $.ajax({
            url: 'php_action/CreateDataAsSubmit.php',
			type: 'POST',
			data: new FormData($('#FormDisplayCreate')[0]),
			processData: false,
			contentType: false,
			dataType: 'json',
			async: true,
            success: function(res) {
                $(".form-group").removeClass('has-error').removeClass('has-success');
				mymodalss.style.display = "none";
				modals.style.display = "block";
				document.getElementById("msg").innerHTML = res.messages;

				$('#FormDisplayCreate')[0].reset()
				$('#CreateForm').modal('toggle');
				// location.reload();
				datatable.ajax.reload(null, false);
            },
            error: function (xhr, status, error) {
				var errorMessage = JSON.parse(xhr.responseText);
				mymodalss.style.display = "none";
				modals.style.display = "block";
				document.getElementById("msg").innerHTML = errorMessage.messages;
			}
        })
    })

    // detail update employee data
    $(document).on('click', '.detail_request_id', function(e) {
        e.preventDefault()
        $('#section_list_data').hide()
        $('#section_detail_data').show()
        $('#CreateButton').hide()
        $('#CancelButton').show()
        let request_id = $(this).data('request_id')
        $.ajax({
            url: 'php_action/getDraftUpdateEmployeeById.php',
            type: 'GET',
            data: {
                request_update_id: request_id
            },
            // timeout: 120000,
            dataType: 'json',
            async: true,
            success: function(res) {
                $('#FormDisplayUpdateEmployee')[0].reset()
                $('#detail_request_update_id').val(res[0].request_update_id)
                $('#detail_emp_id').val(res[0].emp_id)
                $('#detail_full_name').val(res[0].full_name)
                $('#detail_nip').val(res[0].emp_no)
                $('#detail_birth_place').val(res[0].birth_place)
                $('#detail_birthdate').val(res[0].birth_date)
                $('#detail_nik').val(res[0].NIK)
                $('#detail_kk').val(res[0].family_card)
                $('#detail_start_date').val(res[0].work_entry_date)
                $('#detail_gender').val(res[0].gender)
                $('#detail_religion').val(res[0].religion)
                $('#detail_maritalstatus').val(res[0].maritalstatus)
                $('#detail_nationality').val(res[0].nationality)
                $('#detail_phone_number').val(res[0].contact)
                $('#detail_email').val(res[0].email)
                $('#detail_email_personal').val(res[0].email_personal)
                $('#detail_address_ktp').val(res[0].address_ktp)
                $('#detail_npwp').val(res[0].npwp)
                $('#detail_bpjs_ks').val(res[0].bpjs_ks)
                $('#detail_bpjs_tk').val(res[0].bpjs_tk)
                $('#detail_insurance').val(res[0].insurance_number)
                $('#detail_bank_name').val(res[0].bank_account_name)
                $('#detail_bank_number').val(res[0].bank_account_number)
                $('#detail_bank_user_account').val(res[0].bank_account_user)
                $('#detail_bank_branch_office').val(res[0].bank_account_office)
                let total_education = res[1].length
                let total_contact = res[2].length
                let total_family = res[3].length
                if (total_education == 0) {
                    $('#data_list_employee_education_detail').empty()
                    $('#data_list_employee_education_detail').append(
                        `
                            <tr>
                                <td>
                                    <input class="input--style-6 border-0 detail_employee_education" id="detail_employee_education" placeholder="Pendidikan" name="detail_employee_education[]" type="Text" value="">
                                </td>
                                <td>
                                    <input class="input--style-6 border-0 detail_school_name" id="detail_school_name" placeholder="Nama Sekolah" name="detail_school_name[]" type="Text" value="">
                                </td>
                                <td>
                                    <input class="input--style-6 border-0 detail_school_place" id="detail_school_place" placeholder="Tempat / Kota" name="detail_school_place[]" type="Text" value="">
                                </td>
                                <td>
                                    <input class="input--style-6 border-0 detail_school_major" id="detail_school_major" placeholder="Jurusan" name="detail_school_major[]" type="Text" value="">
                                </td>
                                <td>
                                <input class="input--style-6 border-0 detail_school_start_date" id="detail_school_start_date" placeholder="Tahun Mulai" name="detail_school_start_date[]" type="Text" value="" style="width:40% !important"> s/d
                                    <input class="input--style-6 border-0 detail_school_end_date" id="detail_school_end_date" placeholder="Tahun Selesai" name="detail_school_end_date[]" type="Text" value="" style="width:40% !important">
                                    
                                </td>
                                <td>
                                    <input class="input--style-6 border-0 detail_school_ipk" id="detail_school_ipk" placeholder="Jurusan" name="detail_school_ipk[]" type="Text" value="">
                                </td>
                                <td style="text-align: center;">
                                    <button class="btn btn-primary btn-sm add_dynamic_form_employee_education" id="add_dynamic_form_employee_education" type="button">
                                        <i class="fa-solid fa-plus"></i>
                                    </button>
                                </td>
                            </tr>
                        `
                    )
                } else {
                    $('#data_list_employee_education_detail').empty()
                    for (let i = 0; i < res[1].length; i++) {
                        $('#data_list_employee_education_detail').append(
                            `
                                <tr>
                                    <td>
                                    <input class="input--style-6 border-0 detail_employee_education" id="detail_employee_education" placeholder="Pendidikan" name="detail_employee_education[]" type="Text" value="${res[1][i].name}">
                                    </td>
                                    <td>
                                        <input class="input--style-6 border-0 detail_school_name" id="detail_school_name" placeholder="Nama Sekolah" name="detail_school_name[]" type="Text" value="${res[1][i].school}">
                                    </td>
                                    <td>
                                        <input class="input--style-6 border-0 detail_school_place" id="detail_school_place" placeholder="Tempat / Kota" name="detail_school_place[]" type="Text" value="${res[1][i].location}">
                                    </td>
                                    <td>
                                        <input class="input--style-6 border-0 detail_school_major" id="detail_school_major" placeholder="Jurusan" name="detail_school_major[]" type="Text" value="${res[1][i].major}">
                                    </td>
                                    <td>
                                    <input class="input--style-6 border-0 detail_school_start_date" id="detail_school_start_date" placeholder="Tahun Mulai" name="detail_school_start_date[]" type="Text" value="${res[1][i].year_start}" style="width:40% !important"> s/d
                                        <input class="input--style-6 border-0 detail_school_end_date" id="detail_school_end_date" placeholder="Tahun Selesai" name="detail_school_end_date[]" type="Text" value="${res[1][i].year_end}" style="width:40% !important">
                                        
                                    </td>
                                    <td>
                                        <input class="input--style-6 border-0 detail_school_ipk" id="detail_school_ipk" placeholder="Jurusan" name="detail_school_ipk[]" type="Text" value="${res[1][i].grade_point}">
                                    </td>
                                    <td style="text-align: center;">
                                        <button class="btn btn-primary btn-sm add_dynamic_form_employee_education" id="add_dynamic_form_employee_education" type="button">
                                            <i class="fa-solid fa-plus"></i>
                                        </button>
                                    </td>
                                </tr>
                            `
                        )

                    }
                }

                if (total_contact == 0) {
                    $('#data_list_emergency_contact_detail').empty()
                    $('#data_list_emergency_contact_detail').append(
                        `
                        <tr>
                            <td>
                                <input class="input--style-6 border-0 detail_contact_name" id="detail_contact_name" placeholder="Nama Kontak" name="detail_contact_name[]" type="Text" value="">
                            </td>
                            <td>
                                <input class="input--style-6 border-0 detail_contact_relation" id="detail_contact_relation" placeholder="Hubungan" name="detail_contact_relation[]" type="Text" value="">
                            </td>
                            <td>
                                <input class="input--style-6 border-0 detail_contact_number" id="detail_contact_number" placeholder="Nomor" name="detail_contact_number[]" type="Text" value="">
                            </td>
                            <td>
                                <input class="input--style-6 border-0 detail_contact_address" id="detail_contact_address" placeholder="Alamat" name="detail_contact_address[]" type="Text" value="">
                            </td>
                            <td style="text-align: center;">
                                <button class="btn btn-primary btn-sm add_dynamic_form_contact_emergency" id="add_dynamic_form_contact_emergency" type="button">
                                    <i class="fa-solid fa-plus"></i>
                                </button>
                            </td>
                        </tr>
                        `
                    )
                } else {
                    $('#data_list_emergency_contact_detail').empty()
                    for (let j = 0; j < res[2].length; j++) {
                        $('#data_list_emergency_contact_detail').append(
                            `
                            <tr>
                                <td>
                                    <input class="input--style-6 border-0 detail_contact_name" id="detail_contact_name" placeholder="Nama Kontak" name="detail_contact_name[]" type="Text" value="${res[2][j].name}">
                                </td>
                                <td>
                                    <input class="input--style-6 border-0 detail_contact_relation" id="detail_contact_relation" placeholder="Hubungan" name="detail_contact_relation[]" type="Text" value="${res[2][j].relation}">
                                </td>
                                <td>
                                    <input class="input--style-6 border-0 detail_contact_number" id="detail_contact_number" placeholder="Nomor" name="detail_contact_number[]" type="Text" value="${res[2][j].number}">
                                </td>
                                <td>
                                    <input class="input--style-6 border-0 detail_contact_address" id="detail_contact_address" placeholder="Alamat" name="detail_contact_address[]" type="Text" value="${res[2][j].address}">
                                </td>
                                <td style="text-align: center;">
                                    <button class="btn btn-primary btn-sm add_dynamic_form_contact_emergency" id="add_dynamic_form_contact_emergency" type="button">
                                        <i class="fa-solid fa-plus"></i>
                                    </button>
                                </td>
                            </tr>
                            `
                        )
                        
                    }
                }

                if (total_family == 0) {
                    $('#data_list_family_dependent_detail').empty()
                    $('#data_list_family_dependent_detail').append(
                        `
                        <tr>
                            <td>
                                <input class="input--style-6 border-0 detail_family_member" id="detail_family_member" placeholder="Nama Kontak" name="detail_family_member[]" type="Text" value="">
                            </td>
                            <td>
                                <input class="input--style-6 border-0 detail_family_name" id="detail_family_name" placeholder="Hubungan" name="detail_family_name[]" type="Text" value="">
                            </td>
                            <td>
                                <input class="input--style-6 border-0 detail_family_birth_date" id="detail_family_birth_date" placeholder="Nomor" name="detail_family_birth_date[]" type="date" value="">
                            </td>
                            <td>
                                <input class="input--style-6 border-0 detail_family_status" id="detail_family_status" placeholder="Alamat" name="detail_family_status[]" type="Text" value="">
                            </td>
                            <td style="text-align: center;">
                                <button class="btn btn-primary btn-sm add_dynamic_form_family_dependent" id="add_dynamic_form_family_dependent" type="button">
                                    <i class="fa-solid fa-plus"></i>
                                </button>
                            </td>
                        </tr>
                        `
                    )
                } else {
                    $('#data_list_family_dependent_detail').empty()
                    for (let k = 0; k < res[3].length; k++) {
                        $('#data_list_family_dependent_detail').append(
                            `
                            <tr>
                                <td>
                                    <input class="input--style-6 border-0 detail_family_member" id="detail_family_member" placeholder="Nama Kontak" name="detail_family_member[]" type="Text" value="${res[3][k].member_type}">
                                </td>
                                <td>
                                    <input class="input--style-6 border-0 detail_family_name" id="detail_family_name" placeholder="Hubungan" name="detail_family_name[]" type="Text" value="${res[3][k].name}">
                                </td>
                                <td>
                                    <input class="input--style-6 border-0 detail_family_birth_date" id="detail_family_birth_date" placeholder="Nomor" name="detail_family_birth_date[]" type="date" value="${res[3][k].birth_date}">
                                </td>
                                <td>
                                    <input class="input--style-6 border-0 detail_family_status" id="detail_family_status" placeholder="Alamat" name="detail_family_status[]" type="Text" value="${res[3][k].status}">status
                                </td>
                                <td style="text-align: center;">
                                    <button class="btn btn-primary btn-sm add_dynamic_form_family_dependent" id="add_dynamic_form_family_dependent" type="button">
                                        <i class="fa-solid fa-plus"></i>
                                    </button>
                                </td>
                            </tr>
                            `
                        )
                        
                        
                    }
                }
            }
        })
        
    })

    // update draft
    $(document).on('click', '#update_draft', function(e) {
        e.preventDefault()
        $.ajax({
            url: 'php_action/UpdatingDraft.php',
			type: 'POST',
			data: new FormData($('#FormDisplayUpdateEmployee')[0]),
			processData: false,
			contentType: false,
			dataType: 'json',
			async: true,
            success: function(res) {
                $(".form-group").removeClass('has-error').removeClass('has-success');
				mymodalss.style.display = "none";
				modals.style.display = "block";
				document.getElementById("msg").innerHTML = res.messages;

				$('#FormDisplayUpdateEmployee')[0].reset()
                $('#section_list_data').show()
                $('#section_create_data').hide()
                $('#section_detail_data').hide()
                $('#CreateButton').show()
                $('#CancelButton').hide()
				$('#CreateForm').modal('toggle');
				// location.reload();
				datatable.ajax.reload(null, false);
            },
            error: function (xhr, status, error) {
				var errorMessage = JSON.parse(xhr.responseText);
				mymodalss.style.display = "none";
				modals.style.display = "block";
				document.getElementById("msg").innerHTML = errorMessage.messages;
			}
        })
    })

    // update submit
    (document).on('click', '#update_submit', function(e) {
        e.preventDefault()

        // set variable check data
        let detail_full_name = $('#detail_full_name').val()
        let detail_birth_place = $('#detail_birth_place').val()
        let detail_birthdate = $('#detail_birthdate').val()
        let detail_nik = $('#detail_nik').val()
        let detail_kk = $('#detail_kk').val()
        let detail_start_date = $('#detail_start_date').val()
        let detail_gender = $('#detail_gender').val()
        let detail_blood_type = $('#detail_blood_type').val()
        let detail_religion = $('#detail_religion').val()
        let detail_marital_status = $('#detail_marital_status').val()
        let detail_nationality = $('#detail_nationality').val()
        let detail_phone_number = $('#detail_phone_number').val()
        let detail_email = $('#detail_email').val()
        let detail_email_personal = $('#detail_email_personal').val()
        let detail_address_ktp = $('#detail_address_ktp').val()
        let detail_npwp = $('#detail_npwp').val()
        let detail_bpjs_ks = $('#detail_bpjs_ks').val()
        let detail_bpjs_tk = $('#detail_bpjs_tk').val()
        let detail_insurance = $('#detail_insurance').val()
        let detail_bank_name = $('#detail_bank_name').val()
        let detail_bank_number = $('#detail_bank_number').val()
        let detail_bank_user_account = $('#detail_bank_user_account').val()
        let detail_bank_branch_office = $('#detail_bank_branch_office').val()

        let input_employee_education = $('input[name="input_employee_education[]"]').map(function(){
            return $(this).val()
        }).get()
        let input_school_name = $('input[name="input_school_name[]"]').map(function(){
            return $(this).val()
        }).get()
        let input_school_place = $('input[name="input_school_place[]"]').map(function(){
            return $(this).val()
        }).get()
        let input_school_major = $('input[name="input_school_major[]"]').map(function(){
            return $(this).val()
        }).get()
        let input_school_start_date = $('input[name="input_school_start_date[]"]').map(function(){
            return $(this).val()
        }).get()
        let input_school_end_date = $('input[name="input_school_end_date[]"]').map(function(){
            return $(this).val()
        }).get()
        let input_school_ipk = $('input[name="input_school_ipk[]"]').map(function(){
            return $(this).val()
        }).get()

        let input_contact_name = $('input[name="input_contact_name[]"]').map(function(){
            return $(this).val()
        }).get()
        let input_contact_relation = $('input[name="input_contact_relation[]"]').map(function(){
            return $(this).val()
        }).get()
        let input_contact_number = $('input[name="input_contact_number[]"]').map(function(){
            return $(this).val()
        }).get()
        let input_contact_address = $('input[name="input_contact_address[]"]').map(function(){
            return $(this).val()
        }).get()
        let input_family_member = $('input[name="input_family_member[]"]').map(function(){
            return $(this).val()
        }).get()
        let input_family_name = $('input[name="input_family_name[]"]').map(function(){
            return $(this).val()
        }).get()
        let input_family_birth_date = $('input[name="input_family_birth_date[]"]').map(function(){
            return $(this).val()
        }).get()
        let input_family_status = $('input[name="input_family_status[]"]').map(function(){
            return $(this).val()
        }).get()

        let detail_employee_education_condition = detail_employee_education[0] == '' && detail_employee_education.length <= 1
        let detail_school_name_condition = detail_school_name[0] == '' && detail_school_name.length <= 1
        let detail_school_major_condition = detail_school_major[0] == '' && detail_school_major.length <= 1
        let detail_school_place_condition = detail_school_place[0] == '' && detail_school_place.length <= 1
        let detail_school_start_date_condition = detail_school_start_date[0] == '' && detail_school_start_date.length <= 1
        let detail_school_end_date_condition = detail_school_end_date[0] == '' && detail_school_end_date.length <= 1
        let detail_school_ipk_condition = detail_school_ipk[0] == '' && detail_school_ipk.length <= 1
        
        let detail_contact_name_condition = detail_contact_name[0] == '' && detail_contact_name.length <= 1
        let detail_contact_relation_condition = detail_contact_relation[0] == '' && detail_contact_relation.length <= 1
        let detail_contact_number_condition = detail_contact_number[0] == '' && detail_contact_number.length <= 1
        let detail_contact_address_condition = detail_contact_address[0] == '' && detail_contact_address.length <= 1
        let detail_family_member_condition = detail_family_member[0] == '' && detail_family_member.length <= 1
        let detail_family_name_condition = detail_family_name[0] == '' && detail_family_name.length <= 1
        let detail_family_birth_date_condition = detail_family_birth_date[0] == '' && detail_family_birth_date.length <= 1
        let detail_family_status_condition = detail_family_status[0] == '' && detail_family_status.length <= 1

        if (detail_full_name == '') {
            mymodalss.style.display = "none";
            modals.style.display = "block";
            document.getElementById("msg").innerHTML = "Full name cannot empty";
            return false;
        }
        if (detail_birth_place == '') {
            mymodalss.style.display = "none";
            modals.style.display = "block";
            document.getElementById("msg").innerHTML = "Birth place cannot empty";
            return false;
        }
        if (detail_birthdate == '') {
            mymodalss.style.display = "none";
            modals.style.display = "block";
            document.getElementById("msg").innerHTML = "Birth date cannot empty";
            return false;
        }
        if (detail_nik == '') {
            mymodalss.style.display = "none";
            modals.style.display = "block";
            document.getElementById("msg").innerHTML = "NIK cannot empty";
            return false;
        }
        if (detail_kk == '') {
            mymodalss.style.display = "none";
            modals.style.display = "block";
            document.getElementById("msg").innerHTML = "KK cannot empty";
            return false;
        }
        if (detail_start_date == '') {
            mymodalss.style.display = "none";
            modals.style.display = "block";
            document.getElementById("msg").innerHTML = "Start date cannot empty";
            return false;
        }
        if (detail_gender == '') {
            mymodalss.style.display = "none";
            modals.style.display = "block";
            document.getElementById("msg").innerHTML = "Gender cannot empty";
            return false;
        }
        if (detail_blood_type == '') {
            mymodalss.style.display = "none";
            modals.style.display = "block";
            document.getElementById("msg").innerHTML = "Blood type cannot empty";
            return false;
        }
        if (detail_religion == '') {
            mymodalss.style.display = "none";
            modals.style.display = "block";
            document.getElementById("msg").innerHTML = "Religion cannot empty";
            return false;
        }
        if (detail_marital_status == '') {
            mymodalss.style.display = "none";
            modals.style.display = "block";
            document.getElementById("msg").innerHTML = "Marital status cannot empty";
            return false;
        }
        if (detail_nationality == '') {
            mymodalss.style.display = "none";
            modals.style.display = "block";
            document.getElementById("msg").innerHTML = "Nasionality cannot empty";
            return false;
        }
        if (detail_phone_number == '') {
            mymodalss.style.display = "none";
            modals.style.display = "block";
            document.getElementById("msg").innerHTML = "Phone number cannot empty";
            return false;
        }
        if (detail_email == '') {
            mymodalss.style.display = "none";
            modals.style.display = "block";
            document.getElementById("msg").innerHTML = "Email cannot empty";
            return false;
        }
        if (detail_email_personal == '') {
            mymodalss.style.display = "none";
            modals.style.display = "block";
            document.getElementById("msg").innerHTML = "Email personal cannot empty";
            return false;
        }
        if (detail_address_ktp == '') {
            mymodalss.style.display = "none";
            modals.style.display = "block";
            document.getElementById("msg").innerHTML = "Address cannot empty";
            return false;
        }
        if (detail_npwp == '') {
            mymodalss.style.display = "none";
            modals.style.display = "block";
            document.getElementById("msg").innerHTML = "NPWP cannot empty";
            return false;
        }
        if (detail_bpjs_ks == '') {
            mymodalss.style.display = "none";
            modals.style.display = "block";
            document.getElementById("msg").innerHTML = "BPJS Kesehatan cannot empty";
            return false;
        }
        if (detail_bpjs_tk == '') {
            mymodalss.style.display = "none";
            modals.style.display = "block";
            document.getElementById("msg").innerHTML = "BPJS Ketenagakerjaan cannot empty";
            return false;
        }
        if (detail_insurance == '') {
            mymodalss.style.display = "none";
            modals.style.display = "block";
            document.getElementById("msg").innerHTML = "Insurance cannot empty";
            return false;
        }
        if (detail_bank_name == '') {
            mymodalss.style.display = "none";
            modals.style.display = "block";
            document.getElementById("msg").innerHTML = "Bank name cannot empty";
            return false;
        }
        if (detail_bank_number == '') {
            mymodalss.style.display = "none";
            modals.style.display = "block";
            document.getElementById("msg").innerHTML = "Bank number cannot empty";
            return false;
        }
        if (detail_bank_user_account == '') {
            mymodalss.style.display = "none";
            modals.style.display = "block";
            document.getElementById("msg").innerHTML = "Bank user account cannot empty";
            return false;
        }
        if (detail_bank_branch_office == '') {
            mymodalss.style.display = "none";
            modals.style.display = "block";
            document.getElementById("msg").innerHTML = "Bank branch office cannot empty";
            return false;
        }
        
        if (detail_employee_education_condition) {
            mymodalss.style.display = "none";
            modals.style.display = "block";
            document.getElementById("msg").innerHTML = "Education cannot empty";
            return false;
        }
        if (detail_school_name_condition) {
            mymodalss.style.display = "none";
            modals.style.display = "block";
            document.getElementById("msg").innerHTML = "School name cannot empty";
            return false;
        }
        if (detail_school_place_condition) {
            mymodalss.style.display = "none";
            modals.style.display = "block";
            document.getElementById("msg").innerHTML = "School place cannot empty";
            return false;
        }
        if (detail_school_major_condition) {
            mymodalss.style.display = "none";
            modals.style.display = "block";
            document.getElementById("msg").innerHTML = "School major cannot empty";
            return false;
        }
        if (detail_school_start_date_condition) {
            mymodalss.style.display = "none";
            modals.style.display = "block";
            document.getElementById("msg").innerHTML = "School start date cannot empty";
            return false;
        }
        if (detail_school_end_date_condition) {
            mymodalss.style.display = "none";
            modals.style.display = "block";
            document.getElementById("msg").innerHTML = "School end date cannot empty";
            return false;
        }
        if (detail_school_ipk_condition) {
            mymodalss.style.display = "none";
            modals.style.display = "block";
            document.getElementById("msg").innerHTML = "IPK cannot empty";
            return false;
        }

        if (detail_contact_name_condition) {
            mymodalss.style.display = "none";
            modals.style.display = "block";
            document.getElementById("msg").innerHTML = "Contact name cannot empty";
            return false;
        }
        if (detail_contact_relation_condition) {
            mymodalss.style.display = "none";
            modals.style.display = "block";
            document.getElementById("msg").innerHTML = "Relation cannot empty";
            return false;
        }
        if (detail_contact_number_condition) {
            mymodalss.style.display = "none";
            modals.style.display = "block";
            document.getElementById("msg").innerHTML = "Contact number cannot empty";
            return false;
        }
        if (detail_contact_address_condition) {
            mymodalss.style.display = "none";
            modals.style.display = "block";
            document.getElementById("msg").innerHTML = "Contact address cannot empty";
            return false;
        }
        
        if (detail_family_member_condition) {
            mymodalss.style.display = "none";
            modals.style.display = "block";
            document.getElementById("msg").innerHTML = "Family member cannot empty";
            return false;
        }
        if (detail_family_name_condition) {
            mymodalss.style.display = "none";
            modals.style.display = "block";
            document.getElementById("msg").innerHTML = "Family name cannot empty";
            return false;
        }
        if (detail_family_birth_date_condition) {
            mymodalss.style.display = "none";
            modals.style.display = "block";
            document.getElementById("msg").innerHTML = "Family birth date cannot empty";
            return false;
        }
        if (detail_family_status_condition) {
            mymodalss.style.display = "none";
            modals.style.display = "block";
            document.getElementById("msg").innerHTML = "Family status cannot empty";
            return false;
        }

        $.ajax({
            url: 'php_action/UpdatingSubmit.php',
			type: 'POST',
			data: new FormData($('#FormDisplayUpdateEmployee')[0]),
			processData: false,
			contentType: false,
			dataType: 'json',
			async: true,
            success: function(res) {
                $(".form-group").removeClass('has-error').removeClass('has-success');
				mymodalss.style.display = "none";
				modals.style.display = "block";
				document.getElementById("msg").innerHTML = res.messages;

				$('#FormDisplayCreate')[0].reset()
				$('#CreateForm').modal('toggle');
				// location.reload();
				datatable.ajax.reload(null, false);
            },
            error: function (xhr, status, error) {
				var errorMessage = JSON.parse(xhr.responseText);
				mymodalss.style.display = "none";
				modals.style.display = "block";
				document.getElementById("msg").innerHTML = errorMessage.messages;
			}
        })
    })
})