<!DOCTYPE html>
<html>

<head>
  <title>Report</title>
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link href="../../asset/dist/gt.png" rel="shortcut icon" type="image/x-icon"/>
  <link rel="stylesheet" href="../../asset/bower_components/bootstrap/dist/css/bootstrap.css">
  <link rel="stylesheet" href="../../asset/dist/css/AdminLTErep.css">
  <link rel="stylesheet" href="../../asset/dist/css/skins/_all-skins.min.css"> 
  <link rel="stylesheet" href="../../asset/dist/datepickerpack/pikaday.css">
  <link rel="stylesheet" href="../../asset/dist/datepickerpack/theme.css">
  <script src="../../asset/dist/datepickerpack/moment.js"></script>
  <script src="../../asset/dist/datepickerpack/pikaday.js"></script>
</head>


<body class="skin-purple fixed">
    <div id="spinner" style="position:fixed; background: rgba(255,255,255,0.7);width: 100%;height: 100%;z-index: 999999;display: none;">
        <div style="position: absolute; top: 0; left: 0; width: 100%; height: 100%;">
        <i class="fa fa-refresh fa-spin" style="position: absolute; top: 50%; left: 50%; margin-left: -15px; margin-top: -15px; color: #000; font-size: 70px;"></i>
        </div>
    </div>
    <div class="wrapper">

      <header class="main-header">
        <a href="" class="logo"><img src="../../asset/dist/img/gt_text.png" width="200" height="25"/></a>
        <nav class="navbar navbar-static-top" role="navigation">
  </header></nav></header></div>
















<br>
<br>
<section class="content-header">
<table width="10%">
<td nowrap="nowrap">        
<form method="POST" action=""><strong><h6>&nbsp;&nbsp;SELECT A REPORT:&nbsp;&nbsp;</strong> 
</td>   
<td>
    <select name="" onChange="document.location.href=this.options[this.selectedIndex].value;">
        <option value="index.php?public">-- Select Report -- </option>
        <option value="index.php?reportofclosing">Pengajuan KPT Ganesha</option>


    </select>
</form>
</td>
<td>
<input class="btnreport btn-report" type="submit" value="&nbsp;&nbsp;select&nbsp;&nbsp;" name=""></button>
</td>
<td valign="bottom">
<input type="image" onclick="self.close()" id="cetak" src="../../asset/dist/img/icon_exit.png" title="close" width="22" /></div>
</td>
</table>
<table border="1">
<?php   
    if (isset($_GET["reportofclosing"])) { header ("location:filter");}     
    elseif(isset($_GET["public"])){ header ("location:public");}  
?>
</table>     
</div>
</section>

