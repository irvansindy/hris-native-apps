<script type="text/javascript">
$(function(){
       $('.select7').select2({
       //     minimumInputLength: 1,
              minimumInputLength: 1,
              allowClear: true,
              placeholder: 'Enter City',
              ajax: {
                     dataType: 'json',
                     url: 'fetching/fetch_city.php',
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
      }).on('select7:select', function (evt) {
         var data = $(".select7 option:selected").text();
       //   alert("Data yang dipilih adalah "+data);
      });
});
</script>