<div class="col-md-12">
                                <div class="card">
                                    <div class="card-header d-flex align-items-center">
                                        <h4 class="card-title mb-0">Unggah Dokumen Surat Persetujuan Rekanan</h4>
                       

                                        <div class="card-actions ml-auto">
                                        <table>
                                    

                                      
                                        <td>
                                        <!--<td>
                                        <a href="" onclick="return stopload()">
                                                        <div class="toolbar sprite-toolbar-reload" id="RELOAD" title="Reload" onclick="reloadPage();">
                                                        </div>
                                                        </a>
                                        </td>-->
                                        </table>
                                          

                                        </div>
                                    </div>


                                    <div class="col-md-5" style="text-align: center;align-content: center;margin: auto;width: 50%;border: 3px solid #fbfffb;padding: 10px;">
                                   <div class="card" style="margin: 10px;padding: 50px;">
                                   <h4 class="card-title mb-0">Silahkan unggah dokumen maksimal 4 MB dan tipe data .pdf</h4>
                                    
                                                 <br>
                                                 <br>
                                                 <form action="#">
                                                 <div class="input-file-container">  
                                                 <input class="input-file" id="file" name="file" type="file">
                                                 <label tabindex="0" for="my-file" class="input-file-trigger">Pilih Dokumen</label>
                                                 </div>
                                                 <p class="file-return"></p>
                                                 </form>
                                                 <br>
                                                 <br>
                                                 <span id="uploaded_image"></span>
                                          </div>
                                   </div>


<div class='card-footer' style='background-color: #eee;height: 37px;padding-top: 5px;'>

                                          <div class='row mb-2'>
                                                 <div class='col-sm-10'>
                                                      
                                                 </div>
                                                 <div class='col-sm-2'>

                                                        <div id="toolbarlist">
                                                              
                                                        </div>


                                                 </div>
                                          </div>

                                    </div>

                                </div>
                            </div>


<style>
.input-file-container {
  position: relative;
  width: 225px;
} 
.js .input-file-trigger {
  display: block;
  padding: 14px 45px;
  background: #39D2B4;
  color: #fff;
  font-size: 1em;
  transition: all .4s;
  cursor: pointer;
}
.js .input-file {
  position: absolute;
  top: 0; left: 0;
  width: 225px;
  opacity: 0;
  padding: 14px 0;
  cursor: pointer;
}
.js .input-file:hover + .input-file-trigger,
.js .input-file:focus + .input-file-trigger,
.js .input-file-trigger:hover,
.js .input-file-trigger:focus {
  background: #34495E;
  color: #39D2B4;
}

.file-return {
  margin: 0;
}
.file-return:not(:empty) {
  margin: 1em 0;
}
.js .file-return {
  font-style: italic;
  font-size: .9em;
  font-weight: bold;
}
.js .file-return:not(:empty):before {
  content: "Selected file: ";
  font-style: normal;
  font-weight: normal;
}






/* Useless styles, just for demo styles */

body {
  font-family: "Open sans", "Segoe UI", "Segoe WP", Helvetica, Arial, sans-serif;
  color: #7F8C9A;
  background: #FCFDFD;
}
h1, h2 {
  margin-bottom: 5px;
  font-weight: normal;
  text-align: center;
  color:#aaa;
}
h2 {
  margin: 5px 0 2em;
  color: #1ABC9C;
}
form {
  width: 225px;
  margin: 0 auto;
  text-align:center;
}
h2 + P {
  text-align: center;
}
.txtcenter {
  margin-top: 4em;
  font-size: .9em;
  text-align: center;
  color: #aaa;
}
.copy {
  margin-top: 2em;
}
.copy a {
  text-decoration: none;
  color: #1ABC9C;
}
</style>
<script>
       document.querySelector("html").classList.add('js');

var fileInput  = document.querySelector( ".input-file" ),  
    button     = document.querySelector( ".input-file-trigger" ),
    the_return = document.querySelector(".file-return");
      
button.addEventListener( "keydown", function( event ) {  
    if ( event.keyCode == 13 || event.keyCode == 32 ) {  
        fileInput.focus();  
    }  
});
button.addEventListener( "click", function( event ) {
   fileInput.focus();
   return false;
});  
fileInput.addEventListener( "change", function( event ) {  
    the_return.innerHTML = this.value;  
});  
</script>


<script>
       var uploadField = document.getElementById("file");
       // doc,jpg,ods,png,txt,doc,pdf
       var allowedFiles = [".pdf"];
       var regex = new RegExp("([a-zA-Z0-9\s_\\.\-:])+(" + allowedFiles.join('|') + ")$");

       uploadField.onchange = function() {
       if(this.files[0].size > 3145728){
                                   alert("Dokumen terlalu besar, Maksimum upload file 4 Mb");
                                   this.value = "";
       } else if (!regex.test(uploadField.value.toLowerCase())) {
                                   alert("Hanya File Pdf yang diijinkan");
                                   this.value = "";
       };
       };
</script>

<script>
$(document).ready(function(){
 $(document).on('change', '#file', function(){
  var name = document.getElementById("file").files[0].name;
  var form_data = new FormData();
  var ext = name.split('.').pop().toLowerCase();
  if(jQuery.inArray(ext, ['pdf']) == -1) 
  {
   alert("Invalid Image File");
  }
  var oFReader = new FileReader();
  oFReader.readAsDataURL(document.getElementById("file").files[0]);
  var f = document.getElementById("file").files[0];
  var fsize = f.size||f.fileSize;
  if(fsize > 2000000)
  {
   alert("Image File Size is very big");
  }
  else
  {
   form_data.append("file", document.getElementById('file').files[0]);
   $.ajax({
       url:"uploader_dokumen.php?&code=1",
       method:"POST",
       data: form_data,
       contentType: false,
       cache: false,
       processData: false,
       beforeSend:function(){
       $('#uploaded_image').html("<label class='text-success'>Document Uploading...</label>");
       },   
       success:function(data)
       {
       $('#uploaded_image').html(data);
       }
   });
  }
 });
});
</script>