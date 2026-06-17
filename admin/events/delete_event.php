<?php
include("../includes/auth_check.php");
include("../../config/db.php");

$id=$_GET['id'];
mysqli_query($conn,"DELETE FROM events WHERE id=$id");
header("Location: view_events.php");
