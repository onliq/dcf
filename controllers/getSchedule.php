<?php




// Vars /////////////////////////////////////////////////////////////////////////////////////////////// //
$day = date('l', strtotime($_GET['date']));
$scheduleMode = $_GET['scheduleMode'];



// if (isset($_GET['room'])){
	// $room = $_GET['room'];
	// $filterByRoom = " AND room = '$room'";
// }else{
	// $filterByRoom ="";
// }

if (isset($_GET['instructor'])){
	$instructor = $_GET['instructor'];
	$filterByInstructor = " AND i.name = '$instructor'";
}else{
	$filterByInstructor ="";
}

if (isset($_GET['classes'])){
	$classes = $_GET['classes'];
	$filterByClasses = " AND sts.name = '$classes'";
}else{
	$filterByClasses = "";
}



switch($scheduleMode){
	case($scheduleMode == "normal"):
		$start = "16:00:00";
		$end = "22:00:00";
		break;
	case($scheduleMode == "extended"):
		$start = "09:00:00";
		$end = "22:00:00";
		break;
}

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


$result = mysqli_query($conn,"SELECT sts.id, sts.day, sts.start, sts.end, sts.name, sts.room, sts.instructorId, i.name AS iName 
							FROM static_schedule AS sts, instructors AS i 
							WHERE sts.instructorId = i.id AND sts.day = '$day' AND sts.start >= '$start' AND sts.end <= '$end'"
							 . $filterByInstructor . $filterByClasses .
							 " ORDER BY sts.room, sts.start ");
			 
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