<?php include "../../application/session/session.php";?>

<?php $datax = $_GET['id']; ?>
<?php $git = $_GET['git']; ?>

<html>
<head>
       <meta http-equiv="content-type" content="text/html; charset=UTF-8">
       <title>Definition Helper</title>
       <link type="text/css" rel="stylesheet" href="../../asset/vendor/ModalWindowHelper/index_002.css">
</head>

<body onclick="hideTip()">
       <table id="formtable" width="500px" height="100%" cellspacing="0" cellpadding="0" bordercolor="red" border="0"
              align="center">
        
              <tbody>
                     <tr>
                            <td>

                                   <!-- edited by ricky / Ronald -->
                                   <table width="100%" cellspacing="0" cellpadding="0" border="0">
                                          <tbody>
                                                 <tr>
                                                        <!--background="/sf6lib/images/graph/sflow/wndbg.png" -->
                                                        <td id="pop_title" class="wndbar "
                                                               style="display:block; max-width:500px" width="500"
                                                               nowrap="nowrap">
                                                               Definition Helper
                                                               <script>
                                                               pstitle = "Settings\x7CAdd";
                                                               </script>
                                                        </td>
                                                        <td></td>
                                                 </tr>
                                          </tbody>
                                   </table>
                                   <!-- end of edit -->
                            </td>
                     </tr>
                     <tr>
                            <td id="pop_data" style="height:100%;" class="box" valign="top">
                                   <div id="formspace" style="position:relative;width:100%;height:100%;overflow:auto;"
                                          onscroll="hideCalendar();">
                                          <div style="position:absolute; width:100%;">
                                                 <form name="frmFilterEmp" id="frmFilterEmp" method="post" action="?"
                                                        autocomplete="off" onsubmit="return validateForm(this);"><span
                                                               style="display:none;"><input type="Hidden"
                                                                      name="inp_dataobj" id="inp_dataobj"
                                                                      value="employee" style="display:none;"><input
                                                                      type="Hidden" name="fsort" style="display:none;"
                                                                      value=""><input type="Hidden" name="search_name"
                                                                      value="">
                                                        </span>
                                                        <div id="divForm">
                                                               <div id="formtab_1">
                                                                      <div id="formtab_1_tabpage"
                                                                             style="border: 0px solid red;">
                                                                             <table heightx="100%"
                                                                                    style="height: 390px;" width="100%"
                                                                                    cellspacing="0" cellpadding="0"
                                                                                    border="0">
                                                                                    <tbody>
                                                                                           <tr>
                                                                                                  <td
                                                                                                         id="formtab_1_tdtab">
                                                                                                         <table width="100%"
                                                                                                                height="100%"
                                                                                                                cellspacing="0"
                                                                                                                cellpadding="0"
                                                                                                                border="0">
                                                                                                                <tbody
                                                                                                                       id="formtab_1_tb">
                                                                                                                       <tr>
                                                                                                                              <td
                                                                                                                                     style="width: 100%;">
                                                                                                                                     <div
                                                                                                                                            style="background-image: url(&quot;/sf6lib/skins/images/tab/trow_a.png&quot;); background-position: left bottom; background-repeat: repeat-x;">
                                                                                                                                            <table width="100%"
                                                                                                                                                   height="100%"
                                                                                                                                                   cellspacing="0"
                                                                                                                                                   cellpadding="0"
                                                                                                                                                   bordercolor="red"
                                                                                                                                                   border="0">
                                                                                                                                                   <tbody>
                                                                                                                                                          <tr>
                                                                                                                                                                 <td id="vistab_2"
                                                                                                                                                                        style="vertical-align: bottom;">
                                                                                                                                                                        <table cellspacing="0"
                                                                                                                                                                               cellpadding="0"
                                                                                                                                                                               border="0">
                                                                                                                                                                               <tbody>
                                                                                                                                                                                      <tr>
                                                                                                                                                                                             <td
                                                                                                                                                                                                    valign="bottom">
                                                                                                                                                                                                    <img src="../../asset/vendor/ModalWindowHelper/actab_lt.png"
                                                                                                                                                                                                           align="bottom">
                                                                                                                                                                                             </td>
                                                                                                                                                                                             <td id="tab_2"
                                                                                                                                                                                                    class="actab_text"
                                                                                                                                                                                                    style="width: 76px;"
                                                                                                                                                                                                    nowrap="nowrap"
                                                                                                                                                                                                    background="../../asset/vendor/ModalWindowHelper/actab_t.png">
                                                                                                                                                                                                    Add
                                                                                                                                                                                                    Filter
                                                                                                                                                                                             </td>
                                                                                                                                                                                             <td
                                                                                                                                                                                                    valign="bottom">
                                                                                                                                                                                                    <img src="../../asset/vendor/ModalWindowHelper/actab_tr.png"
                                                                                                                                                                                                           align="bottom">
                                                                                                                                                                                             </td>
                                                                                                                                                                                      </tr>
                                                                                                                                                                               </tbody>
                                                                                                                                                                        </table>
                                                                                                                                                                 </td>
                                                                                                                                                                 <td
                                                                                                                                                                        width="100%">
                                                                                                                                                                        &nbsp;
                                                                                                                                                                 </td>
                                                                                                                                                          </tr>
                                                                                                                                                   </tbody>
                                                                                                                                            </table>
                                                                                                                                     </div>
                                                                                                                              </td>
                                                                                                                              <td id="rspace_1"
                                                                                                                                     style="background-image: url(&quot;/sf6lib/skins/images/tab/trow_a.png&quot;); background-position: right bottom; background-repeat: repeat-x;">
                                                                                                                                     &nbsp;
                                                                                                                              </td>
                                                                                                                       </tr>
                                                                                                                </tbody>
                                                                                                         </table>
                                                                                                  </td>
                                                                                           </tr>
                                                                                           <tr>
                                                                                                  <td
                                                                                                         style="height:100%;">
                                                                                                         <table width="100%"
                                                                                                                height="100%"
                                                                                                                cellspacing="0"
                                                                                                                cellpadding="0"
                                                                                                                bordercolor="brown"
                                                                                                                border="0">
                                                                                                                <tbody>
                                                                                                                       <tr>
                                                                                                                              <td
                                                                                                                                     background="../../asset/vendor/ModalWindowHelper/tab_line.png">
                                                                                                                                     <img
                                                                                                                                            src="../../asset/vendor/ModalWindowHelper/spacer.gif">
                                                                                                                              </td>
                                                                                                                              <td id="formtab_1_tdpage"
                                                                                                                                     style="border:0px solid green; padding:2px;"
                                                                                                                                     width="100%"
                                                                                                                                     valign="top"
                                                                                                                                     height="100%">

                                                                                                                                     <div id="tabcontent_2"
                                                                                                                                            class="tabcontent"
                                                                                                                                            style="padding: 4px;">
                                                                                                                                            <table
                                                                                                                                                   style="width: 100%;">
                                                                                                                                                   <tbody>
                                                                                                                                                          <tr id="tr_inp_txtBox"
                                                                                                                                                                 class="clTR2">
                                                                                                                                                                 <td colspan="2"
                                                                                                                                                                        class="label"
                                                                                                                                                                        id="tdb_1">





                                                                                                                                                                        


<table id="datatable" width="99%" class="table table-bordered table-striped table-hover table-head-fixed">
        <thead>
            <tr>
                <th class="fontCustom" style="z-index: 1;vertical-align: ce;vertical-align: middle;background-color:grey;color:white;" nowrap="nowrap">Item.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
            </tr>
        </thead>
        <?php
            $data = mysqli_query($connect, "SELECT * FROM hrmreserveword WHERE category IN ('EMPPERSONAL',
            'CUSTOM',
            'EMPDATA',
            'CUSTOMFIELD',
            'ATTENDDATA',
            'PAYFIELD')");
        ?>
        <?php if (mysqli_num_rows($data) > 0) { ?>
        <?php while ($row = mysqli_fetch_array($data)) { ?>
            <tr>
                <td style="cursor: pointer;" onclick="SetNameCreate<?php echo $row['word'] ?>();">
                <input type="hidden" 
                        name="ddlNames" 
                        id="ddlNames<?php echo $row['word'] ?>" 
                        onclick="SetNameCreate<?php echo $row['word'] ?>();" 
                        value="<?php echo $row['word'] ?>" 
                        style="width: 98%;">
                    <?php echo $row['word'] ?>
               
                
                <?php echo "<script type='text/javascript'>
                                   function SetNameCreate$row[word]() {
                                          if (window.opener != null && !window.opener.closed) {
                                                 var inp_formula = window.opener.document.getElementById('inp_formula');
                                                 inp_formula.value = '$datax' + ' {' + document.getElementById('ddlNames$row[word]').value + '}';
                                          }
                                          window.close();
                                   }
                                   </script>";
                     ?>
                <?php } ?>
                <td>
        <?php } ?>
        </tr>
</table>
                                                                                                                                                                               
                                                                                                                                                                               
                                                                                                                                                                               
                                                                                                                                                                               
                                                                                                                                                                               
                                                                                                                                                                               
                                                                                                                                                                               
                                                                                                                                                                               
                                                                                                                                                                               
                                                                                                                                                                               
                                                                                                                                                                               
                                                                                                                                                                               
                                                                                                                                                                               
                                                                                                                                                                               
                                                                                                                                                                               
                                                                                                                                                                               
                                                                                                                                                                               
                                                                                                                                                                               <br><span
                                                                                                                                                                               id="inp_txtBox_cnt"
                                                                                                                                                                               style="color:#666;display:none;"
                                                                                                                                                                               class="char-left">Characters
                                                                                                                                                                               left:
                                                                                                                                                                               500</span>
                                                                                                                                                                 </td>
                                                                                                                                                          </tr>

                                                                                                                                                   </tbody>
                                                                                                                                            </table>
                                                                                                                                     </div>
                                                                                                                              </td>
                                                                                                                              <td
                                                                                                                                     background="../../asset/vendor/ModalWindowHelper/tab_line.png">
                                                                                                                                     <img
                                                                                                                                            src="../../asset/vendor/ModalWindowHelper/spacer.gif">
                                                                                                                              </td>
                                                                                                                       </tr>
                                                                                                                       <tr>
                                                                                                                              <td colspan="3"
                                                                                                                                     height="15">
                                                                                                                                     <table width="100%"
                                                                                                                                            height="15"
                                                                                                                                            cellspacing="0"
                                                                                                                                            cellpadding="0"
                                                                                                                                            border="0">
                                                                                                                                            <tbody>
                                                                                                                                                   <tr>
                                                                                                                                                          <td><img
                                                                                                                                                                        src="../../asset/vendor/ModalWindowHelper/tab_bl.png">
                                                                                                                                                          </td>
                                                                                                                                                          <td style="background-repeat:repeat-x"
                                                                                                                                                                 width="100%"
                                                                                                                                                                 background="../../asset/vendor/ModalWindowHelper/tab_b.png">
                                                                                                                                                                 <img
                                                                                                                                                                        src="../../asset/vendor/ModalWindowHelper/spacer.gif">
                                                                                                                                                          </td>
                                                                                                                                                          <td><img
                                                                                                                                                                        src="../../asset/vendor/ModalWindowHelper/tab_rb.png">
                                                                                                                                                          </td>
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
                                                                      </div>
                                                               </div>
                                                 </form>
                                          </div>
                                   </div>
                            </td>
                     </tr>
              </tbody>
       </table>






































