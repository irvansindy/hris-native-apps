<?php
    include "../../../../application/session/sessionlv2.php";
    include "../../../../application/config.php";
    include "../../../model/st/GMLeaveSettingQuotaList.php";
?>

<table class="table table-bordered table-striped table-hover table-head-fixed">
    <thead>
        <tr>
            <th class="fontCustom" style="z-index: 1;" nowrap="nowrap">No</th>
			<th class="fontCustom" style="z-index: 1;">Shift Daily Code</th>
			<th class="fontCustom" style="z-index: 1;">Cost Code</th>
			<th class="fontCustom" style="z-index: 1;">Max Man Power/PIC</th>
			<th class="fontCustom" style="z-index: 1;">Status</th>
        </tr>
    </thead>
    <tbody>
        <?php
            $number = 0;
            $query_leave_group_setting = "SELECT * FROM hrmvalleavegroup ORDER BY id DESC";
            $var1 		= array('LIMIT 10, 0'); // untuk limit dihilangkan untuk mode excel MAKA DI REPLACE SAJA
            $var2 		= array('');
            $conversion 	= str_replace($var1, $var2, $query_leave_group_setting);
            $get_data = mysqli_query($connect, $conversion);
            while($fetch_data = mysqli_fetch_array($get_data)) {
                $number++;
            ?>
        
                <tr>
                    <td class="fontCustom"><?php echo $number; ?></td>
                    <td class='fontCustom'><?php echo $fetch_data["shiftdailycode"]; ?></td>
                    <td class='fontCustom'><?php echo $fetch_data["cost_code"]; ?></td>
                    <td class='fontCustom'><?php echo $fetch_data["max_manpower"]; ?></td>
                    <td class='fontCustom'><?php echo $fetch_data["active_status"] == '1' ? 'Active' : 'Inactive' ; ?></td>
                </tr>
        
        <?php } ?>
    </tbody>

</table>