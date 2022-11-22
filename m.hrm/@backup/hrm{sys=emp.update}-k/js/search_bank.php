<script type="text/javascript">
$(function(){
       $('.selectBanks').select2({
          //     minimumInputLength: 1,
          // tags: true,
          // multiple: false,
          // tokenSeparators: [',', ' '],
          minimumInputLength: 1,
          minimumResultsForSearch: 10,
           placeholder: 'Enter Banks ex : Ganesha',
           ajax: {
              dataType: 'json',
              url: 'fetching/fetch_banks.php',
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
      }).on('selectBanks:select', function (evt) {
         var data = $(".selectBanks option:selected").text();
       //   alert("Data yang dipilih adalah "+data);
      });
});
</script>