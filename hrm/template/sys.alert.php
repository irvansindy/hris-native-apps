<!-- The modals -->
<div id="mymodals" class="modals" style="display:none">
  <div class="modals-content" style="width: 20%;margin-top: 35px;">
    <p><table width="100%">
            <tr><td align="center"><img src="../../asset/dist/img/sf-mola-mola.png" style="max-width: 90%;margin-top: 20px;"></td></tr>
            <tr><td style="width: 85%; font-weight:bold;color: #777b7b;" align="center"><p id="msg"></p><br>
                    <button type='submit' name='submit_add' id='submit_add' style="padding: 1px;" type='button' class="btn btn-warning button_bot closeds">
                        Keluar
                    </button>
            </td></tr>
        </table> 
    </p>
  </div>
</div>
<!-- The modals -->
<script>
// Get the modals
var modals = document.getElementById("mymodals");
var span = document.getElementsByClassName("closeds")[0];
span.onclick = function() {
  modals.style.display = "none";
}
window.onclick = function(event) {
  if (event.target == modals) {
    modals.style.display = "none";
  }
}
</script>