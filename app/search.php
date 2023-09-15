<?php
    session_start();
    require 'checkagain.php';
    include_once '../srdb.php';
    $sessionuserid = $_SESSION['usersessionid'];
    $search = $_POST["name"];
    $selectlevel = mysqli_query($con,"SELECT *  FROM `tbl_product` WHERE `Group` LIKE '%$search%'");
    while($fetchlevel = mysqli_fetch_array($selectlevel))
    {
        echo "<div>" . $fetchlevel["Group"] . "</div>";
    }
?>