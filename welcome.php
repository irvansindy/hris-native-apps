<head>
  <meta http-equiv="refresh" content="10">
</head>
<title>Human Resource Information System</title>

<link rel="shortcut icon" href="asset/img/favicon.ico" type="image/x-icon" />
<head>
  <!-- Layout CSS -->
  <link id="theme-css" rel="stylesheet" type="text/css" href="asset/gt_developer/sfloader/theme-cyan.css">
  <link id="layout-css" rel="stylesheet" type="text/css" href="asset/gt_developer/sfloader/layout-cyan.css">

<link rel="stylesheet" href="asset/gt_developer/sfloader/styles.css">
</head>
<body>
    <app-root>
        <div class="splash-screen">
            <div class="splash-loader">
                <img src="asset/dist/img/logo-Recovereds.png">
				<form id="frmSignIn" name="frmSignIn" method="post">
																<input type="hidden" name="username" value="<?php echo $usernameCookies ?>" class="form-control input-lg">
																<input type="hidden" name="password" value="<?php echo $passwordCookies ?>" class="form-control input-lg">
												</form>
            </div>
        </div>
    </app-root>
</body></html>	

												
		

<script type="text/javascript">
  function onReady(callback) {
      var intervalID = window.setInterval(checkReady, 1000);
      function checkReady() {
          if (document.getElementsByTagName('body')[0] !== undefined) {
              window.clearInterval(intervalID);
              callback.call(this);
          }
      }
  }
  function show(id, value) {
      document.getElementById(id).style.display = value ? 'block' : 'none';
  }
  onReady(function () {
	  window.location.href = "login";      
      show('page', true);
	  show('loading', false);
      show('loadings', false);
	  show('image', false);
      
  });
 </script>




