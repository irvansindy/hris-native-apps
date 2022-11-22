<script type="text/javascript">
$(function(){
       $('.selectNationality').select2({
          //     minimumInputLength: 1,
          // tags: true,
          // multiple: false,
          // tokenSeparators: [',', ' '],
          minimumInputLength: 1,
          minimumResultsForSearch: 10,
  
           placeholder: 'Enter Nationality ex : Indonesia',
           ajax: {
              dataType: 'json',
              url: 'fetching/fetch_nationality.php',
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
      }).on('selectNationality:select', function (evt) {
         var data = $(".selectNationality option:selected").text();
       //   alert("Data yang dipilih adalah "+data);
      });
});
</script>