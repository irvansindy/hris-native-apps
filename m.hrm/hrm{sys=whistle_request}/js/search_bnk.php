<script type="text/javascript">
$(function(){
       $('.select3').select2({
           minimumInputLength: 1,
           allowClear: true,
           placeholder: 'Enter bank',
           ajax: {
              dataType: 'json',
              url: 'fetching/fetch_bank.php',
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
      }).on('select3:select', function (evt) {
         var data = $(".select3 option:selected").text();
       //   alert("Data yang dipilih adalah "+data);
      });
});
</script>