<select class="input--style-6 modal_leave" name="sel_day_counts" style="width: 50%;height: 30px;" id="sel_day_counts">
  <?php
  include "../../../application/config.php";

  $rfid = $_GET['rfid'];
  $day_start = $_GET['day_start'];
  echo "<option value='$day_start'>" .   $day_start . "</option>";
  $find = mysqli_query($connect, "SELECT * FROM hrmttamshiftgroup WHERE shiftgroupcode ='$rfid'");
  while ($row = mysqli_fetch_array($find)) {
    for ($x = 1; $x <= $row['totaldays']; $x++) {
      echo "<option>" . $x . "</option>";
    }
  }
  ?>
</select>