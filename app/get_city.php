<script src="dist/js/bootstrap-select.js"></script>

<?php
require_once "srdb.php";
if (!empty($_REQUEST["state_id"])) {
    $state = $_REQUEST["state_id"];
?>
    <div>
        <label for="inputName" class="col-sm-2 control-label">District<font color="red">&nbsp;*&nbsp;</font> </label>
        <div class="col-sm-4">

            <select class="form-control selectpicker" name="branchdict" id="groupNameTemp" onchange="getcity(this.value);" data-live-search="true" required>


                <?php
                $query = mysqli_query($con, "SELECT * FROM district WHERE State_Name = '$state'");
                ?>
                <option value="">Select District</option>
                <?php
                while ($row = mysqli_fetch_array($query)) {
                ?>
                    <option value="<?php echo $row["DistrictName"]; ?>"><?php echo $row["DistrictName"]; ?></option>
            <?php
                }
            }
            ?>

            <?php

            if (!empty($_REQUEST["city_id"])) {
                $state = $_REQUEST["city_id"];
            ?>
                <div>
                    <label for="inputName" class="col-sm-2 control-label">City<font color="red">&nbsp;*&nbsp;</font> </label>
                    <div class="col-sm-4">
                        <select class="form-control selectpicker" name="branchcity" onchange="getpin(this.value);" id="branchcity" data-live-search="true" required>
                            <option value="">Select Cities</option>
                            <?php
                            $select_GrpQry = mysqli_query($con, "select * from tbl_city where District='$state'");
                            while ($fetch_GrpQry = mysqli_fetch_array($select_GrpQry)) {

                                $CityName = $fetch_GrpQry['City'];
                            ?>
                                <option value="<?php echo $CityName; ?>"><?php echo $CityName; ?></option>
                            <?php
                            }
                            ?>
                        </select>
                    </div>
                </div>
            <?php
            }
            ?>

            <?php

            if (!empty($_REQUEST["pin_id"])) {
                $pin = $_REQUEST["pin_id"];
            ?>
                <div>
                    <?php
                    $select_GrpQry = mysqli_query($con, "select * from tbl_city where city='$pin'");
                    $fetch_GrpQry = mysqli_fetch_array($select_GrpQry);
                    $pin = $fetch_GrpQry['Pincode'];
                    ?>
                    <label for="inputName" class="col-sm-2 control-label">Pincode<font color="red">&nbsp;*&nbsp;</font> </label>
                    <div class="col-sm-4">
                        <input type="text" name="branchpin" class="form-control" value="<?php echo $pin; ?>" maxlength="6" onKeyUp="$(this).val($(this).val().replace(/[a-z`~!@#$%^&*()_|+\-=?;:,.'<>\{\}\[\]\\\/]/gi, ''))" placeholder="Branch Pincode" required>
                    </div>

                </div>
            <?php
            }
            ?>