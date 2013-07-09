<?php




// Vars /////////////////////////////////////////////////////////////////////////////////////////////// //

class instructor {
	public $id;
	public $name;
}

$instructorsList = array();

$conn=mysqli_connect("serwer1309748.home.pl","serwer1309748_03","9!c3Q9","serwer1309748_03");

// //////////////////////////////////////////////////////////////////////////////////////////////////// //




// Get instructors //////////////////////////////////////////////////////////////////////////////////// //

if (mysqli_connect_errno())
	{
 		echo "Failed to connect to MySQL: " . mysqli_connect_error();
	}



$result = mysqli_query($conn,"SELECT * FROM instructors ORDER BY name");

while($row1 = mysqli_fetch_array($result))
	{
		$instructor = new instructor;
		$instructor->id = $row1['id'];
		$instructor->name = $row1['name'];
		array_push($instructorsList, $instructor);
	}

	mysqli_close($conn);
// //////////////////////////////////////////////////////////////////////////////////////////////////// //
	
	
	
	
	
// Output ///////////////////////////////////////////////////////////////////////////////////////////// //
	
	echo ('<select id="selectInstructors">
			<option value="0">Wszyscy instruktorzy</option><option value="99">test</option>');
	foreach($instructorsList as $instructor) {
		echo ('<option value="' . $instructor->id . '">' . $instructor->name . '</option>');
	}
	echo ('</select>');
	
// //////////////////////////////////////////////////////////////////////////////////////////////////// //
 

?>