<?php
include "../../application/config.php";
session_start();

$u_agent = $_SERVER['HTTP_USER_AGENT'];
	    $bname = 'Unknown';
	    $platform = 'Unknown';
	    $version= "";
	 
	    //First get the platform?
	    if (preg_match('/linux/i', $u_agent)) {
	        $platform = 'linux';
	    }
	    elseif (preg_match('/macintosh|mac os x/i', $u_agent)) {
	        $platform = 'mac';
	    }
	    elseif (preg_match('/windows|win32/i', $u_agent)) {
	        $platform = 'windows';
	    }
	 
	    // Next get the name of the useragent yes seperately and for good reason
	    if(preg_match('/MSIE/i',$u_agent) && !preg_match('/Opera/i',$u_agent))
	    {
	        $bname = 'Internet Explorer';
	        $ub = "MSIE";
	    }
	    elseif(preg_match('/Firefox/i',$u_agent))
	    {
	        $bname = 'Mozilla Firefox';
	        $ub = "Firefox";	        
	    }
	    elseif(preg_match('/Chrome/i',$u_agent))
	    {
	        $bname = 'Google Chrome';
	        $ub = "Chrome";
	    }
	    elseif(preg_match('/Safari/i',$u_agent))
	    {
	        $bname = 'Apple Safari';
	        $ub = "Safari";
	    }
	    elseif(preg_match('/Opera/i',$u_agent))
	    {
	        $bname = 'Opera';
	        $ub = "Opera";
	    }
	    elseif(preg_match('/Netscape/i',$u_agent))
	    {
	        $bname = 'Netscape';
	        $ub = "Netscape";
	    }
		else
	    {
	        $bname = 'NotSupport';
	        $ub = "NotSupport";
	    }
	 
	    // finally get the correct version number
	    $pos=strpos($u_agent,$ub);
	    $m=$pos+strlen($ub)+1;
	    if ($ub=='MSIE')
	    	$l=strpos($u_agent,';',$m)-$m;
	    else
		    $l=strpos($u_agent,' ',$m)-$m;
		if ($l<=0) $l=10;
		$version=substr($u_agent,$m,$l);
		
		$ip_address = $_SERVER['REMOTE_ADDR'];
		
if ($bname == 'Internet Explorer'){
        echo"<script type='text/javascript'>
                window.location.replace('../../_u');   
            </script>";
      } elseif ($bname == 'NotSupport'){
        echo"<script type='text/javascript'>
                window.location.replace('../../_u');        
            </script>";
      }
	  
	  
if( empty($_SESSION['nama_user']) )
{
  echo "<script type='text/javascript'>
  alert('User Session Expired. You will be Redirected to Login Page');
					window.setTimeout(function(){ 
						window.location.replace('../../welcome');
					} ,10)    
					</script>";
  exit();
}

if (!empty($_SESSION['nama_user']) && $_SESSION['login'] > 0){
	echo"<script type='text/javascript'>
		 window.location.replace('../../hrm/hrm{sys=emp.dashboard}/');   
	    </script>";
}

$username = ( isset($_SESSION['username']) ) ? $_SESSION['username'] : '';
$nama = ( isset($_SESSION['nama_user']) ) ? $_SESSION['nama_user'] : '';
$avatar = ( isset($_SESSION['avatar']) ) ? $_SESSION['avatar'] : '';
$position = ( isset($_SESSION['position']) ) ? $_SESSION['position'] : '';
$hak_akses = ( isset($_SESSION['akses']) ) ? $_SESSION['akses'] : '';
$employee_access = ( isset($_SESSION['employee_access']) ) ? $_SESSION['employee_access'] : '';
$employee_access_lv_2 = ( isset($_SESSION['employee_access_lv_2']) ) ? $_SESSION['employee_access_lv_2'] : '';
$employee_access_lv_3 = ( isset($_SESSION['employee_access_lv_3']) ) ? $_SESSION['employee_access_lv_3'] : '';

$syntax1 = ( isset($_SESSION['syntax1']) ) ? $_SESSION['syntax1'] : '';
$syntax2 = ( isset($_SESSION['syntax2']) ) ? $_SESSION['syntax2'] : '';


$accession = ( isset($_SESSION['accession']) ) ? $_SESSION['accession'] : '';
$function_authorized = ( isset($_SESSION['function_authorized']) ) ? $_SESSION['function_authorized'] : '';
$access_group = ( isset($_SESSION['access_group']) ) ? $_SESSION['access_group'] : '';
$user_type = ( isset($_SESSION['user_type']) ) ? $_SESSION['user_type'] : '';

$func = ( isset($_SESSION['func']) ) ? $_SESSION['func'] : '';


//untuk Application Management
$mainAppAcm = ( isset($_SESSION['mainAppAcm']) ) ? $_SESSION['mainAppAcm'] : '';
$mainAppCsr = ( isset($_SESSION['mainAppCsr']) ) ? $_SESSION['mainAppCsr'] : '';
$mainAppMov = ( isset($_SESSION['mainAppMov']) ) ? $_SESSION['mainAppMov'] : '';
$mainAppRcp = ( isset($_SESSION['mainAppRcp']) ) ? $_SESSION['mainAppRcp'] : '';
$mainAppAms = ( isset($_SESSION['mainAppAms']) ) ? $_SESSION['mainAppAms'] : '';
$mainAppIns = ( isset($_SESSION['mainAppIns']) ) ? $_SESSION['mainAppIns'] : '';
$mainAppElg = ( isset($_SESSION['mainAppElg']) ) ? $_SESSION['mainAppElg'] : '';
$mainAppEpm = ( isset($_SESSION['mainAppEpm']) ) ? $_SESSION['mainAppEpm'] : '';
$mainAppEef = ( isset($_SESSION['mainAppEef']) ) ? $_SESSION['mainAppEef'] : '';

//untuk menu yang ada di aplikasi access management
$mainAAarchive = ( isset($_SESSION['mainAAarchive']) ) ? $_SESSION['mainAAarchive'] : '';

//untuk menu yang ada di aplikasi overtime management
$mainOVtransactionempl = ( isset($_SESSION['mainOVtransactionempl']) ) ? $_SESSION['mainOVtransactionempl'] : '';
$mainOVtransactionproc = ( isset($_SESSION['mainOVtransactionproc']) ) ? $_SESSION['mainOVtransactionproc'] : '';
$mainOVtransactionclos = ( isset($_SESSION['mainOVtransactionclos']) ) ? $_SESSION['mainOVtransactionclos'] : '';
$mainOVtransactionlogs = ( isset($_SESSION['mainOVtransactionlogs']) ) ? $_SESSION['mainOVtransactionlogs'] : '';
$mainOVtransactionrpid = ( isset($_SESSION['mainOVtransactionrpid']) ) ? $_SESSION['mainOVtransactionrpid'] : '';
$mainOVtransactionimpr = ( isset($_SESSION['mainOVtransactionimpr']) ) ? $_SESSION['mainOVtransactionimpr'] : '';
$mainOVtransactiondown = ( isset($_SESSION['mainOVtransactiondown']) ) ? $_SESSION['mainOVtransactiondown'] : '';
$mainOVtransactionbank = ( isset($_SESSION['mainOVtransactionbank']) ) ? $_SESSION['mainOVtransactionbank'] : '';
$mainOVtransactionslip = ( isset($_SESSION['mainOVtransactionslip']) ) ? $_SESSION['mainOVtransactionslip'] : '';
$mainOVtransactionince = ( isset($_SESSION['mainOVtransactionince']) ) ? $_SESSION['mainOVtransactionince'] : '';
$mainOVtransactionreim = ( isset($_SESSION['mainOVtransactionreim']) ) ? $_SESSION['mainOVtransactionreim'] : '';

//untuk menu yang ada di aplikasi receipt management
$mainRetransactionempl = ( isset($_SESSION['mainRetransactionempl']) ) ? $_SESSION['mainRetransactionempl'] : '';
$mainRetransactionappr = ( isset($_SESSION['mainRetransactionappr']) ) ? $_SESSION['mainRetransactionappr'] : '';
$mainRetransactiontran = ( isset($_SESSION['mainRetransactiontran']) ) ? $_SESSION['mainRetransactiontran'] : '';
$mainRetransactionrpid = ( isset($_SESSION['mainRetransactionrpid']) ) ? $_SESSION['mainRetransactionrpid'] : '';

//untuk menu yang ada di aplikasi kpt management
$mainAKtransactiontrns = ( isset($_SESSION['mainAKtransactiontrns']) ) ? $_SESSION['mainAKtransactiontrns'] : '';
$mainAKtransactionhist = ( isset($_SESSION['mainAKtransactionhist']) ) ? $_SESSION['mainAKtransactionhist'] : '';
$mainAKtransactionclos = ( isset($_SESSION['mainAKtransactionclos']) ) ? $_SESSION['mainAKtransactionclos'] : '';
$mainAKtransactionrpid = ( isset($_SESSION['mainAKtransactionrpid']) ) ? $_SESSION['mainAKtransactionrpid'] : '';
$mainAKtransactionimpr = ( isset($_SESSION['mainAKtransactionimpr']) ) ? $_SESSION['mainAKtransactionimpr'] : '';

//untuk menu yang ada di aplikasi kpt management
$mainARtransactionloca = ( isset($_SESSION['mainARtransactionloca']) ) ? $_SESSION['mainARtransactionloca'] : '';
$mainARtransactionaddt = ( isset($_SESSION['mainARtransactionaddt']) ) ? $_SESSION['mainARtransactionaddt'] : '';
$mainARtransactionrpid = ( isset($_SESSION['mainARtransactionrpid']) ) ? $_SESSION['mainARtransactionrpid'] : '';
$mainARtransactionempl = ( isset($_SESSION['mainARtransactionempl']) ) ? $_SESSION['mainARtransactionempl'] : '';
$mainARtransactionrpal = ( isset($_SESSION['mainARtransactionrpal']) ) ? $_SESSION['mainARtransactionrpal'] : '';

//untuk menu yang ada di aplikasi insurance management
$mainEQtransactionempl = ( isset($_SESSION['mainEQtransactionempl']) ) ? $_SESSION['mainEQtransactionempl'] : '';
$mainEQtransactiontran = ( isset($_SESSION['mainEQtransactiontran']) ) ? $_SESSION['mainEQtransactiontran'] : '';
$mainEQtransactionrpid = ( isset($_SESSION['mainEQtransactionrpid']) ) ? $_SESSION['mainEQtransactionrpid'] : '';

//untuk menu yang ada logout
$logout = ( isset($_SESSION['logout']) ) ? $_SESSION['logout'] : '';

?>

<?php
if (!function_exists('base_url')) {
    function base_url($atRoot=FALSE, $atCore=FALSE, $parse=FALSE){
        if (isset($_SERVER['HTTP_HOST'])) {
            $http = isset($_SERVER['HTTPS']) && strtolower($_SERVER['HTTPS']) !== 'off' ? 'https' : 'http';
            $hostname = $_SERVER['HTTP_HOST'];
            $dir =  str_replace(basename($_SERVER['SCRIPT_NAME']), '', $_SERVER['SCRIPT_NAME']);
            $core = preg_split('@/@', str_replace($_SERVER['DOCUMENT_ROOT'], '', realpath(dirname(__FILE__))), NULL, PREG_SPLIT_NO_EMPTY);
            $core = $core[0];
            $tmplt = $atRoot ? ($atCore ? "%s://%s/%s/" : "%s://%s/") : ($atCore ? "%s://%s/%s/" : "%s://%s%s");
            $end = $atRoot ? ($atCore ? $core : $hostname) : ($atCore ? $core : $dir);
            $base_url = sprintf( $tmplt, $http, $hostname, $end );
        }
        else $base_url = 'http://localhost/';
        if ($parse) {
            $base_url = parse_url($base_url);
            if (isset($base_url['path'])) if ($base_url['path'] == '/') $base_url['path'] = '';
        }
        return $base_url;
    }
}
$base_url = base_url();

?>