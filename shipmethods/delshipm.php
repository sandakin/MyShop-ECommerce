<?php

session_start();

$suser=$_SESSION['suser'];

include('database_connection.php');

$a=$_GET['shipm_ID'];

$sql = "DELETE FROM `shop`.`shipmethod` WHERE `shipmethod`.`shipm_ID` = '$a'";

if (!mysqli_query($bd, $sql))
  {
  die('Error: ' . mysqli_error($bd));
  }
echo "record updated";
 
mysqli_close($bd);
if($suser == 1) {
	header("location: ../shipmethods/shipmethods.php");
}else if($suser == 2) {
	header("location: ../shipmethods/shipmethods.php");
}
?>