<?php include "../../application/session/session.php";?>
<html xmlns="http://www.w3.org/1999/xhtml"><head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>Corporate Human Resource Information System</title>
<link rel="stylesheet" type="text/css" href="css/display.css">
<link rel="stylesheet" type="text/css" href="css/style.css">
<style type="text/css">
body { margin:0; padding:0;	background:url("img/login-bg.png"); font:12px Verdana, Arial, Helvetica, sans-serif; color:#333}
#login-bg {z-index:-1; background-position:center; background-repeat:no-repeat; position:absolute; width:100%; height:100%}
#login-shadow { position:absolute; top:0; z-index:-1; width:100%; height:100%;opacity: 0.1;}
#login-logo {background:url("img/sprite-login.png") no-repeat; background-position: -518px 0px; width:438px; height:296px; position:absolute; top:50%; margin-top:-190px; left:50%; margin-left: -440px;}
#login-bg-top { background:url("img/login-bg-top.png") repeat-x; height:45%; width:100%; position:absolute; z-index:-2}
#form-block {background:url("img/sprite-login.png") no-repeat; background-position: -96px -7px;width:423px; height:307px; position:absolute; top:50%; margin-top:-190px; left:50%}
#title-form-block { font:bold 17px Verdana, Arial, Helvetica, sans-serif; color:#666; text-align:center; margin-top:17px; margin-bottom:17px}
#form-block h4 { font:bold 15px Verdana, Arial, Helvetica, sans-serif; color:#666; text-align:left; margin:0; padding-left:32px; padding-bottom:5px; overflow:hidden; text-overflow:ellipsis}
#form-login {width:370px; margin:0 auto; font:12px Verdana, Arial, Helvetica, sans-serif;}
#form-login ul { margin:0; padding:0; list-style:none}
#form-login ul li { padding:3px}
#form-login ul li label { width:120px; padding:3px 5px}
#form-login ul li input { width:200px; padding:3px 5px}
#form-login ul li input#chkRemember {margin-left:-1px; width:15px; padding:3px 5px} 
#form-login ul li input#btn-logon 
{ background:url("img/sprite-login.png") no-repeat; background-position: -10px -63px; width:86px; padding:6px 0 7px; color:#fff; cursor:pointer; float:left; border:0; font-size:12px}
#form-login ul li input#btn-logon:hover { background:url("img/sprite-login.png") no-repeat;background-position: -10px -33px; width:86px; padding:6px 0 7px}
#tid_loginsaas { }
#txtAccount { background:#d7eff8; border:1px solid #7f9db9}
#tid_loginlink { float:left; line-height:27px; }
#tid_loginlink a { text-decoration:none; color:#333}
#tid_loginlink a:hover { text-decoration:underline}
#forgot-pass a { text-decoration:none; color:#333; line-height:32px;}/* margin-left:7px*/
#forgot-pass a:hover { text-decoration:underline}
#switch-mode { position:absolute; top:50%; left:50%; margin-top:-212px; margin-left:-2px;z-index: 3;padding-left: 15px;padding-right: 15px;}
#tid_selanguage { /*position:absolute; left:50%; top:50%; margin-top:-215px; z-index:1;*/ width:400px; height:50px}
#ver { font-size:11px; color:#666; position:absolute; top:200px; right:15px}
.copyright { text-align:center; font-size:12px; position:absolute; top:50%; margin-top:200px; left:50%; margin-left:-250px; width:500px; padding:10px 0; opacity:0.75; background:#fff; border-radius:5px}
#copyright_logo { background:url("img/sprite-login.png") no-repeat; background-position: -10px -94px; width:84px; height:36px}
#color-theme { position:absolute; left:50%; top:50%; margin-top:-215px; z-index:2; display:none}
.ct-1 { background:url("img/sprite-login.png") no-repeat; background-position: -10px -10px; width:21px; height:21px; margin-right:5px;}
.ct-2 { background:url("img/sprite-login.png") no-repeat; background-position: -31px -10px; width:21px; height:21px; margin-right:5px;}
.ct-3 { background:url("img/sprite-login.png") no-repeat; background-position: -52px -10px; width:21px; height:21px; margin-right:5px;}

#color-theme div { cursor:pointer}
#color-theme span { font-weight:bold; float:left; padding:4px 5px}
#app-mode { /*position:absolute; left:50%; top:50%; margin-top:-215px; z-index:2;*/ display:block; float:left}
#app-mode div { cursor:pointer; float:left}
#app-mode span { font-weight:bold; float:left; padding:4px 5px}
#p_langlist{ float:right; position:relative}
#p_langlist div{float: left;padding-bottom: 3px;padding-left: 10px;padding-right: 10px;padding-top: 3px;}
#divLang { clear:both; background:#fff; border:1px solid #999; position:absolute!important; right:0!important; top:23px!important; left:auto!important; min-width:100px}
</style>

</head>


<body class="fullsize" bgcolor="white">


<div id="login-bg"></div>
<div id="switch-mode">
<div id="color-theme">

<!--<img src="login-theme1.png" id="Image11" onClick="switchScheme(1)"; />
<img src="login-theme2.png" id="Image10" onClick="switchScheme(2)"; />
<img src="login-theme3.png" id="Image9" onClick="switchScheme(3)";/>-->
</div>

<div id="tid_selanguage" class="tid"><div id="p_langlist" style="display: block;">
		<div><b>Language</b></div>
		<div class="mod-selectbox-in country-flag" onclick="switchLanguage();">        
		        <img style="padding-left:4px;" src="img/flag-id.png" alt="" width="14px" height="10px">
		        <span class="flag-" style="padding-left:5px;background: rgba(0, 0, 0, 0)  no-repeat scroll right top;">
    	        Bahasa</span>
		</div>
	</div>
</div>
</div>



<br>

<div id="form-block">
	<h3 id="title-form-block">Human Resource Information System </h3>
    	<h4>PT. Gajah Tunggal Tbk</h4>
       
	<div id="form-login">
	<form action="indexprocess.php" enctype="multipart/form-data" method="POST">
	<div id="tid_loginsaas"></div>
	<ul>
		<li><label>User Name</label>
			<input type="text" placeholder="nip" name="nip" value="<?php echo $username ?>" autocomplete="off" required readonly>
			<input type="hidden" name="acc" value="<?php echo $hak_akses ?>" autocomplete="off" required></li>
		<li><label>Full Name</label><input type="text" placeholder="nama" name="nama" value="<?php echo $nama ?>" autocomplete="off" required readonly></li>
		<li><label>New Password</label><input type="password" placeholder="Password" name="password" autocomplete="off" required ></li>


		<li><label>&nbsp;</label><input name="chkRemember" id="chkRemember" checked="" type="checkbox">Remember Me</li>
		<li><label><span id="forgot-pass"><a href="#" onclick="innerPop('?sfid=sys.sec.forgot',reposBlock);"> </a></span></label><input value="Login" id="btn-logon" type="Submit">
		</li>
		<li style="clear:both"><div id="tid_loginlink"><div id="p_loginlink" style="display: block;">


<a href="#" onclick="location='?sfid=sys.sec.delsfhome'"></a>&nbsp; <m val="OVER_ADMIN" or="-999999" ors=""> 
</m></div></div></li>						
	</ul><input name="xxpost" value="9F934BA49D3C1A38C49A0313ECB9ED98" type="Hidden"><input name="hdnts" value="2019/03/11 09:49:33" type="Hidden">
	</form>
	</div>
	<div id="ver">Ver. 6.0.1205.5284.000</div>
</div>













<div id="tid_copyright" class="copyright"><div id="p_copyright" style="display: block;">
<div id="copyright_logo" style="float: left; margin: 0px 20px;display:none;"></div>
<div id="copyright_text" >
This product is licensed for PT. Gajah Tunggal Tbk<br>

© Department of Payroll Tangerang Factory. All Rights Reserved
</div>
</div></div>
<div id="login-bg-top"></div>
<div id="login-logo"></div>
<img src="img/login-shadow.png" id="login-shadow">


<script>
////	loadLogin(document.body,'sys.sec.login');



</script>






</body>
</html>