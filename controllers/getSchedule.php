<?php




// Vars /////////////////////////////////////////////////////////////////////////////////////////////// //
$day = date('l', strtotime($_GET['date']));

switch($day){
	case($day == "Monday"):
		$day = "mon";
		break;
	case($day == "Tuesday"):
		$day = "tue";
		break;
	case($day == "Wednesday"):
		$day = "wed";
		break;
	case($day == "Thursday"):
		$day = "thu";
		break;
	case($day == "Friday"):
		$day = "fri";
		break;
	case($day == "Saturday"):
		$day = "sat";
		break;
	case($day == "Sunday"):
		$day = "sun";
		break;
}
$conn=mysqli_connect("serwer1309748.home.pl","serwer1309748_03","9!c3Q9","serwer1309748_03");
// //////////////////////////////////////////////////////////////////////////////////////////////////// //







// Get schedule /////////////////////////////////////////////////////////////////////////////////////// //
if (mysqli_connect_errno())
	{
 		echo "Failed to connect to MySQL: " . mysqli_connect_error();
	}


$result = mysqli_query($conn,"SELECT * FROM static_schedule WHERE  day = '$day' AND start >= '16:00:00' AND end <= '22:00:00' ORDER BY room, start");

if (!$result) {
    printf("Error: %s\n", mysqli_error($conn));
    exit();
}

while($e=mysqli_fetch_assoc($result))
              $output[]=$e;
           print(json_encode($output));
// //////////////////////////////////////////////////////////////////////////////////////////////////// //	


mysqli_close($conn);

?>