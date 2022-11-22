<?php
	
$SFdate                 = date("Y-m-d");
$SFtime                 = date('h:i:s');
$SFdatetime             = date("Y-m-d H:i:s");
$SFyear                 = date("Y");
$SFnumber               = date("YmdHis");

/**
 *
 * '||''|.                            '||
 *  ||   ||    ....  .... ...   ....   ||    ...   ... ...  ... ..
 *  ||    || .|...||  '|.  |  .|...||  ||  .|  '|.  ||'  ||  ||' ''
 *  ||    || ||        '|.|   ||       ||  ||   ||  ||    |  ||
 * .||...|'   '|...'    '|     '|...' .||.  '|..|'  ||...'  .||.
 *                                                  ||
 * --------------- By Display:inline ------------- '''' -----------
 */
// $host 			= "localhost";
// $user 			= "root";
// $port 			= "3306";
// $pwd 			= "";
// $dbname 		= "loclahost";

$host 			= "localhost";
$user 			= "root";
$port 			= "3306";
$pwd 			= "";
$dbname 		= 'hris';
// $dbname 		= 'dbhr_sfbiznet_production';

/**
 *
 * '||''|.                            '||
 *  ||   ||    ....  .... ...   ....   ||    ...   ... ...  ... ..
 *  ||    || .|...||  '|.  |  .|...||  ||  .|  '|.  ||'  ||  ||' ''
 *  ||    || ||        '|.|   ||       ||  ||   ||  ||    |  ||
 * .||...|'   '|...'    '|     '|...' .||.  '|..|'  ||...'  .||.
 *                                                  ||
 * --------------- By Display:inline ------------- '''' -----------
 */
// $host 			= "localhost";
// $user 			= "root";
// $port 			= "3306";
// $pwd 			= "";
// $dbname 		= "hrdstudio_company_dbsfbiznet";

// $host 			= "presfst.com";
// $user 			= "presfstc_tm1";
// $port 			= "3306";
// $pwd 			= "1kMar2*72";
// $dbname 		= "presfstc_tm1";

/**
 *
 * '||''|.                            '||
 *  ||   ||    ....  .... ...   ....   ||    ...   ... ...  ... ..
 *  ||    || .|...||  '|.  |  .|...||  ||  .|  '|.  ||'  ||  ||' ''
 *  ||    || ||        '|.|   ||       ||  ||   ||  ||    |  ||
 * .||...|'   '|...'    '|     '|...' .||.  '|..|'  ||...'  .||.
 *                                                  ||
 * --------------- By Display:inline ------------- '''' -----------
 */
// $host 			= "localhost";
// $user 			= "gthrisco";
// $port 			= "3306";
// $pwd 			= "il!4Pj39";
// $dbname 		= "gthrisco_tm";

/**
 *
 * '||''|.                            '||
 *  ||   ||    ....  .... ...   ....   ||    ...   ... ...  ... ..
 *  ||    || .|...||  '|.  |  .|...||  ||  .|  '|.  ||'  ||  ||' ''
 *  ||    || ||        '|.|   ||       ||  ||   ||  ||    |  ||
 * .||...|'   '|...'    '|     '|...' .||.  '|..|'  ||...'  .||.
 *                                                  ||
 * --------------- By Display:inline ------------- '''' -----------
 */
// $host 			= "10.129.42.104";
// $user 			= "root";
// $port 			= "3306";
// $pwd 			= "123";
// $dbname 		= "dbHRIS_HR_GAJAHTUNGGAL";

/**
 *
 * '||''|.                            '||
 *  ||   ||    ....  .... ...   ....   ||    ...   ... ...  ... ..
 *  ||    || .|...||  '|.  |  .|...||  ||  .|  '|.  ||'  ||  ||' ''
 *  ||    || ||        '|.|   ||       ||  ||   ||  ||    |  ||
 * .||...|'   '|...'    '|     '|...' .||.  '|..|'  ||...'  .||.
 *                                                  ||
 * --------------- By Display:inline ------------- '''' -----------
 */
// $host 			= "10.132.80.137";
// $user 			= "admin";
// $port 			= "3306";
// $pwd 			= "Admin123";
// $dbname 		= "dbHRIS_HR_GAJAHTUNGGAL";



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
	

//echo $_SERVER['REMOTE_ADDR']/echo $platform/echo $bname/echo $version; 

		if ($bname == 'Internet Explorer'){
        echo"<script type='text/javascript'>
                window.location.replace('_u');   
            </script>";
		} elseif ($bname == 'NotSupport'){
		echo"<script type='text/javascript'>
					window.location.replace('_u');        
				</script>";
		}

// TOKEN
function getToken($val){
       $token = password_hash($val, PASSWORD_DEFAULT);
              return $token;
       }
$get_token = getToken('1');
// TOKEN

$pdo = new PDO('mysql:host='.$host.';dbname='.$dbname, $user, $pwd);

$connect = mysqli_connect($host, $user, $pwd, $dbname);
if (mysqli_connect_errno()){
	echo "we are sorry your connection is failed" . mysqli_connect_error();
}
error_reporting(0);

?>