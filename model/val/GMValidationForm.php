<?php 
$qListVal_JS1           = mysqli_query($connect, "SELECT 
                                                        javascript 
                                                 FROM hrmmenu 
                                                 WHERE 
                                                        menu_id       = '$page'");
if(mysqli_num_rows($qListVal_JS1) > 0){
       $qListVal_JS1_r         = mysqli_fetch_array($qListVal_JS1);
              $field_script_JS1         = $qListVal_JS1_r['javascript'];
}
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
$qListVal1           = mysqli_query($connect, "SELECT 
                                                        * 
                                                 FROM mgtools_valform 
                                                 WHERE 
                                                        menu_id       = '$page' AND
                                                        id_valmenu    = '1'");
if(mysqli_num_rows($qListVal1) > 0){
       $qListVal1_r                       = mysqli_fetch_array($qListVal1);
              $field_name1                = $qListVal1_r['field_name'];
              if($qListVal1_r['required_field'] == 'Y'){
                     $field_required1     = 'required="required"';
                     $field_flag1         = '<span>*</span>';
              } else {
                     $field_required1     = '"';
                     $field_flag1         = '<span>*</span>';
              }
}
$qListVal2           = mysqli_query($connect, "SELECT 
                                                        * 
                                                 FROM mgtools_valform 
                                                 WHERE 
                                                        menu_id       = '$page' AND
                                                        id_valmenu    = '2'");
if(mysqli_num_rows($qListVal2) > 0){
       $qListVal2_r                       = mysqli_fetch_array($qListVal2);
              $field_name2                = $qListVal2_r['field_name'];
              if($qListVal2_r['required_field'] == 'Y'){
                     $field_required2     = 'required="required"';
                     $field_flag2         = '<span>*</span>';
              } else {
                     $field_required2     = '"';
                     $field_flag2         = '<span>*</span>';
              }
}
$qListVal3           = mysqli_query($connect, "SELECT 
                                                        * 
                                                 FROM mgtools_valform 
                                                 WHERE 
                                                        menu_id       = '$page' AND
                                                        id_valmenu    = '3'");
if(mysqli_num_rows($qListVal3) > 0){
       $qListVal3_r                       = mysqli_fetch_array($qListVal3);
              $field_name3                = $qListVal3_r['field_name'];
              if($qListVal3_r['required_field'] == 'Y'){
                     $field_required3     = 'required="required"';
                     $field_flag3         = '<span>*</span>';
              } else {
                     $field_required3     = '"';
                     $field_flag3         = '<span>*</span>';
              }
}
$qListVal4           = mysqli_query($connect, "SELECT 
                                                        * 
                                                 FROM mgtools_valform 
                                                 WHERE 
                                                        menu_id       = '$page' AND
                                                        id_valmenu    = '4'");
if(mysqli_num_rows($qListVal4) > 0){
       $qListVal4_r                       = mysqli_fetch_array($qListVal4);
              $field_name4                = $qListVal4_r['field_name'];
              if($qListVal4_r['required_field'] == 'Y'){
                     $field_required4     = 'required="required"';
                     $field_flag4         = '<span>*</span>';
              } else {
                     $field_required4     = '"';
                     $field_flag4         = '<span>**</span>';
              }
}
$qListVal5           = mysqli_query($connect, "SELECT 
                                                        * 
                                                 FROM mgtools_valform 
                                                 WHERE 
                                                        menu_id       = '$page' AND
                                                        id_valmenu    = '5'");
if(mysqli_num_rows($qListVal5) > 0){
       $qListVal5_r                       = mysqli_fetch_array($qListVal5);
              $field_name5                = $qListVal5_r['field_name'];
              if($qListVal5_r['required_field'] == 'Y'){
                     $field_required5     = 'required="required"';
                     $field_flag5         = '<span>*</span>';
              } else {
                     $field_required5     = '"';
                     $field_flag5         = '<span>**</span>';
              }
}
$qListVal6           = mysqli_query($connect, "SELECT 
                                                        * 
                                                 FROM mgtools_valform 
                                                 WHERE 
                                                        menu_id       = '$page' AND
                                                        id_valmenu    = '6'");
if(mysqli_num_rows($qListVal6) > 0){
       $qListVal6_r                       = mysqli_fetch_array($qListVal6);
              $field_name6                = $qListVal6_r['field_name'];
              if($qListVal6_r['required_field'] == 'Y'){
                     $field_required6     = 'required="required"';
                     $field_flag6         = '<span>*</span>';
              } else {
                     $field_required6     = '"';
                     $field_flag6         = '<span>**</span>';
              }
}

$qListVal7           = mysqli_query($connect, "SELECT 
                                                        * 
                                                 FROM mgtools_valform 
                                                 WHERE 
                                                        menu_id       = '$page' AND
                                                        id_valmenu    = '7'");
if(mysqli_num_rows($qListVal7) > 0){
       $qListVal7_r                       = mysqli_fetch_array($qListVal7);
              $field_name7                = $qListVal7_r['field_name'];
              if($qListVal7_r['required_field'] == 'Y'){
                     $field_required7     = 'required="required"';
                     $field_flag7         = '<span>*</span>';
              } else {
                     $field_required7     = '"';
                     $field_flag7         = '<span>**</span>';
              }
}
$qListVal8           = mysqli_query($connect, "SELECT 
                                                        * 
                                                 FROM mgtools_valform 
                                                 WHERE 
                                                        menu_id       = '$page' AND
                                                        id_valmenu    = '8'");
if(mysqli_num_rows($qListVal8) > 0){
       $qListVal8_r                       = mysqli_fetch_array($qListVal8);
              $field_name8                = $qListVal8_r['field_name'];
              if($qListVal8_r['required_field'] == 'Y'){
                     $field_required8     = 'required="required"';
                     $field_flag8         = '<span>*</span>';
              } else {
                     $field_required8     = '"';
                     $field_flag8         = '<span>**</span>';
              }
}

$qListVal9           = mysqli_query($connect, "SELECT 
                                                        * 
                                                 FROM mgtools_valform 
                                                 WHERE 
                                                        menu_id       = '$page' AND
                                                        id_valmenu    = '9'");
if(mysqli_num_rows($qListVal9) > 0){
       $qListVal9_r                       = mysqli_fetch_array($qListVal9);
              $field_name9                = $qListVal9_r['field_name'];
              if($qListVal9_r['required_field'] == 'Y'){
                     $field_required9     = 'required="required"';
                     $field_flag9         = '<span>*</span>';
              } else {
                     $field_required9     = '"';
                     $field_flag9         = '<span>**</span>';
              }
}

$qListVal10           = mysqli_query($connect, "SELECT 
                                                        * 
                                                 FROM mgtools_valform 
                                                 WHERE 
                                                        menu_id       = '$page' AND
                                                        id_valmenu    = '10'");
if(mysqli_num_rows($qListVal10) > 0){
       $qListVal10_r                       = mysqli_fetch_array($qListVal10);
              $field_name10                = $qListVal10_r['field_name'];
              if($qListVal10_r['required_field'] == 'Y'){
                     $field_required10     = 'required="required"';
                     $field_flag10         = '<span>*</span>';
              } else {
                     $field_required10     = '"';
                     $field_flag10         = '<span>**</span>';
              }
}

$qListVal11           = mysqli_query($connect, "SELECT 
                                                        * 
                                                 FROM mgtools_valform 
                                                 WHERE 
                                                        menu_id       = '$page' AND
                                                        id_valmenu    = '11'");
if(mysqli_num_rows($qListVal11) > 0){
       $qListVal11_r                       = mysqli_fetch_array($qListVal11);
              $field_name11                = $qListVal11_r['field_name'];
              if($qListVal11_r['required_field'] == 'Y'){
                     $field_required11     = 'required="required"';
                     $field_flag11         = '<span>*</span>';
              } else {
                     $field_required11     = '"';
                     $field_flag11         = '<span>**</span>';
              }
}

$qListVal12           = mysqli_query($connect, "SELECT 
                                                        * 
                                                 FROM mgtools_valform 
                                                 WHERE 
                                                        menu_id       = '$page' AND
                                                        id_valmenu    = '12'");
if(mysqli_num_rows($qListVal12) > 0){
       $qListVal12_r                       = mysqli_fetch_array($qListVal12);
              $field_name12                = $qListVal12_r['field_name'];
              if($qListVal12_r['required_field'] == 'Y'){
                     $field_required12     = 'required="required"';
                     $field_flag12         = '<span>*</span>';
              } else {
                     $field_required12     = '"';
                     $field_flag12         = '<span>**</span>';
              }
}

$qListVal13           = mysqli_query($connect, "SELECT 
                                                        * 
                                                 FROM mgtools_valform 
                                                 WHERE 
                                                        menu_id       = '$page' AND
                                                        id_valmenu    = '13'");
if(mysqli_num_rows($qListVal13) > 0){
       $qListVal13_r                       = mysqli_fetch_array($qListVal13);
              $field_name13                = $qListVal13_r['field_name'];
              if($qListVal13_r['required_field'] == 'Y'){
                     $field_required13     = 'required="required"';
                     $field_flag13         = '<span>*</span>';
              } else {
                     $field_required13     = '"';
                     $field_flag13         = '<span>**</span>';
              }
}

$qListVal14           = mysqli_query($connect, "SELECT 
                                                        * 
                                                 FROM mgtools_valform 
                                                 WHERE 
                                                        menu_id       = '$page' AND
                                                        id_valmenu    = '14'");
if(mysqli_num_rows($qListVal14) > 0){
       $qListVal14_r                       = mysqli_fetch_array($qListVal14);
              $field_name14                = $qListVal14_r['field_name'];
              if($qListVal14_r['required_field'] == 'Y'){
                     $field_required14     = 'required="required"';
                     $field_flag14         = '<span>*</span>';
              } else {
                     $field_required14     = '"';
                     $field_flag14         = '<span>**</span>';
              }
}

$qListVal15           = mysqli_query($connect, "SELECT 
                                                        * 
                                                 FROM mgtools_valform 
                                                 WHERE 
                                                        menu_id       = '$page' AND
                                                        id_valmenu    = '15'");
if(mysqli_num_rows($qListVal15) > 0){
       $qListVal15_r                       = mysqli_fetch_array($qListVal15);
              $field_name15                = $qListVal15_r['field_name'];
              if($qListVal15_r['required_field'] == 'Y'){
                     $field_required15     = 'required="required"';
                     $field_flag15         = '<span>*</span>';
              } else {
                     $field_required15     = '"';
                     $field_flag15         = '<span>**</span>';
              }
}

$qListVal16           = mysqli_query($connect, "SELECT 
                                                        * 
                                                 FROM mgtools_valform 
                                                 WHERE 
                                                        menu_id       = '$page' AND
                                                        id_valmenu    = '16'");
if(mysqli_num_rows($qListVal16) > 0){
       $qListVal16_r                       = mysqli_fetch_array($qListVal16);
              $field_name16                = $qListVal16_r['field_name'];
              if($qListVal16_r['required_field'] == 'Y'){
                     $field_required16     = 'required="required"';
                     $field_flag16         = '<span>*</span>';
              } else {
                     $field_required16     = '"';
                     $field_flag16         = '<span>**</span>';
              }
}

$qListVal17           = mysqli_query($connect, "SELECT 
                                                        * 
                                                 FROM mgtools_valform 
                                                 WHERE 
                                                        menu_id       = '$page' AND
                                                        id_valmenu    = '17'");
if(mysqli_num_rows($qListVal17) > 0){
       $qListVal17_r                       = mysqli_fetch_array($qListVal17);
              $field_name17                = $qListVal17_r['field_name'];
              if($qListVal17_r['required_field'] == 'Y'){
                     $field_required17     = 'required="required"';
                     $field_flag17         = '<span>*</span>';
              } else {
                     $field_required17     = '"';
                     $field_flag17         = '<span>**</span>';
              }
}

$qListVal18           = mysqli_query($connect, "SELECT 
                                                        * 
                                                 FROM mgtools_valform 
                                                 WHERE 
                                                        menu_id       = '$page' AND
                                                        id_valmenu    = '18'");
if(mysqli_num_rows($qListVal18) > 0){
       $qListVal18_r                       = mysqli_fetch_array($qListVal18);
              $field_name18                = $qListVal18_r['field_name'];
              if($qListVal18_r['required_field'] == 'Y'){
                     $field_required18     = 'required="required"';
                     $field_flag18         = '<span>*</span>';
              } else {
                     $field_required18     = '"';
                     $field_flag18         = '<span>**</span>';
              }
}

$qListVal19           = mysqli_query($connect, "SELECT 
                                                        * 
                                                 FROM mgtools_valform 
                                                 WHERE 
                                                        menu_id       = '$page' AND
                                                        id_valmenu    = '19'");
if(mysqli_num_rows($qListVal19) > 0){
       $qListVal19_r                       = mysqli_fetch_array($qListVal19);
              $field_name19                = $qListVal19_r['field_name'];
              if($qListVal19_r['required_field'] == 'Y'){
                     $field_required19     = 'required="required"';
                     $field_flag19         = '<span>*</span>';
              } else {
                     $field_required19     = '"';
                     $field_flag19         = '<span>**</span>';
              }
}

$qListVal20           = mysqli_query($connect, "SELECT 
                                                        * 
                                                 FROM mgtools_valform 
                                                 WHERE 
                                                        menu_id       = '$page' AND
                                                        id_valmenu    = '20'");
if(mysqli_num_rows($qListVal20) > 0){
       $qListVal20_r                       = mysqli_fetch_array($qListVal20);
              $field_name20                = $qListVal20_r['field_name'];
              if($qListVal20_r['required_field'] == 'Y'){
                     $field_required20     = 'required="required"';
                     $field_flag20         = '<span>*</span>';
              } else {
                     $field_required20     = '"';
                     $field_flag20         = '<span>**</span>';
              }
}

$qListVal21           = mysqli_query($connect, "SELECT 
                                                        * 
                                                 FROM mgtools_valform 
                                                 WHERE 
                                                        menu_id       = '$page' AND
                                                        id_valmenu    = '21'");
if(mysqli_num_rows($qListVal21) > 0){
       $qListVal21_r                       = mysqli_fetch_array($qListVal21);
              $field_name21                = $qListVal21_r['field_name'];
              if($qListVal21_r['required_field'] == 'Y'){
                     $field_required21     = 'required="required"';
                     $field_flag21         = '<span>*</span>';
              } else {
                     $field_required21     = '"';
                     $field_flag21         = '<span>**</span>';
              }
}

$qListVal22           = mysqli_query($connect, "SELECT 
                                                        * 
                                                 FROM mgtools_valform 
                                                 WHERE 
                                                        menu_id       = '$page' AND
                                                        id_valmenu    = '22'");
if(mysqli_num_rows($qListVal22) > 0){
       $qListVal22_r                       = mysqli_fetch_array($qListVal22);
              $field_name22                = $qListVal22_r['field_name'];
              if($qListVal22_r['required_field'] == 'Y'){
                     $field_required22     = 'required="required"';
                     $field_flag22         = '<span>*</span>';
              } else {
                     $field_required22     = '"';
                     $field_flag22         = '<span>**</span>';
              }
}

$qListVal23           = mysqli_query($connect, "SELECT 
                                                        * 
                                                 FROM mgtools_valform 
                                                 WHERE 
                                                        menu_id       = '$page' AND
                                                        id_valmenu    = '23'");
if(mysqli_num_rows($qListVal23) > 0){
       $qListVal23_r                       = mysqli_fetch_array($qListVal23);
              $field_name23                = $qListVal23_r['field_name'];
              if($qListVal23_r['required_field'] == 'Y'){
                     $field_required23     = 'required="required"';
                     $field_flag23         = '<span>*</span>';
              } else {
                     $field_required23     = '"';
                     $field_flag23         = '<span>**</span>';
              }
}

$qListVal24           = mysqli_query($connect, "SELECT 
                                                        * 
                                                 FROM mgtools_valform 
                                                 WHERE 
                                                        menu_id       = '$page' AND
                                                        id_valmenu    = '24'");
if(mysqli_num_rows($qListVal24) > 0){
       $qListVal24_r                       = mysqli_fetch_array($qListVal24);
              $field_name24                = $qListVal24_r['field_name'];
              if($qListVal24_r['required_field'] == 'Y'){
                     $field_required24     = 'required="required"';
                     $field_flag24         = '<span>*</span>';
              } else {
                     $field_required24     = '"';
                     $field_flag24         = '<span>**</span>';
              }
}

$qListVal25           = mysqli_query($connect, "SELECT 
                                                        * 
                                                 FROM mgtools_valform 
                                                 WHERE 
                                                        menu_id       = '$page' AND
                                                        id_valmenu    = '25'");
if(mysqli_num_rows($qListVal25) > 0){
       $qListVal25_r                       = mysqli_fetch_array($qListVal25);
              $field_name25                = $qListVal25_r['field_name'];
              if($qListVal25_r['required_field'] == 'Y'){
                     $field_required25     = 'required="required"';
                     $field_flag25         = '<span>*</span>';
              } else {
                     $field_required25     = '"';
                     $field_flag25         = '<span>**</span>';
              }
}

$qListVal26           = mysqli_query($connect, "SELECT 
                                                        * 
                                                 FROM mgtools_valform 
                                                 WHERE 
                                                        menu_id       = '$page' AND
                                                        id_valmenu    = '26'");
if(mysqli_num_rows($qListVal26) > 0){
       $qListVal26_r                       = mysqli_fetch_array($qListVal26);
              $field_name26                = $qListVal26_r['field_name'];
              if($qListVal26_r['required_field'] == 'Y'){
                     $field_required26     = 'required="required"';
                     $field_flag26         = '<span>*</span>';
              } else {
                     $field_required26     = '"';
                     $field_flag26         = '<span>**</span>';
              }
}

$qListVal27           = mysqli_query($connect, "SELECT 
                                                        * 
                                                 FROM mgtools_valform 
                                                 WHERE 
                                                        menu_id       = '$page' AND
                                                        id_valmenu    = '27'");
if(mysqli_num_rows($qListVal27) > 0){
       $qListVal27_r                       = mysqli_fetch_array($qListVal27);
              $field_name27                = $qListVal27_r['field_name'];
              if($qListVal27_r['required_field'] == 'Y'){
                     $field_required27     = 'required="required"';
                     $field_flag27         = '<span>*</span>';
              } else {
                     $field_required27     = '"';
                     $field_flag27         = '<span>**</span>';
              }
}

$qListVal28           = mysqli_query($connect, "SELECT 
                                                        * 
                                                 FROM mgtools_valform 
                                                 WHERE 
                                                        menu_id       = '$page' AND
                                                        id_valmenu    = '28'");
if(mysqli_num_rows($qListVal28) > 0){
       $qListVal28_r                       = mysqli_fetch_array($qListVal28);
              $field_name28                = $qListVal28_r['field_name'];
              if($qListVal28_r['required_field'] == 'Y'){
                     $field_required28     = 'required="required"';
                     $field_flag28         = '<span>*</span>';
              } else {
                     $field_required28     = '"';
                     $field_flag28         = '<span>**</span>';
              }
}

$qListVal29           = mysqli_query($connect, "SELECT 
                                                        * 
                                                 FROM mgtools_valform 
                                                 WHERE 
                                                        menu_id       = '$page' AND
                                                        id_valmenu    = '29'");
if(mysqli_num_rows($qListVal29) > 0){
       $qListVal29_r                       = mysqli_fetch_array($qListVal29);
              $field_name29                = $qListVal29_r['field_name'];
              if($qListVal29_r['required_field'] == 'Y'){
                     $field_required29     = 'required="required"';
                     $field_flag29         = '<span>*</span>';
              } else {
                     $field_required29     = '"';
                     $field_flag29         = '<span>**</span>';
              }
}

$qListVal30           = mysqli_query($connect, "SELECT 
                                                        * 
                                                 FROM mgtools_valform 
                                                 WHERE 
                                                        menu_id       = '$page' AND
                                                        id_valmenu    = '30'");
if(mysqli_num_rows($qListVal30) > 0){
       $qListVal30_r                       = mysqli_fetch_array($qListVal30);
              $field_name30                = $qListVal30_r['field_name'];
              if($qListVal30_r['required_field'] == 'Y'){
                     $field_required30     = 'required="required"';
                     $field_flag30         = '<span>*</span>';
              } else {
                     $field_required30     = '"';
                     $field_flag30         = '<span>**</span>';
              }
}

$qListVal31           = mysqli_query($connect, "SELECT 
                                                        * 
                                                 FROM mgtools_valform 
                                                 WHERE 
                                                        menu_id       = '$page' AND
                                                        id_valmenu    = '31'");
if(mysqli_num_rows($qListVal31) > 0){
       $qListVal31_r                       = mysqli_fetch_array($qListVal31);
              $field_name31                = $qListVal31_r['field_name'];
              if($qListVal31_r['required_field'] == 'Y'){
                     $field_required31     = 'required="required"';
                     $field_flag31         = '<span>*</span>';
              } else {
                     $field_required31     = '"';
                     $field_flag31         = '<span>**</span>';
              }
}

$qListVal32           = mysqli_query($connect, "SELECT 
                                                        * 
                                                 FROM mgtools_valform 
                                                 WHERE 
                                                        menu_id       = '$page' AND
                                                        id_valmenu    = '32'");
if(mysqli_num_rows($qListVal32) > 0){
       $qListVal32_r                       = mysqli_fetch_array($qListVal32);
              $field_name32                = $qListVal32_r['field_name'];
              if($qListVal32_r['required_field'] == 'Y'){
                     $field_required32     = 'required="required"';
                     $field_flag32         = '<span>*</span>';
              } else {
                     $field_required32     = '"';
                     $field_flag32         = '<span>**</span>';
              }
}

$qListVal33           = mysqli_query($connect, "SELECT 
                                                        * 
                                                 FROM mgtools_valform 
                                                 WHERE 
                                                        menu_id       = '$page' AND
                                                        id_valmenu    = '33'");
if(mysqli_num_rows($qListVal33) > 0){
       $qListVal33_r                       = mysqli_fetch_array($qListVal33);
              $field_name33                = $qListVal33_r['field_name'];
              if($qListVal33_r['required_field'] == 'Y'){
                     $field_required33     = 'required="required"';
                     $field_flag33         = '<span>*</span>';
              } else {
                     $field_required33     = '"';
                     $field_flag33         = '<span>**</span>';
              }
}

$qListVal34           = mysqli_query($connect, "SELECT 
                                                        * 
                                                 FROM mgtools_valform 
                                                 WHERE 
                                                        menu_id       = '$page' AND
                                                        id_valmenu    = '34'");
if(mysqli_num_rows($qListVal34) > 0){
       $qListVal34_r                       = mysqli_fetch_array($qListVal34);
              $field_name34                = $qListVal34_r['field_name'];
              if($qListVal34_r['required_field'] == 'Y'){
                     $field_required34     = 'required="required"';
                     $field_flag34         = '<span>*</span>';
              } else {
                     $field_required34     = '"';
                     $field_flag34         = '<span>**</span>';
              }
}

$qListVal35           = mysqli_query($connect, "SELECT 
                                                        * 
                                                 FROM mgtools_valform 
                                                 WHERE 
                                                        menu_id       = '$page' AND
                                                        id_valmenu    = '35'");
if(mysqli_num_rows($qListVal35) > 0){
       $qListVal35_r                       = mysqli_fetch_array($qListVal35);
              $field_name35                = $qListVal35_r['field_name'];
              if($qListVal35_r['required_field'] == 'Y'){
                     $field_required35     = 'required="required"';
                     $field_flag35         = '<span>*</span>';
              } else {
                     $field_required35     = '"';
                     $field_flag35         = '<span>**</span>';
              }
}

$qListVal36           = mysqli_query($connect, "SELECT 
                                                        * 
                                                 FROM mgtools_valform 
                                                 WHERE 
                                                        menu_id       = '$page' AND
                                                        id_valmenu    = '36'");
if(mysqli_num_rows($qListVal36) > 0){
       $qListVal36_r                       = mysqli_fetch_array($qListVal36);
              $field_name36                = $qListVal36_r['field_name'];
              if($qListVal36_r['required_field'] == 'Y'){
                     $field_required36     = 'required="required"';
                     $field_flag36         = '<span>*</span>';
              } else {
                     $field_required36     = '"';
                     $field_flag36         = '<span>**</span>';
              }
}

$qListVal37           = mysqli_query($connect, "SELECT 
                                                        * 
                                                 FROM mgtools_valform 
                                                 WHERE 
                                                        menu_id       = '$page' AND
                                                        id_valmenu    = '37'");
if(mysqli_num_rows($qListVal37) > 0){
       $qListVal37_r                       = mysqli_fetch_array($qListVal37);
              $field_name37                = $qListVal37_r['field_name'];
              if($qListVal37_r['required_field'] == 'Y'){
                     $field_required37     = 'required="required"';
                     $field_flag37         = '<span>*</span>';
              } else {
                     $field_required37     = '"';
                     $field_flag37         = '<span>**</span>';
              }
}

$qListVal38           = mysqli_query($connect, "SELECT 
                                                        * 
                                                 FROM mgtools_valform 
                                                 WHERE 
                                                        menu_id       = '$page' AND
                                                        id_valmenu    = '38'");
if(mysqli_num_rows($qListVal38) > 0){
       $qListVal38_r                       = mysqli_fetch_array($qListVal38);
              $field_name38                = $qListVal38_r['field_name'];
              if($qListVal38_r['required_field'] == 'Y'){
                     $field_required38     = 'required="required"';
                     $field_flag38         = '<span>*</span>';
              } else {
                     $field_required38     = '"';
                     $field_flag38         = '<span>**</span>';
              }
}

$qListVal39           = mysqli_query($connect, "SELECT 
                                                        * 
                                                 FROM mgtools_valform 
                                                 WHERE 
                                                        menu_id       = '$page' AND
                                                        id_valmenu    = '39'");
if(mysqli_num_rows($qListVal39) > 0){
       $qListVal39_r                       = mysqli_fetch_array($qListVal39);
              $field_name39                = $qListVal39_r['field_name'];
              if($qListVal39_r['required_field'] == 'Y'){
                     $field_required39     = 'required="required"';
                     $field_flag39         = '<span>*</span>';
              } else {
                     $field_required39     = '"';
                     $field_flag39         = '<span>**</span>';
              }
}

$qListVal40           = mysqli_query($connect, "SELECT 
                                                        * 
                                                 FROM mgtools_valform 
                                                 WHERE 
                                                        menu_id       = '$page' AND
                                                        id_valmenu    = '40'");
if(mysqli_num_rows($qListVal40) > 0){
       $qListVal40_r                       = mysqli_fetch_array($qListVal40);
              $field_name40                = $qListVal40_r['field_name'];
              if($qListVal40_r['required_field'] == 'Y'){
                     $field_required40     = 'required="required"';
                     $field_flag40         = '<span>*</span>';
              } else {
                     $field_required40     = '"';
                     $field_flag40         = '<span>**</span>';
              }
}

$qListVal41           = mysqli_query($connect, "SELECT 
                                                        * 
                                                 FROM mgtools_valform 
                                                 WHERE 
                                                        menu_id       = '$page' AND
                                                        id_valmenu    = '41'");
if(mysqli_num_rows($qListVal41) > 0){
       $qListVal41_r                       = mysqli_fetch_array($qListVal41);
              $field_name41                = $qListVal41_r['field_name'];
              if($qListVal41_r['required_field'] == 'Y'){
                     $field_required41     = 'required="required"';
                     $field_flag41         = '<span>*</span>';
              } else {
                     $field_required41     = '"';
                     $field_flag41         = '<span>**</span>';
              }
}

$qListVal42           = mysqli_query($connect, "SELECT 
                                                        * 
                                                 FROM mgtools_valform 
                                                 WHERE 
                                                        menu_id       = '$page' AND
                                                        id_valmenu    = '42'");
if(mysqli_num_rows($qListVal42) > 0){
       $qListVal42_r                       = mysqli_fetch_array($qListVal42);
              $field_name42                = $qListVal42_r['field_name'];
              if($qListVal42_r['required_field'] == 'Y'){
                     $field_required42     = 'required="required"';
                     $field_flag42         = '<span>*</span>';
              } else {
                     $field_required42     = '"';
                     $field_flag42         = '<span>**</span>';
              }
}

$qListVal43           = mysqli_query($connect, "SELECT 
                                                        * 
                                                 FROM mgtools_valform 
                                                 WHERE 
                                                        menu_id       = '$page' AND
                                                        id_valmenu    = '43'");
if(mysqli_num_rows($qListVal43) > 0){
       $qListVal43_r                       = mysqli_fetch_array($qListVal43);
              $field_name43                = $qListVal43_r['field_name'];
              if($qListVal43_r['required_field'] == 'Y'){
                     $field_required43     = 'required="required"';
                     $field_flag43         = '<span>*</span>';
              } else {
                     $field_required43     = '"';
                     $field_flag43         = '<span>**</span>';
              }
}

$qListVal44           = mysqli_query($connect, "SELECT 
                                                        * 
                                                 FROM mgtools_valform 
                                                 WHERE 
                                                        menu_id       = '$page' AND
                                                        id_valmenu    = '44'");
if(mysqli_num_rows($qListVal44) > 0){
       $qListVal44_r                       = mysqli_fetch_array($qListVal44);
              $field_name44                = $qListVal44_r['field_name'];
              if($qListVal44_r['required_field'] == 'Y'){
                     $field_required44     = 'required="required"';
                     $field_flag44         = '<span>*</span>';
              } else {
                     $field_required44     = '"';
                     $field_flag44         = '<span>**</span>';
              }
}

$qListVal45           = mysqli_query($connect, "SELECT 
                                                        * 
                                                 FROM mgtools_valform 
                                                 WHERE 
                                                        menu_id       = '$page' AND
                                                        id_valmenu    = '45'");
if(mysqli_num_rows($qListVal45) > 0){
       $qListVal45_r                       = mysqli_fetch_array($qListVal45);
              $field_name45                = $qListVal45_r['field_name'];
              if($qListVal45_r['required_field'] == 'Y'){
                     $field_required45     = 'required="required"';
                     $field_flag45         = '<span>*</span>';
              } else {
                     $field_required45     = '"';
                     $field_flag45         = '<span>**</span>';
              }
}

$qListVal46           = mysqli_query($connect, "SELECT 
                                                        * 
                                                 FROM mgtools_valform 
                                                 WHERE 
                                                        menu_id       = '$page' AND
                                                        id_valmenu    = '46'");
if(mysqli_num_rows($qListVal46) > 0){
       $qListVal46_r                       = mysqli_fetch_array($qListVal46);
              $field_name46                = $qListVal46_r['field_name'];
              if($qListVal46_r['required_field'] == 'Y'){
                     $field_required46     = 'required="required"';
                     $field_flag46         = '<span>*</span>';
              } else {
                     $field_required46     = '"';
                     $field_flag46         = '<span>**</span>';
              }
}

$qListVal47           = mysqli_query($connect, "SELECT 
                                                        * 
                                                 FROM mgtools_valform 
                                                 WHERE 
                                                        menu_id       = '$page' AND
                                                        id_valmenu    = '47'");
if(mysqli_num_rows($qListVal47) > 0){
       $qListVal47_r                       = mysqli_fetch_array($qListVal47);
              $field_name47                = $qListVal47_r['field_name'];
              if($qListVal47_r['required_field'] == 'Y'){
                     $field_required47     = 'required="required"';
                     $field_flag47         = '<span>*</span>';
              } else {
                     $field_required47     = '"';
                     $field_flag47         = '<span>**</span>';
              }
}

$qListVal48           = mysqli_query($connect, "SELECT 
                                                        * 
                                                 FROM mgtools_valform 
                                                 WHERE 
                                                        menu_id       = '$page' AND
                                                        id_valmenu    = '48'");
if(mysqli_num_rows($qListVal48) > 0){
       $qListVal48_r                       = mysqli_fetch_array($qListVal48);
              $field_name48                = $qListVal48_r['field_name'];
              if($qListVal48_r['required_field'] == 'Y'){
                     $field_required48     = 'required="required"';
                     $field_flag48         = '<span>*</span>';
              } else {
                     $field_required48     = '"';
                     $field_flag48         = '<span>**</span>';
              }
}

$qListVal49           = mysqli_query($connect, "SELECT 
                                                        * 
                                                 FROM mgtools_valform 
                                                 WHERE 
                                                        menu_id       = '$page' AND
                                                        id_valmenu    = '49'");
if(mysqli_num_rows($qListVal49) > 0){
       $qListVal49_r                       = mysqli_fetch_array($qListVal49);
              $field_name49                = $qListVal49_r['field_name'];
              if($qListVal49_r['required_field'] == 'Y'){
                     $field_required49     = 'required="required"';
                     $field_flag49         = '<span>*</span>';
              } else {
                     $field_required49     = '"';
                     $field_flag49         = '<span>**</span>';
              }
}

$qListVal50           = mysqli_query($connect, "SELECT 
                                                        * 
                                                 FROM mgtools_valform 
                                                 WHERE 
                                                        menu_id       = '$page' AND
                                                        id_valmenu    = '50'");
if(mysqli_num_rows($qListVal50) > 0){
       $qListVal50_r                       = mysqli_fetch_array($qListVal50);
              $field_name50                = $qListVal50_r['field_name'];
              if($qListVal50_r['required_field'] == 'Y'){
                     $field_required50     = 'required="required"';
                     $field_flag50         = '<span>*</span>';
              } else {
                     $field_required50     = '"';
                     $field_flag50         = '<span>**</span>';
              }
}
?>