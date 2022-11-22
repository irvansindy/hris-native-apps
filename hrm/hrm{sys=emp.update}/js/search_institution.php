<script type="text/javascript">
$(function(){
       $('.selectInstitution').select2({
          // minimumInputLength: 1,
          // tags: true,
          // multiple: false,
          // tokenSeparators: [',', ' '],
          minimumInputLength: 1,
          // minimumResultsForSearch: 10,
  
           placeholder: 'Enter Institution',
           ajax: {
              dataType: 'json',
              url: 'fetching/fetch_institution.php',
              delay: 100,
              data: function(params) {
                return {
                  search: params.term
                }
              },
              processResults: function (data, page) {
              return {
                results: data
              };
            },
          }
      }).on('selectInstitution:select', function (evt) {
         var data = $(".selectInstitution option:selected").text();
       //   alert("Data yang dipilih adalah "+data);
      });
});
</script>