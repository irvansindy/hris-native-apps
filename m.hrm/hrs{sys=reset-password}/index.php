<?php include "../../application/session/sessionnoact.php";?>

<html>

<head>
       <meta http-equiv="content-type" content="text/html; charset=UTF-8">

       <title>Change Password</title>

       <link type="text/css" rel="stylesheet" href="asset/a.css">
</head>

<body class="fullsize">
<form name='form1' method="post" onsubmit='return validasi()'>
              <table width="420" height="250" cellspacing="0" cellpadding="5" bordercolor="red" border="0"
                     align="center">
                     <tbody>
                            <tr>
                                   <td>
                                          <table width="100%" height="100%" cellspacing="0" cellpadding="0"
                                                 bordercolor="red" border="0">
                                                 <tbody>
                                                        <tr>
                                                               <td>
                                                                      <table width="100%" cellspacing="0"
                                                                             cellpadding="0" border="0">
                                                                             <tbody>
                                                                                    <tr>
                                                                                           <td height="23px"></td>
                                                                                           <td style="padding-left:15px"
                                                                                                  class="wndbar"
                                                                                                  width="100%">Change
                                                                                                  Password</td>
                                                                                           <td></td>
                                                                                    </tr>
                                                                             </tbody>
                                                                      </table>
                                                               </td>
                                                        </tr>

                                                        <tr>
                                                               <td id="wnd_data" class="wcontent"
                                                                      style="height:100%;border:1px solid gray;padding:10px;"
                                                                      align="center">
                                                                      
                                                                      <table>


                                                                             <tbody>
                                                                                    <tr>
                                                                                           <td><label
                                                                                                         for="txtOPassword">Old
                                                                                                         Password</label>
                                                                                           </td>
                                                                                           <td><input type="Password"
                                                                                                         name="txtOPassword"
                                                                                                         id="txtOPassword"
                                                                                                         maxlength="50"
                                                                                                         style="width:200px;"
                                                                                                         value="">
                                                                                                  <input type="Hidden"
                                                                                                         name="txtUserId"
                                                                                                         value="6100">
                                                                                                  <input type="Hidden"
                                                                                                         name="txtUserName"
                                                                                                         value="13-0299">
                                                                                           </td>
                                                                                    </tr>

                                                                                    <tr>
                                                                                           <td><label for="txtPassword">New
                                                                                                         Password</label>
                                                                                           </td>
                                                                                           <td><input type="Password"
                                                                                                         name="txtPassword"
                                                                                                         id="txtPassword"
                                                                                                         maxlength="50"
                                                                                                         style="width:200px;"
                                                                                                         onkeyup="trgCheckPassword(this.value)">
                                                                                           </td>
                                                                                           <td style="width:30px;">
                                                                                                  <div id="spPwdCek"
                                                                                                         style="width:30px;">
                                                                                                  </div>
                                                                                           </td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                           <td><label
                                                                                                         for="txtCPassword">Confirm
                                                                                                         Passsword</label>
                                                                                           </td>
                                                                                           <td><input type="Password"
                                                                                                         name="txtCPassword"
                                                                                                         id="txtCPassword"
                                                                                                         maxlength="50"
                                                                                                         style="width:200px;">
                                                                                           </td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                           <td>&nbsp;</td>


                                                                                           <td><span
                                                                                                         style="color: gray; font-size: 7pt;">Entered
                                                                                                         Password should
                                                                                                         be minimum 8
                                                                                                         characters and
                                                                                                         combination of
                                                                                                         letters and
                                                                                                         numbers</span>
                                                                                           </td>

                                                                                    </tr>
                                                                                    <tr>
                                                                                           <td>&nbsp;</td>
                                                                                           <td nowrap="nowrap">
                                                                                                  <input
                                                                                                         type="Submit"
                                                                                                         name="ChgPsw"
                                                                                                         value="Change Password">
                                                                                                        
                                                                                                  <input type="Button"
                                                                                                         value="Cancel"
                                                                                                         onclick="location='../../application/logout';">
                                                                                           </td>
                                                                                    </tr>
                                                                             </tbody>
                                                                      </table><input type="Hidden" name="hdnts" value="{ts '2020-12-28 23:34:34'}">

                                                               </td>
                                                        </tr>
                                                        <tr>
                                                               <td>
                                                                      <table width="100%" cellspacing="0"
                                                                             cellpadding="0" border="0">
                                                                             <tbody>
                                                                                    <tr>
                                                                                           <td height="23px"></td>
                                                                                           <td class="wndbar"
                                                                                                  width="100%"><span
                                                                                                         id="spFooter"
                                                                                                         class="footer"
                                                                                                         style="width:200px;"></span>
                                                                                           </td>
                                                                                           <td></td>
                                                                                    </tr>
                                                                             </tbody>
                                                                      </table>
                                                               </td>
                                                        </tr>
                                                 </tbody>
                                          </table>
                                   </td>
                            </tr>
                     </tbody>
              </table>
       </form>
       
</body>

</html>

<?php include "controller/con_password_edit.php";?>

<script>
                     function validasi() {
                            var txtOPassword = document.getElementById("txtOPassword").value;
                            var txtPassword = document.getElementById("txtPassword").value;
                            var txtCPassword = document.getElementById("txtCPassword").value;
                     
              
                            
                            if(txtOPassword == "") {
                                   alert("Please insert Old Password");
                                   return false;
                            } else if(txtPassword == "") {
                                   alert("Please insert new password");
                                   return false;
                            } else if(txtCPassword == "") {
                                   alert("Please insert confirm password");
                                   return false;
                            } else if(txtCPassword != txtPassword) {
                                   alert("Please insert identical password");
                                   return false;
                            } else {
                                   return true;
                            }
                     }
              </script>