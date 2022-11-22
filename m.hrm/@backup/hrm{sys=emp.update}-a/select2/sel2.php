<link rel="stylesheet" href="select2.min.css">
<link rel="stylesheet" href="select2-bootstrap4.min.css">
<script src="jquery.min.js"></script>

<section class="content">
       <select name="plant" class="form-control select2bs4 id">
              <option value="all">not specify</option>
              <option value="s">not s</option>
              <option value="ss">not ss</option>
</section>

<script type="text/javascript" src="select2.full.min.js"></script>
<script type="text/javascript" src="bs-custom-file-input.min.js"></script>

<script>
$(function() {
       $('.select2bs4').select2({
              theme: 'bootstrap4'
       })
})
</script>