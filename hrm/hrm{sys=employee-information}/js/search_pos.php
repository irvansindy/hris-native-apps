<script type="text/javascript">
$(function(){
       $('.select2').select2({
           minimumInputLength: 1,
           allowClear: true,
           placeholder: 'Enter your position code',
           ajax: {
              dataType: 'json',
              url: 'fetching/fetch_position.php',
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
      }).on('select2:select', function (evt) {
         var data = $(".select2 option:selected").text();
       //   alert("Data yang dipilih adalah "+data);
      });
});
</script>