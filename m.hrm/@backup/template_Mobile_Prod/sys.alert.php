
<style>
body {font-family: Arial, Helvetica, sans-serif;}

/* The modals (background) */
.modals {
  display: none; /* Hidden by default */
  position: fixed; /* Stay in place */
  z-index: 99; /* Sit on top */
  padding-top: 100px; /* Location of the box */
  left: 0;
  top: 0;
  width: 100%; /* Full width */
  height: 100%; /* Full height */
  overflow: auto; /* Enable scroll if needed */
  background-color: rgb(0,0,0); /* Fallback color */
  background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
}
/* modals Content */
/* KALO VIEW MOBILE */
@media (max-width:960px) { 
    .modals-content {
                background-color: #fefefe;
                margin: auto;
                padding: 20px;
                border: 1px solid #888;
                width: 80%;
                min-height: 370px;
                margin-top: 70px;
    }
    .button_bot {
              background-color: #F68A22;
              border: solid 1px #DCDFDE;
              font-weight: bold;
              color: #E1E1E1;
              width: 100%;
              height: 40px;
              padding: 12px;
              text-align: center;
              text-decoration: none;
              display: inline-block;
              font-size: 14px;
              margin: 1px 1px;
              cursor: pointer;
              border-radius: 40px;
    }
    .button_bot[disabled]{
              background-color: #F68A22;
              border: solid 1px #DCDFDE;
              font-weight: bold;
              color: #E1E1E1;
              width: 100%;
              height: 40px;
              padding: 12px;
              text-align: center;
              text-decoration: none;
              display: inline-block;
              font-size: 14px;
              margin: 1px 1px;
              cursor: pointer;
              border-radius: 40px;
    }
}
/* KALO VIEW WEB */
@media (min-width:960px) { 
    .modals-content {
                background-color: #fefefe;
                margin: auto;
                padding: 20px;
                border: 1px solid #888;
                width: 25%

    }
    .button_bot {
              background-color: #F68A22;
              border: solid 1px #DCDFDE;
              font-weight: bold;
              color: #E1E1E1;
              width: 100%;
              height: 40px;
              padding: 12px;
              text-align: center;
              text-decoration: none;
              display: inline-block;
              font-size: 14px;
              margin: 1px 1px;
              cursor: pointer;
              border-radius: 40px;
    }
    .button_bot[disabled]{
              background-color: #F68A22;
              border: solid 1px #DCDFDE;
              font-weight: bold;
              color: #E1E1E1;
              width: 100%;
              height: 40px;
              cursor: no-drop;
              padding: 12px;
              text-align: center;
              text-decoration: none;
              display: inline-block;
              font-size: 14px;
              margin: 1px 1px;
              cursor: pointer;
              border-radius: 40px;
    }
}
/* The Close Button */
.close {
  color: #aaaaaa;
  float: right;
  font-size: 28px;
  font-weight: bold;
}

.sub_div {
    position: absolute;
    bottom: 20px;
}

</style>

<!-- The modals -->
<div id="mymodals" class="modals" style="display:none">
  <div class="modals-content" style="width: 80%;margin-top: 35px;">
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