$(document).ready(function() {
    var limit_fetch = 12
    var offset = 0
    function fetchAllData () {
        // $('.applicant').empty()
        $.ajax({
            url: "php_action/FetchAllData.php",
            type: 'GET',
            data: {
                limit_fetch: limit_fetch,
                offset: offset
            },
            dataType: 'json',
            async: true,
            success: function(response) {
                if (response != '') {
                    for (let index = 0; index < response.length; index++) {
                        // const element = array[index];
                        $('.applicant').append(`
                        <div class="col-lg-3 card_applicant">
                            <div class="card card-margin shadow">
                                <div class="card-header no-border>
                                    <h5 class="card-title text-dark">${response[index].id_vacancy}</h5>
                                    <h5 class="card-title ml-auto pull-right">
                                        <span class="badge badge-danger">${response[index].status_name}</span>
                                    </h5>
                                </div>
                                <div class="card-body pt-0 mt-2">
                                    <div class="widget-49">
                                        <div class="widget-49-title-wrapper mb-4">
                                            <div class="widget-49-date-primary rounded-circle">
                                                <img class="img-fluid rounded-circle" src="https://career.pralon.co.id/storage/${response[index].photo}" class="img-fluid img-thumbnail" alt="profile">
                                            </div>
                                            <div class="widget-49-meeting-info">
                                                <span class="widget-49-pro-title">${response[index].full_name}</span>
                                                <div class="list-inline download-resume" data-id_applicant_cv="${response[index].id_applicant}" data-vacancy_cv="${response[index].id_vacancy}" data-user_cv="${response[index].userid}" data-status_code_cv="${response[index].status}">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="11" height="11" fill="currentColor" class="bi bi-download" viewBox="0 0 16 16">
                                                        <path d="M.5 9.9a.5.5 0 0 1 .5.5v2.5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2.5a.5.5 0 0 1 1 0v2.5a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2v-2.5a.5.5 0 0 1 .5-.5z"/>
                                                        <path d="M7.646 11.854a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 10.293V1.5a.5.5 0 0 0-1 0v8.793L5.354 8.146a.5.5 0 1 0-.708.708l3 3z"/>
                                                    </svg>
                                                    <span class="widget-49-meeting-time ml-1 pt-2">Download Resume</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="row mb-2">
                                                <div class="col-sm-1">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-mortarboard" viewBox="0 0 16 16">
                                                        <path d="M8.211 2.047a.5.5 0 0 0-.422 0l-7.5 3.5a.5.5 0 0 0 .025.917l7.5 3a.5.5 0 0 0 .372 0L14 7.14V13a1 1 0 0 0-1 1v2h3v-2a1 1 0 0 0-1-1V6.739l.686-.275a.5.5 0 0 0 .025-.917l-7.5-3.5ZM8 8.46 1.758 5.965 8 3.052l6.242 2.913L8 8.46Z"/>
                                                        <path d="M4.176 9.032a.5.5 0 0 0-.656.327l-.5 1.7a.5.5 0 0 0 .294.605l4.5 1.8a.5.5 0 0 0 .372 0l4.5-1.8a.5.5 0 0 0 .294-.605l-.5-1.7a.5.5 0 0 0-.656-.327L8 10.466 4.176 9.032Zm-.068 1.873.22-.748 3.496 1.311a.5.5 0 0 0 .352 0l3.496-1.311.22.748L8 12.46l-3.892-1.556Z"/>
                                                    </svg>
                                                </div>
                                                <div class="col-sm">
                                                    <span>${response[index].degree +' '+ response[index].major + ' - ' + response[index].institutionName}</span>
                                                </div>
                                            </div>
                                            <div class="row mb-2">
                                                <div class="col-sm-1">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-house" viewBox="0 0 16 16">
                                                        <path d="M8.707 1.5a1 1 0 0 0-1.414 0L.646 8.146a.5.5 0 0 0 .708.708L2 8.207V13.5A1.5 1.5 0 0 0 3.5 15h9a1.5 1.5 0 0 0 1.5-1.5V8.207l.646.647a.5.5 0 0 0 .708-.708L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293L8.707 1.5ZM13 7.207V13.5a.5.5 0 0 1-.5.5h-9a.5.5 0 0 1-.5-.5V7.207l5-5 5 5Z"/>
                                                    </svg>
                                                </div>
                                                <div class="col-sm">
                                                    <span>${response[index].address + ', ' + response[index].city_name + ', ' + response[index].state_name}</span>
                                                </div>
                                            </div>
                                            <div class="row mb-2">
                                                <div class="col-sm-1">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-newspaper" viewBox="0 0 16 16">
                                                        <path d="M0 2.5A1.5 1.5 0 0 1 1.5 1h11A1.5 1.5 0 0 1 14 2.5v10.528c0 .3-.05.654-.238.972h.738a.5.5 0 0 0 .5-.5v-9a.5.5 0 0 1 1 0v9a1.5 1.5 0 0 1-1.5 1.5H1.497A1.497 1.497 0 0 1 0 13.5v-11zM12 14c.37 0 .654-.211.853-.441.092-.106.147-.279.147-.531V2.5a.5.5 0 0 0-.5-.5h-11a.5.5 0 0 0-.5.5v11c0 .278.223.5.497.5H12z"/>
                                                        <path d="M2 3h10v2H2V3zm0 3h4v3H2V6zm0 4h4v1H2v-1zm0 2h4v1H2v-1zm5-6h2v1H7V6zm3 0h2v1h-2V6zM7 8h2v1H7V8zm3 0h2v1h-2V8zm-3 2h2v1H7v-1zm3 0h2v1h-2v-1zm-3 2h2v1H7v-1zm3 0h2v1h-2v-1z"/>
                                                    </svg>
                                                </div>
                                                <div class="col-sm">
                                                    <span>${response[index].vacancy_name}</span>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- <ol class="widget-49-meeting-points px-4 mt-2">
                                            <li class="widget-49-meeting-item">
                                                <span>
                                                
                                                </span>
                                            </li>
                                            <li class="widget-49-meeting-item"><span>Data migration is in scope</span></li>
                                            <li class="widget-49-meeting-item"><span>Session timeout increase to 30 minutes</span></li>
                                        </ol> -->
                                        <div class="widget-49-meeting-action mt-4">
                                            <button type="button" class="btn btn-info pull-right" data-toggle="modal" data-target="#detail_data_applicant" data-backdrop="static" data-id_applicant="${response[index].id_applicant}" data-vacancy="${response[index].id_vacancy}" data-user="${response[index].userid}" data-statusvalue="${response[index].status_name}" data-status_code="${response[index].status}" id="detail_applicant">
                                                View All
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        `)
                    }
                    offset += limit_fetch
                } else {
                    $('#load-more').html('Tidak ada lagi data');
                    $('#load-more').removeClass('btn btn-primary');
                    $('#load-more').addClass('btn shine btn-sdk btn-primary-center-only');
                    $('#load-more').attr('disabled', true);
                }
                // let card_length = $('.card_applicant').length
                // console.log(card_length)
            }
        })
    }
    
    fetchAllData()

    $('.for-load-more').empty()
    $('.for-load-more').append(`<button class="btn btn-primary mx-auto rounded-pill" id="load-more">Tampilkan lebih banyak</button>`)

    $('#sort_ascending').on('click', function(e) {
        e.preventDefault()
        let search_offset = 0
        let limit_fetch = 100
        let ascending = $(this).data('ascending')
        $.ajax({
            url: "php_action/FetchAllData.php",
            type: 'GET',
            data: {
                ordering: ascending,
                limit_fetch: limit_fetch,
                offset:search_offset
            },
            dataType: 'json',
            async: true,
            success:function(response) {
                console.log(response)
                $('.applicant').empty()
                for (let index = 0; index < response.length; index++) {
                    $('.applicant').append(`
                        <div class="col-lg-3 card_applicant">
                            <div class="card card-margin shadow">
                                <div class="card-header no-border>
                                    <h5 class="card-title text-dark">${response[index].id_vacancy}</h5>
                                    <h5 class="card-title ml-auto pull-right">
                                        <span class="badge badge-danger">${response[index].status_name}</span>
                                    </h5>
                                </div>
                                <div class="card-body pt-0 mt-2">
                                    <div class="widget-49">
                                        <div class="widget-49-title-wrapper mb-4">
                                            <div class="widget-49-date-primary">
                                                <!-- <span class="widget-49-date-day">09</span>
                                                <span class="widget-49-date-month">apr</span> -->
                                                <img src="../../asset/emp_photos/13-0299.jpeg" class="img-fluid img-thumbnail" alt="profile">
                                            </div>
                                            <div class="widget-49-meeting-info">
                                                <span class="widget-49-pro-title">${response[index].full_name}</span>
                                                <div class="list-inline">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="11" height="11" fill="currentColor" class="bi bi-download" viewBox="0 0 16 16">
                                                        <path d="M.5 9.9a.5.5 0 0 1 .5.5v2.5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2.5a.5.5 0 0 1 1 0v2.5a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2v-2.5a.5.5 0 0 1 .5-.5z"/>
                                                        <path d="M7.646 11.854a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 10.293V1.5a.5.5 0 0 0-1 0v8.793L5.354 8.146a.5.5 0 1 0-.708.708l3 3z"/>
                                                    </svg>
                                                    <span class="widget-49-meeting-time ml-1 pt-2">Download Resume</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="row mb-2">
                                                <div class="col-sm-1">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-mortarboard" viewBox="0 0 16 16">
                                                        <path d="M8.211 2.047a.5.5 0 0 0-.422 0l-7.5 3.5a.5.5 0 0 0 .025.917l7.5 3a.5.5 0 0 0 .372 0L14 7.14V13a1 1 0 0 0-1 1v2h3v-2a1 1 0 0 0-1-1V6.739l.686-.275a.5.5 0 0 0 .025-.917l-7.5-3.5ZM8 8.46 1.758 5.965 8 3.052l6.242 2.913L8 8.46Z"/>
                                                        <path d="M4.176 9.032a.5.5 0 0 0-.656.327l-.5 1.7a.5.5 0 0 0 .294.605l4.5 1.8a.5.5 0 0 0 .372 0l4.5-1.8a.5.5 0 0 0 .294-.605l-.5-1.7a.5.5 0 0 0-.656-.327L8 10.466 4.176 9.032Zm-.068 1.873.22-.748 3.496 1.311a.5.5 0 0 0 .352 0l3.496-1.311.22.748L8 12.46l-3.892-1.556Z"/>
                                                    </svg>
                                                </div>
                                                <div class="col-sm">
                                                    <span>${response[index].degree +' '+ response[index].major + ' - ' + response[index].institutionName}</span>
                                                </div>
                                            </div>
                                            <div class="row mb-2">
                                                <div class="col-sm-1">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-house" viewBox="0 0 16 16">
                                                        <path d="M8.707 1.5a1 1 0 0 0-1.414 0L.646 8.146a.5.5 0 0 0 .708.708L2 8.207V13.5A1.5 1.5 0 0 0 3.5 15h9a1.5 1.5 0 0 0 1.5-1.5V8.207l.646.647a.5.5 0 0 0 .708-.708L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293L8.707 1.5ZM13 7.207V13.5a.5.5 0 0 1-.5.5h-9a.5.5 0 0 1-.5-.5V7.207l5-5 5 5Z"/>
                                                    </svg>
                                                </div>
                                                <div class="col-sm">
                                                    <span>${response[index].address + ', ' + response[index].city_name + ', ' + response[index].state_name}</span>
                                                </div>
                                            </div>
                                            <div class="row mb-2">
                                                <div class="col-sm-1">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-newspaper" viewBox="0 0 16 16">
                                                        <path d="M0 2.5A1.5 1.5 0 0 1 1.5 1h11A1.5 1.5 0 0 1 14 2.5v10.528c0 .3-.05.654-.238.972h.738a.5.5 0 0 0 .5-.5v-9a.5.5 0 0 1 1 0v9a1.5 1.5 0 0 1-1.5 1.5H1.497A1.497 1.497 0 0 1 0 13.5v-11zM12 14c.37 0 .654-.211.853-.441.092-.106.147-.279.147-.531V2.5a.5.5 0 0 0-.5-.5h-11a.5.5 0 0 0-.5.5v11c0 .278.223.5.497.5H12z"/>
                                                        <path d="M2 3h10v2H2V3zm0 3h4v3H2V6zm0 4h4v1H2v-1zm0 2h4v1H2v-1zm5-6h2v1H7V6zm3 0h2v1h-2V6zM7 8h2v1H7V8zm3 0h2v1h-2V8zm-3 2h2v1H7v-1zm3 0h2v1h-2v-1zm-3 2h2v1H7v-1zm3 0h2v1h-2v-1z"/>
                                                    </svg>
                                                </div>
                                                <div class="col-sm">
                                                    <span>${response[index].vacancy_name}</span>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- <ol class="widget-49-meeting-points px-4 mt-2">
                                            <li class="widget-49-meeting-item">
                                                <span>
                                                
                                                </span>
                                            </li>
                                            <li class="widget-49-meeting-item"><span>Data migration is in scope</span></li>
                                            <li class="widget-49-meeting-item"><span>Session timeout increase to 30 minutes</span></li>
                                        </ol> -->
                                        <div class="widget-49-meeting-action mt-4">
                                            <button type="button" class="btn btn-info pull-right" data-toggle="modal" data-target="#detail_data_applicant" data-backdrop="static" data-id_applicant="${response[index].id_applicant}" data-vacancy="${response[index].id_vacancy}" data-user="${response[index].userid}" data-statusvalue="${response[index].status_name}" data-status_code="${response[index].status}" id="detail_applicant">
                                                View All
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    `)
                    $('.for-load-more').hide()
                }
            }
        })
        
    })
    
    $('#sort_descending').on('click', function(e) {
        e.preventDefault()
        let search_offset = 0
        let limit_fetch = 100
        let descending = $(this).data('descending')
        $.ajax({
            url: "php_action/FetchAllData.php",
            type: 'GET',
            data: {
                ordering: descending,
                limit_fetch: limit_fetch,
                offset:search_offset
            },
            dataType: 'json',
            async: true,
            success:function(response) {
                console.log(response)
                $('.applicant').empty()
                for (let index = 0; index < response.length; index++) {
                    $('.applicant').append(`
                        <div class="col-lg-3 card_applicant">
                            <div class="card card-margin shadow">
                                <div class="card-header no-border>
                                    <h5 class="card-title text-dark">${response[index].id_vacancy}</h5>
                                    <h5 class="card-title ml-auto pull-right">
                                        <span class="badge badge-danger">${response[index].status_name}</span>
                                    </h5>
                                </div>
                                <div class="card-body pt-0 mt-2">
                                    <div class="widget-49">
                                        <div class="widget-49-title-wrapper mb-4">
                                            <div class="widget-49-date-primary">
                                                <!-- <span class="widget-49-date-day">09</span>
                                                <span class="widget-49-date-month">apr</span> -->
                                                <img src="../../asset/emp_photos/13-0299.jpeg" class="img-fluid img-thumbnail" alt="profile">
                                            </div>
                                            <div class="widget-49-meeting-info">
                                                <span class="widget-49-pro-title">${response[index].full_name}</span>
                                                <div class="list-inline">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="11" height="11" fill="currentColor" class="bi bi-download" viewBox="0 0 16 16">
                                                        <path d="M.5 9.9a.5.5 0 0 1 .5.5v2.5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2.5a.5.5 0 0 1 1 0v2.5a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2v-2.5a.5.5 0 0 1 .5-.5z"/>
                                                        <path d="M7.646 11.854a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 10.293V1.5a.5.5 0 0 0-1 0v8.793L5.354 8.146a.5.5 0 1 0-.708.708l3 3z"/>
                                                    </svg>
                                                    <span class="widget-49-meeting-time ml-1 pt-2">Download Resume</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="row mb-2">
                                                <div class="col-sm-1">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-mortarboard" viewBox="0 0 16 16">
                                                        <path d="M8.211 2.047a.5.5 0 0 0-.422 0l-7.5 3.5a.5.5 0 0 0 .025.917l7.5 3a.5.5 0 0 0 .372 0L14 7.14V13a1 1 0 0 0-1 1v2h3v-2a1 1 0 0 0-1-1V6.739l.686-.275a.5.5 0 0 0 .025-.917l-7.5-3.5ZM8 8.46 1.758 5.965 8 3.052l6.242 2.913L8 8.46Z"/>
                                                        <path d="M4.176 9.032a.5.5 0 0 0-.656.327l-.5 1.7a.5.5 0 0 0 .294.605l4.5 1.8a.5.5 0 0 0 .372 0l4.5-1.8a.5.5 0 0 0 .294-.605l-.5-1.7a.5.5 0 0 0-.656-.327L8 10.466 4.176 9.032Zm-.068 1.873.22-.748 3.496 1.311a.5.5 0 0 0 .352 0l3.496-1.311.22.748L8 12.46l-3.892-1.556Z"/>
                                                    </svg>
                                                </div>
                                                <div class="col-sm">
                                                    <span>${response[index].degree +' '+ response[index].major + ' - ' + response[index].institutionName}</span>
                                                </div>
                                            </div>
                                            <div class="row mb-2">
                                                <div class="col-sm-1">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-house" viewBox="0 0 16 16">
                                                        <path d="M8.707 1.5a1 1 0 0 0-1.414 0L.646 8.146a.5.5 0 0 0 .708.708L2 8.207V13.5A1.5 1.5 0 0 0 3.5 15h9a1.5 1.5 0 0 0 1.5-1.5V8.207l.646.647a.5.5 0 0 0 .708-.708L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293L8.707 1.5ZM13 7.207V13.5a.5.5 0 0 1-.5.5h-9a.5.5 0 0 1-.5-.5V7.207l5-5 5 5Z"/>
                                                    </svg>
                                                </div>
                                                <div class="col-sm">
                                                    <span>${response[index].address + ', ' + response[index].city_name + ', ' + response[index].state_name}</span>
                                                </div>
                                            </div>
                                            <div class="row mb-2">
                                                <div class="col-sm-1">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-newspaper" viewBox="0 0 16 16">
                                                        <path d="M0 2.5A1.5 1.5 0 0 1 1.5 1h11A1.5 1.5 0 0 1 14 2.5v10.528c0 .3-.05.654-.238.972h.738a.5.5 0 0 0 .5-.5v-9a.5.5 0 0 1 1 0v9a1.5 1.5 0 0 1-1.5 1.5H1.497A1.497 1.497 0 0 1 0 13.5v-11zM12 14c.37 0 .654-.211.853-.441.092-.106.147-.279.147-.531V2.5a.5.5 0 0 0-.5-.5h-11a.5.5 0 0 0-.5.5v11c0 .278.223.5.497.5H12z"/>
                                                        <path d="M2 3h10v2H2V3zm0 3h4v3H2V6zm0 4h4v1H2v-1zm0 2h4v1H2v-1zm5-6h2v1H7V6zm3 0h2v1h-2V6zM7 8h2v1H7V8zm3 0h2v1h-2V8zm-3 2h2v1H7v-1zm3 0h2v1h-2v-1zm-3 2h2v1H7v-1zm3 0h2v1h-2v-1z"/>
                                                    </svg>
                                                </div>
                                                <div class="col-sm">
                                                    <span>${response[index].vacancy_name}</span>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- <ol class="widget-49-meeting-points px-4 mt-2">
                                            <li class="widget-49-meeting-item">
                                                <span>
                                                
                                                </span>
                                            </li>
                                            <li class="widget-49-meeting-item"><span>Data migration is in scope</span></li>
                                            <li class="widget-49-meeting-item"><span>Session timeout increase to 30 minutes</span></li>
                                        </ol> -->
                                        <div class="widget-49-meeting-action mt-4">
                                            <button type="button" class="btn btn-info pull-right" data-toggle="modal" data-target="#detail_data_applicant" data-backdrop="static" data-id_applicant="${response[index].id_applicant}" data-vacancy="${response[index].id_vacancy}" data-user="${response[index].userid}" data-statusvalue="${response[index].status_name}" data-status_code="${response[index].status}" id="detail_applicant">
                                                View All
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    `)
                    $('.for-load-more').hide()
                }
            }
        })
    })

    $(document).on('click', '.download-resume', function(e) {
        e.preventDefault()
        let id_applicant = $(this).data('id_applicant_cv')
        let vacancy = $(this).data('vacancy_cv')
        let user = $(this).data('user_cv')
        var status_code = $(this).data('status_code_cv')
        $.ajax({
            url: 'php_action/GetDataCV.php',
            type: 'POST',
            data : {
                vacancy:vacancy,
                user:user,
                status_code:status_code,
                id_applicant: id_applicant
            },
            // timeout: 120000,
            // dataType: 'json',
            // async: true,
            success: function(res){
                window.open(
                    '',
                    '_blank',
                    'width=800,height=400,left=100,top=100,resizable=yes,scrollbars=yes,toolbar=no,menubar=no,location=no,directories=no, status=yes')
                .document.write(res);
            }
        })
    })

    $(document).on('click', '#load-more', function(e) {
        e.preventDefault()
        fetchAllData()
    })

    $(document).on('click', '#search_applicant', function() {
        // e.preventDefault()
        $('#search_city').empty()
        
        $('#search_education').empty()
        
        $('#search_status').empty()
        $.ajax({
            url: 'php_action/GetParameterFilterSearch.php',
            type: 'GET',
            dataType: 'json',
            async: true,
            success:function(res) {
                // alert('bisa bro')
                // get all data city
                $('#search_city').append(`
                    <option value="">Select One</option>
                `)
                for (let i = 0; i < res[0].length; i++) {
                    $('#search_city').append(`
                        <option value="${res[0][i].city_name}">${res[0][i].city_name}</option>
                    `)
                }

                // get all data education
                $('#search_education').append(`
                    <option value="">Select One</option>
                `)
                for (let j = 0; j < res[1].length; j++) {
                    $('#search_education').append(`
                        <option value="${res[1][j].edu_name}">${res[1][j].edu_name}</option>
                    `)
                }

                // get all data status
                $('#search_status').append(`
                    <option value="">Select One</option>
                `)
                for (let k = 0; k < res[2].length; k++) {
                    $('#search_status').append(`
                        <option value="${res[2][k].status_name}">${res[2][k].status_name}</option>
                    `)
                }
            }
        })
    })

    $('#submit_search').on('click', function(e) {
        e.preventDefault()
        let search_city = $('#search_city').val()
        let search_education = $('#search_education').val()
        let search_expected_salary = $('#search_expected_salary').val()
        let search_gender = $('#search_gender').val()
        let search_religion = $('#search_religion').val()
        let search_status = $('#search_status').val()
        let search_offset = 0

        $.ajax({
            url: "php_action/FetchAllData.php",
            type: 'GET',
            data: {
                limit_fetch: limit_fetch,
                offset: search_offset,
                search_city: search_city,
                search_education: search_education,
                search_expected_salary: search_expected_salary,
                search_gender: search_gender,
                search_religion: search_religion,
                search_status: search_status,
            },
            dataType: 'json',
            async: true,
            success: function(response) {
                // console.log(JSON.stringify(response))
                $('.applicant').empty()
                for (let index = 0; index < response.length; index++) {
                    $('.applicant').append(`
                        <div class="col-lg-3 card_applicant">
                            <div class="card card-margin shadow">
                                <div class="card-header no-border>
                                    <h5 class="card-title text-dark">${response[index].id_vacancy}</h5>
                                    <h5 class="card-title ml-auto pull-right">
                                        <span class="badge badge-danger">${response[index].status_name}</span>
                                    </h5>
                                </div>
                                <div class="card-body pt-0 mt-2">
                                    <div class="widget-49">
                                        <div class="widget-49-title-wrapper mb-4">
                                            <div class="widget-49-date-primary">
                                                <!-- <span class="widget-49-date-day">09</span>
                                                <span class="widget-49-date-month">apr</span> -->
                                                <img src="../../asset/emp_photos/13-0299.jpeg" class="img-fluid img-thumbnail" alt="profile">
                                            </div>
                                            <div class="widget-49-meeting-info">
                                                <span class="widget-49-pro-title">${response[index].full_name}</span>
                                                <div class="list-inline">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="11" height="11" fill="currentColor" class="bi bi-download" viewBox="0 0 16 16">
                                                        <path d="M.5 9.9a.5.5 0 0 1 .5.5v2.5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2.5a.5.5 0 0 1 1 0v2.5a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2v-2.5a.5.5 0 0 1 .5-.5z"/>
                                                        <path d="M7.646 11.854a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 10.293V1.5a.5.5 0 0 0-1 0v8.793L5.354 8.146a.5.5 0 1 0-.708.708l3 3z"/>
                                                    </svg>
                                                    <span class="widget-49-meeting-time ml-1 pt-2">Download Resume</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="row mb-2">
                                                <div class="col-sm-1">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-mortarboard" viewBox="0 0 16 16">
                                                        <path d="M8.211 2.047a.5.5 0 0 0-.422 0l-7.5 3.5a.5.5 0 0 0 .025.917l7.5 3a.5.5 0 0 0 .372 0L14 7.14V13a1 1 0 0 0-1 1v2h3v-2a1 1 0 0 0-1-1V6.739l.686-.275a.5.5 0 0 0 .025-.917l-7.5-3.5ZM8 8.46 1.758 5.965 8 3.052l6.242 2.913L8 8.46Z"/>
                                                        <path d="M4.176 9.032a.5.5 0 0 0-.656.327l-.5 1.7a.5.5 0 0 0 .294.605l4.5 1.8a.5.5 0 0 0 .372 0l4.5-1.8a.5.5 0 0 0 .294-.605l-.5-1.7a.5.5 0 0 0-.656-.327L8 10.466 4.176 9.032Zm-.068 1.873.22-.748 3.496 1.311a.5.5 0 0 0 .352 0l3.496-1.311.22.748L8 12.46l-3.892-1.556Z"/>
                                                    </svg>
                                                </div>
                                                <div class="col-sm">
                                                    <span>${response[index].degree +' '+ response[index].major + ' - ' + response[index].institutionName}</span>
                                                </div>
                                            </div>
                                            <div class="row mb-2">
                                                <div class="col-sm-1">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-house" viewBox="0 0 16 16">
                                                        <path d="M8.707 1.5a1 1 0 0 0-1.414 0L.646 8.146a.5.5 0 0 0 .708.708L2 8.207V13.5A1.5 1.5 0 0 0 3.5 15h9a1.5 1.5 0 0 0 1.5-1.5V8.207l.646.647a.5.5 0 0 0 .708-.708L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293L8.707 1.5ZM13 7.207V13.5a.5.5 0 0 1-.5.5h-9a.5.5 0 0 1-.5-.5V7.207l5-5 5 5Z"/>
                                                    </svg>
                                                </div>
                                                <div class="col-sm">
                                                    <span>${response[index].address + ', ' + response[index].city_name + ', ' + response[index].state_name}</span>
                                                </div>
                                            </div>
                                            <div class="row mb-2">
                                                <div class="col-sm-1">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-newspaper" viewBox="0 0 16 16">
                                                        <path d="M0 2.5A1.5 1.5 0 0 1 1.5 1h11A1.5 1.5 0 0 1 14 2.5v10.528c0 .3-.05.654-.238.972h.738a.5.5 0 0 0 .5-.5v-9a.5.5 0 0 1 1 0v9a1.5 1.5 0 0 1-1.5 1.5H1.497A1.497 1.497 0 0 1 0 13.5v-11zM12 14c.37 0 .654-.211.853-.441.092-.106.147-.279.147-.531V2.5a.5.5 0 0 0-.5-.5h-11a.5.5 0 0 0-.5.5v11c0 .278.223.5.497.5H12z"/>
                                                        <path d="M2 3h10v2H2V3zm0 3h4v3H2V6zm0 4h4v1H2v-1zm0 2h4v1H2v-1zm5-6h2v1H7V6zm3 0h2v1h-2V6zM7 8h2v1H7V8zm3 0h2v1h-2V8zm-3 2h2v1H7v-1zm3 0h2v1h-2v-1zm-3 2h2v1H7v-1zm3 0h2v1h-2v-1z"/>
                                                    </svg>
                                                </div>
                                                <div class="col-sm">
                                                    <span>${response[index].vacancy_name}</span>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- <ol class="widget-49-meeting-points px-4 mt-2">
                                            <li class="widget-49-meeting-item">
                                                <span>
                                                
                                                </span>
                                            </li>
                                            <li class="widget-49-meeting-item"><span>Data migration is in scope</span></li>
                                            <li class="widget-49-meeting-item"><span>Session timeout increase to 30 minutes</span></li>
                                        </ol> -->
                                        <div class="widget-49-meeting-action mt-4">
                                            <button type="button" class="btn btn-info pull-right" data-toggle="modal" data-target="#detail_data_applicant" data-backdrop="static" data-id_applicant="${response[index].id_applicant}" data-vacancy="${response[index].id_vacancy}" data-user="${response[index].userid}" data-statusvalue="${response[index].status_name}" data-status_code="${response[index].status}" id="detail_applicant">
                                                View All
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    `)
                    
                }
                // if (response.length != 0) {
                // } else {
                //     $('.applicant').empty()
                //     modals.style.display = "block";
                //     document.getElementById("msg").innerHTML = 'Data tidak ada';
                // }
                $('#load-more').hide()
            }
        })
    })

    $(document).on('click', '#detail_applicant', function(e) {
        e.preventDefault()
        if(e.keyCode == 13) {
            e.preventDefault();
            return false;
        }
        let id_applicant = $(this).data('id_applicant')
        let vacancy = $(this).data('vacancy')
        let user = $(this).data('user')
        var status_code = $(this).data('status_code')
        var statusvalue = $(this).data('statusvalue')
        // alert(status_code)
        $.ajax({
            url: 'php_action/GetDataById',
            type: 'GET',
            data : {
                vacancy:vacancy,
                user:user,
                status_code:status_code,
                id_applicant: id_applicant
            },
            timeout: 120000,
            dataType: 'json',
            async: true,
            success: function(response) {
                // data user
                document.getElementById('detail_vacancy_id').innerHTML = vacancy
                document.getElementById('detail_full_name').innerHTML = response[0][0].full_name
                document.getElementById('detail_gender').innerHTML = response[0][0].gender
                document.getElementById('detail_phone').innerHTML = response[0][0].phone
                document.getElementById('detail_email').innerHTML = response[0][0].email
                document.getElementById('detail_birthplace_birthdate').innerHTML = response[0][0].birthplace + ', ' + response[0][0].birthdate
                document.getElementById('detail_maritalstatus').innerHTML = response[0][0].maritalstatus
                document.getElementById('detail_religion').innerHTML = response[0][0].religion
                document.getElementById('detail_address').innerHTML = response[0][0].address + ', ' + response[0][0].city_name + ', ' + response[0][0].state_name

                if (status_code == 5 || status_code == 4) {
                    $('#btn_group_detail').empty()
                    $('#btn_group_detail').append(`
                        <button type="reset" class="btn btn-sdk btn-primary-center-only rounded-pill" data-dismiss="modal">Close</button> 
                    `)
                } else {
                    $('#btn_group_detail').empty()
                    $('#btn_group_detail').append(`
                        <button type="button" class="btn-sdk btn-primary-not-only-left" id="button-reject">Reject</button>
                        <button type="button" class="btn-sdk btn-primary-not-only-right" id="button-update">Update</button>
                    `)

                }

                // data experience
                $('#data_list_experience').empty()
                if (response[1].length != 0) {
                    for (let i = 0; i < response[1].length; i++) {
                        $('#data_list_experience').append(`
                            <div class="col-6 mb-4">
                                <div>
                                    <p>
                                        <strong style="font-weight: bold;">${response[1][i].company_name}</strong> | <span style="font-weight: light;"> ${response[1][i].start_date} `+ ' - ' + `${response[1][i].end_date}</span>
                                    </p>
                                </div>
                                <div>
                                    <p>
                                        ${response[1][i].company_address}
                                    </p>
                                </div>
                                <div>
                                    <p>
                                        Start Position : ${response[1][i].start_position}
                                    </p>
                                </div>
                                <div>
                                    <p>
                                        End Position : ${response[1][i].end_position}
                                    </p>
                                </div>
                                <div>
                                    <p>
                                    First - End of Salary : Rp.${response[1][i].salary_entry.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,") + ' - Rp.' + response[1][i].salary_last.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,")}
                                    </p>
                                </div>
                                <div>
                                    <p>
                                        Reason for leaving: ${response[1][i].reason_for_leaving}
                                    </p>
                                </div>
                                <div>
                                    <p>
                                        Job Desc: ${response[1][i].job_desc}
                                    </p>
                                </div>
                                <div>
                                    <p>
                                        Project: 
                                    </p>
                                    ${response[1][i].project}
                                </div>
                            </div>
                        `)
                    }
                } else {
                    $('#data_list_experience').empty()
                }

                // data education
                $('#data_list_education').empty()
                if (response[2].length != 0) {
                    for (let j = 0; j < response[2].length; j++) {
                        $('#data_list_education').append(`
                            <div class="col-6 mb-4">
                                <div>
                                    <p>
                                        <strong style="font-weight: bold;">${response[2][j].institution_name}</strong>
                                    </p>
                                </div>
                                <div>
                                    <p>
                                        ${response[2][j].degree + ' - ' + response[2][j].major} | ${response[2][j].start_year + ' - ' + response[2][j].end_year}
                                    </p>
                                </div>
                                <div>
                                    <p>
                                        Achievement :
                                    </p>
                                    <p>
                                        ${response[2][j].achievement}
                                    </p>
                                </div>
                            </div>
                        `)
                    }
                }

                // data skill
                $('.data_list_skill').empty()
                if (response[3].length != 0) {
                    for (let k = 0; k < response[3].length; k++) {
                        let skill_id = response[3][k].id + response[3][k].skill_name

                        let skill_value = response[3][k].skill_value * 10
                        let skill_actual = response[3][k].skill_value+'/'+10
                        let skill_name = "<h5>"+response[3][k].skill_name+"</h5>"
                        
                        $('.data_list_skill').append(`
                            <div class="col-sm-3">
                                <div id="${skill_id}"></div>
                            </div>
                        `)

                        new PercentChart(skill_id,{
                            easing: 'ease-in',
                            textDuration: '.1s',
                            chartDuration: '2s',
                            enableHover:true,
                            direction:"cw",
                            data:{
                                percent: skill_value,
                                actual: skill_actual,
                                unit: skill_name
                            }
                        })
                    }
                }

                // data list training achievement
                $('#data_list_training_achievement').empty()
                if (response[4].length != 0) {
                    for (let l = 0; l < response[4].length; l++) {
                        $('#data_list_training_achievement').append(`
                            <div class="col-6 mb-4">
                                <div>
                                    <p>
                                        <strong style="font-weight: bold;">${response[4][l].training_name} by ${response[4][l].training_organizer}</strong>
                                    </p>
                                </div>
                                <div>
                                    <p>
                                        ${response[4][l].training_category} | ${response[4][l].training_start} - ${response[4][l].training_end}
                                    </p>
                                </div>
                                <div>
                                    <p>
                                        Detail :
                                    </p>
                                    <p>
                                        ${response[4][l].training_detail}
                                    </p>
                                </div>
                            </div>
                        `)
                    }
                }
                
                // data list family
                $('#data_list_family').empty()
                if (response[5].length != 0) {
                    var no = 1;
                    for (let m = 0; m < response[5].length; m++) {
                        
                        $('#data_list_family').append(`
                            <tr>
                                <td>${no++}</td>
                                <td>${response[5][m].name}</td>
                                <td>${response[5][m].relation}</td>
                                <td>${response[5][m].age}</td>
                                <td>${response[5][m].occupation}</td>
                                <td>${response[5][m].status}</td>
                            </tr>
                        `)
                        
                    }
                    // <div class="col-6 mb-4"></div>
                }
                
                // progress stepper 
                $('#data_list_applicant_status').empty()
                let no_status = 1
                $('#value_application_status').val(status_code)
                $('#value_application_id').val(id_applicant)
                $('#application_status').empty()
                $('#application_status').append(`
                    <option value="${status_code}">${statusvalue}</option>
                `)
                if (response[6][5].active == null) {
                    // alert(response[6][5].active)
                    let status_progress = response[6].length - 1
                    // alert(status_progress)
                    for (let n = 0; n < status_progress; n++) {
                        $('#data_list_applicant_status').append(`
                            <div class="md-step ${response[6][n].active}">
                                <div class="md-step-circle"><span>${no_status++}</span></div>
                                <div class="md-step-title">${response[6][n].status_name}</div>
                                <div class="md-step-bar-left"></div>
                                <div class="md-step-bar-right"></div>
                            </div>
                        `)
                    }
                    
                    // let total_status
                    if (status_code == 4) {
                        $('.status_view').hide()
                    } else {
                        $('.status_view').show()
                        for (let o = 0; o < response[7].length; o++) {
                            $('#application_status').append(`
                                <option value="${response[7][o].id}">${response[7][o].status_name}</option>
                            `)
                        }
                    }
                } else {
                    $('.status_view').hide()
                    for (let p = 0; p < response[8].length; p++) {
                        $('#data_list_applicant_status').append(`
                            <div class="md-step active">
                                <div class="md-step-circle"><span>${Number(response[8][p].application_status_id) + 1}</span></div>
                                <div class="md-step-title">${response[8][p].status_name}</div>
                                <div class="md-step-bar-left"></div>
                                <div class="md-step-bar-right"></div>
                            </div>
                        `)
                    }
                }

                
                // var $step_active = $('.md-step').click(function() {
                //     $step_active.removeClass('active');
                //     $(this).addClass('active');
                // })

                $('#button-reject').attr('data-applicant_number', id_applicant)
                $('#button-update').attr('data-applicant_number', id_applicant)
            }
        })
    })

    // for reject applicant data
    $(document).on('click', '#button-reject', function(e) {
        e.preventDefault()
        $.ajax({
            url: 'php_action/UpdateApplicantStatus.php',
            type: 'POST',
            data: new FormData($('#form_detail_data_applicant')[0]),
            dataType: 'json',
            processData: false,
            contentType: false,
            async: true,
            cache: false,
            success: function(response) {
                $(".form-group").removeClass('has-error').removeClass('has-success');
                mymodalss.style.display = "none";
                modals.style.display = "block";
                document.getElementById("msg").innerHTML = response.messages;

                $('#create_data_sub_menu').modal('hide');
                $("[data-dismiss=modal]").trigger({type: "click"});

                // Reload the page after 10 seconds
                setTimeout(function () {
                    location.reload();
                }, 3000);
            },
            error: function(xhr, status, error) {
                var errorMessage = JSON.parse(xhr.responseText);
                // $("#response").html("Error: " + errorMessage.message);
                mymodalss.style.display = "none";
                modals.style.display = "block";
                document.getElementById("msg").innerHTML = errorMessage.messages;
            }
        })
    })
    
    // for update applicant data
    $(document).on('click', '#button-update', function(e) {
        e.preventDefault()
        $.ajax({
            url: 'php_action/UpdateApplicantStatus.php',
            type: 'POST',
            data: new FormData($('#form_detail_data_applicant')[0]),
            dataType: 'json',
            processData: false,
            contentType: false,
            async: true,
            cache: false,
            success: function(response) {
                $(".form-group").removeClass('has-error').removeClass('has-success');
                mymodalss.style.display = "none";
                modals.style.display = "block";
                document.getElementById("msg").innerHTML = response.messages;

                $('#create_data_sub_menu').modal('hide');
                $("[data-dismiss=modal]").trigger({type: "click"});
                // Reload the page after 10 seconds
                setTimeout(function () {
                    location.reload();
                }, 3000);
            },
            error: function(xhr, status, error) {
                var errorMessage = JSON.parse(xhr.responseText);
                // $("#response").html("Error: " + errorMessage.message);
                mymodalss.style.display = "none";
                modals.style.display = "block";
                document.getElementById("msg").innerHTML = errorMessage.messages;

            }
        })
    })
    

})