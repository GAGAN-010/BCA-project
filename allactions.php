<?php
session_start(); 
include 'connects.php';
if(isset($_POST['btnsubmit']))
{
	
$cid=test_input($_POST['cid']);
$chkprice=test_input($_POST['chkprice']);
$chkqty=test_input($_POST['chkqty']);	
$mysqli=connectdb();
$query = "INSERT INTO cart(cid,chkqty,cprice,email) VALUES(?,?,?,?)";
$statement = $mysqli->prepare($query);
//bind parameters for markers, where (s = string, i = integer, d = double,  b = blob)
$statement->bind_param('ssss',$cid,$chkprice,$chkqty,$_SESSION['USER']);
if($statement->execute())
{
echo '<script type="text/javascript">window.location="cart.php";</script>';	
}
else
{
echo '<script type="text/javascript">alert("Error... in registration try again!") ;  window.history.back();</script>';
}
$statement->close();
}	



function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
?>