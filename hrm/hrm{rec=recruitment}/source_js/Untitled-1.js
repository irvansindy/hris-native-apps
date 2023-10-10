// data yang ditampilkan untuk json applicant detail :

$response_json = {
    0 : {
        full_name: 'full_name',
        gender: 'gender',
        phone: 'phone',
        email: 'email',
        birth_place: 'birth_place',
        birth_date: 'birth_date',
        address: 'address',
        position_applied: 'position_applied',
        date_applied: 'date_applied',
    }, 
    1 : {
        'experience' : {
            company_name: 'company_name',
            company_address: 'company_address',
            start_date: 'start_date',
            end_date: 'end_date',
            start_position: 'start_position',
            end_position: 'end_position',
            job_desk: 'job_desk',
            project: 'project',
            salary_entry: 'salary_entry',
            salary_last: 'salary_last',
            other_benefits: 'other_benefits',
            reason_for_leaving: 'reason_for_leaving',
        },
        'education' : {
            institution_name: 'institution_name',
            degree: 'degree',
            major: 'major',
            start_year: 'start_year',
            end_year: 'end_year',
            achievement: 'achievement',
        },
        'skill': {
            skill_name: 'skill_name',
            skill_category: 'skill_category',
            value: 'value',
            skill_from: 'skill_from',
        },
        
    }
}