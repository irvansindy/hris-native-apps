<script type="text/javascript">
$(function(){
       $('.select6').select2({
       //     minimumInputLength: 1,
       minimumInputLength: 1,
           allowClear: true,
           placeholder: 'Enter Nationality',
           ajax: {
              dataType: 'json',
              url: 'fetching/fetch_nationality.php',
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
      }).on('select6:select', function (evt) {
         var data = $(".select6 option:selected").text();
       //   alert("Data yang dipilih adalah "+data);
      });
});
</script>