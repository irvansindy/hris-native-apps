<script type="text/javascript">
$(function(){
       $('#select1').select2({
           minimumInputLength: 1,
           allowClear: true,
           placeholder: 'Enter cost center',
           ajax: {
              dataType: 'json',
              url: 'fetching/fetch_cost.php',
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
      }).on('select1:select', function (evt) {
         var data = $(".select1 option:selected").text();
       //   alert("Data yang dipilih adalah "+data);
      });
});
</script>