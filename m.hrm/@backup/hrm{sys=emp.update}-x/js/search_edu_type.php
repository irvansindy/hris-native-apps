<script type="text/javascript">
$(function(){
       $('.selectEducation').select2({
          //     minimumInputLength: 1,
          // tags: true,
          // multiple: false,
          // tokenSeparators: [',', ' '],
          minimumInputLength: 1,
          // minimumResultsForSearch: 10,
           allowClear: false,
           placeholder: 'Pilih jenis level pendidikan',
           ajax: {
              dataType: 'json',
              url: 'fetching/fetch_edutype.php',
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
      }).on('selectEducation:select', function (evt) {
         var data = $(".selectEducation option:selected").text();
       //   alert("Data yang dipilih adalah "+data);
      });
});
</script>