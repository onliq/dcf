<?php




// Vars /////////////////////////////////////////////////////////////////////////////////////////////// //
$newsId = $_GET['id'];
$conn=mysqli_connect("serwer1309748.home.pl","serwer1309748_03","9!c3Q9","serwer1309748_03");
$conn2=mysqli_connect("serwer1309748.home.pl","serwer1309748_03","9!c3Q9","serwer1309748_03");
// //////////////////////////////////////////////////////////////////////////////////////////////////// //







// Get news /////////////////////////////////////////////////////////////////////////////////////////// //
if (mysqli_connect_errno())
	{
 		echo "Failed to connect to MySQL: " . mysqli_connect_error();
	}



$result = mysqli_query($conn,"SELECT * FROM news WHERE id = '$newsId'");

while($row1 = mysqli_fetch_array($result))
	{
		$news->title = $row1['title'];
		$news->header = $row1['header'];
		$news->body = $row1['body'];
		$tempDate = $row1['date'];
		$news->date = substr($tempDate, 0, 16);
		$news->category = $row1['category'];
		$news->author = $row1['author'];
		$news->headPhotoUrl = $row1['headPhotoId'];
	}
// //////////////////////////////////////////////////////////////////////////////////////////////////// //	
	
	
	
	
	
// Get head photo url ///////////////////////////////////////////////////////////////////////////////// //		
		$headPhotoId = $news->headPhotoUrl;
		
		if (mysqli_connect_errno())
		  {
		  	echo "Failed to connect to MySQL: " . mysqli_connect_error();
		  }
		
		$result = mysqli_query($conn2,"SELECT np.url FROM newsPhotos AS np, news AS n WHERE np.id = n.headPhotoId AND n.headPhotoId = '$headPhotoId'");
		while($row2 = mysqli_fetch_array($result))
		  {
				$news->headPhotoUrl = $row2['url'];
		  }
	mysqli_close($conn2);
	mysqli_close($conn);
// //////////////////////////////////////////////////////////////////////////////////////////////////// //
	
	
	
	
	
// Output ///////////////////////////////////////////////////////////////////////////////////////////// //	

	echo	'<div class="newsHeadPhoto"><img class="newsHeadPhotoImage" src="' . $news->headPhotoUrl . '" /></div>
				<div class="newsTitle">' . $news->title . '</div>
				<div class="newsInfo">' . $news->date . '     ' . $news->category . '<br>przez:  ' . $news->author . '</div>
				<div class="newsHeader">' . $news->header . '</div>
				<div class="newsBody">' . $news->body . '</div>';
				
// //////////////////////////////////////////////////////////////////////////////////////////////////// //	


?>