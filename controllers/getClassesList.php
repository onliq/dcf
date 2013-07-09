<?php




// Vars /////////////////////////////////////////////////////////////////////////////////////////////// //
if($_POST['instructorId'] != 0){
	$instructorId = $_POST['instructorId'];
	$instructorFilter = " WHERE instructorID = '$instructorId'";
}else{
	$instructorFilter = "";
}

class classes {
	public $id;
	public $name;
}

$classesList = array();

$conn=mysqli_connect("serwer1309748.home.pl","serwer1309748_03","9!c3Q9","serwer1309748_03");

// //////////////////////////////////////////////////////////////////////////////////////////////////// //




// Get instructors //////////////////////////////////////////////////////////////////////////////////// //

if (mysqli_connect_errno())
	{
 		echo "Failed to connect to MySQL: " . mysqli_connect_error();
	}



$result = mysqli_query($conn,"SELECT * FROM static_schedule" . $instructorFilter . " ORDER BY name");

while($row1 = mysqli_fetch_array($result))
	{
		$classes = new classes;
		$classes->id = $row1['id'];
		$classes->instructorId = $row1['instructorId'];
		$classes->name = $row1['name'];
		$classes->room = $row1['room'];
		array_push($classesList, $classes);
	}

	mysqli_close($conn);
// //////////////////////////////////////////////////////////////////////////////////////////////////// //
	
	
	
	
	
// Output ///////////////////////////////////////////////////////////////////////////////////////////// //
	
	echo ('<select id="selectClasses">
			<option value="0">Wszystkie zajęcia</option>');
	foreach($classesList as $classes) {
		echo ('<option value="' . $classes->id . '">' . $classes->name . '</option>');
	}
	echo ('</select>');
	
// //////////////////////////////////////////////////////////////////////////////////////////////////// //
 

?>