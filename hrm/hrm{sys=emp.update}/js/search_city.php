<script type="text/javascript">
$(function(){
       $('.selectCity').select2({
       //     minimumInputLength: 1,
           minimumInputLength: 1,
           minimumResultsForSearch: 10,
           placeholder: 'Enter City',
           ajax: {
              dataType: 'json',
              url: 'fetching/fetch_cityS.php',
              delay: 300,
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
      }).on('selectCity:select', function (evt) {
         var data = $(".selectCity option:selected").text();
         alert("Data yang dipilih adalah "+data);
      });
});
</script>