<?php
date_default_timezone_set('Asia/Bangkok');
$serverName = "gttgr-hrs-data1";
$connectionInfo = array( "Database"=>"dbSF_BizNet_GAJAHTUNGGAL", "UID"=>"hris", "PWD"=>'Hr1sgt1234!!');
$conn = sqlsrv_connect( $serverName, $connectionInfo);

if( $conn ) {
     echo "Connection established.<br />";
}else{
     echo "Connection could not be established.<br />";
     die( print_r( sqlsrv_errors(), true));
}
?> 


<?php
$db_host2     = "10.129.64.25";
$db_user2     = "root";
$db_password2 = "Admin123";
$db_name2     = "db_flutterhris";
$db_connect2  = mysqli_connect($db_host2, $db_user2, $db_password2, $db_name2);
if (mysqli_connect_errno()) {
echo "Failed to connect to MySQL: " . mysqli_connect_error();
}
?> 


<?php
$usingdb = sqlsrv_query($conn, "use dbSF_BizNet_GAJAHTUNGGAL");
$mahasiswa = sqlsrv_query($conn, "WITH tmp(datagroup_id, access_code,DataItem,lsgroupmember) AS
(
    SELECT
        datagroup_id,
        access_code,
        CAST(LEFT(lsgroupmember, CHARINDEX(',', lsgroupmember + ',') - 1) AS INT),
        STUFF(lsgroupmember, 1, CHARINDEX(',', lsgroupmember + ','), '')
    FROM TCLRDATAACCESS 
    UNION all

    SELECT
        datagroup_id,
        access_code,
        CAST(LEFT(lsgroupmember, CHARINDEX(',', lsgroupmember + ',') - 1) as INT),
        STUFF(lsgroupmember, 1, CHARINDEX(',', lsgroupmember + ','), '')
    FROM tmp
    WHERE
        lsgroupmember > ''
)
       select DISTINCT
       a.emp_no,
       x1.full_name,
       left(a.cost_code,3) as cc,
       a.work_location_code,
       x2.user_id,
       x2.datagroup_id,
       --X4.access_code,
       x3.group_name as Authorized_User,
       X5.group_name as Authorized_Data_Group,
       X5.description,
       X5.sql_def
       from TEODEMPCOMPANY a
       left join TCLMUSER x on x.user_name = a.emp_no
       left join TEOMEMPPERSONAL x1 on x1.emp_id = a.emp_id
       left join TCLRGROUPADMIN x2 on x2.user_id = x.user_id
       left join TCLMDATAGROUP x3 on x3.datagroup_id = x2.datagroup_id
       left join tmp X4 on X4.datagroup_id = x3.datagroup_id
       left join TCLMDATAGROUP X5 on X5.datagroup_id = X4.DataItem
       where x2.user_id is not null
      	and a.emp_no = '13-0299'
       order by x2.user_id,x2.datagroup_id

");
while ($row = sqlsrv_fetch_array($mahasiswa)){



$SFnip    = $row["emp_no"];
$SFnme    = $row["full_name"];
$SFccs    = $row["cc"];
$SFwrk    = $row["work_location_code"];
$SFuid    = $row["user_id"];
$SFdtg    = $row["datagroup_id"];
$SFatg    = $row["Authorized_User"];
$SFgdt    = $row["Authorized_Data_Group"];
$SFdsc    = $row["description"];
$SFdef    = $row["sql_def"];

$today 	  = date("F j, Y, g:i a");


mysqli_query(
    $db_connect2,
    "INSERT INTO 
          `hrmgroupdata` 
               (
                    `datagroup_id`, 
                    `Authorized_User`, 
                    `access_code`, 
                    `DataItem`, 
                    `Authorized_Data_Group`, 
                    `description`, 
                    `sql_def`, 
                    `admin`
               ) 
                         VALUES 
                              (
                                   '$SFnip', 
                                   '1', 
                                   '1', 
                                   '1', 
                                   '1', 
                                   '1', 
                                   '1', 
                                   '1'
                              )

        "
  );
}
?>