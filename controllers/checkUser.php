<?php

$email= $_POST['email'];
$conn=mysqli_connect("serwer1309748.home.pl","serwer1309748_03","9!c3Q9","serwer1309748_03");

$returnValue = null;






// Get news /////////////////////////////////////////////////////////////////////////////////////////// //
if (mysqli_connect_errno())
	{
 		echo "Failed to connect to MySQL: " . mysqli_connect_error();
	}



$result = mysqli_query($conn,"SELECT * FROM users WHERE email = '$email'");
		while($e = mysqli_fetch_array($result))
		  {
				$returnValue = $e['email'];
		  }
print($returnValue);
?>
