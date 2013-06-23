<?php




// Vars /////////////////////////////////////////////////////////////////////////////////////////////// //
$page = $_POST['page'];
$page = $page-1;
$pageOffset = $page*5;

class news {
	public $id;
	public $title;
	public $header;
	public $body;
	public $date;
	public $category;
	public $thumbPhotoUrl;
	public $headPhotoUrl;
}

$newsList = array();

$conn=mysqli_connect("serwer1309748.home.pl","serwer1309748_03","9!c3Q9","serwer1309748_03");
$conn2=mysqli_connect("serwer1309748.home.pl","serwer1309748_03","9!c3Q9","serwer1309748_03");
// //////////////////////////////////////////////////////////////////////////////////////////////////// //




// Get news ///////////////////////////////////////////////////////////////////////////////////////// //

if (mysqli_connect_errno())
	{
 		echo "Failed to connect to MySQL: " . mysqli_connect_error();
	}



$result = mysqli_query($conn,"SELECT * FROM news ORDER BY date DESC LIMIT 5 OFFSET $pageOffset");

while($row1 = mysqli_fetch_array($result))
	{
		$news = new news;
  	 	$news->id = $row1['id'];
		$news->title = $row1['title'];
		$news->header = $row1['header'];
		$news->body = $row1['body'];
		$news->date = $row1['date'];
		$news->category = $row1['category'];
		$news->thumbPhotoUrl = $row1['thumbPhotoId'];
		$news->headPhotoUrl = $row1['headPhotoId'];
		array_push($newsList, $news);
	}
// //////////////////////////////////////////////////////////////////////////////////////////////////// //




	
	// Get photos urls //////////////////////////////////////////////////////////////////////////////////// //
	foreach($newsList as $news) {
		
		$headPhotoId = $news->headPhotoUrl;
		$thumbPhotoId = $news->thumbPhotoUrl;
		
		if (mysqli_connect_errno())
		  {
		  	echo "Failed to connect to MySQL: " . mysqli_connect_error();
		  }
		
		$result = mysqli_query($conn2,"SELECT np.url FROM newsPhotos AS np, news AS n WHERE np.id = n.headPhotoId AND n.headPhotoId = '$headPhotoId'");
		$result2 = mysqli_query($conn2,"SELECT np.url FROM newsPhotos AS np, news AS n WHERE np.id = n.thumbPhotoId AND n.thumbPhotoId = '$thumbPhotoId'");
		while($row2 = mysqli_fetch_array($result))
		  {
				$news->headPhotoUrl = $row2['url'];
		  }
		  while($row2 = mysqli_fetch_array($result2))
		  {
				$news->thumbPhotoUrl = $row2['url'];
		  }
		
	}
	mysqli_close($conn2);
	mysqli_close($conn);
	// //////////////////////////////////////////////////////////////////////////////////////////////////// //
	
	
	
	
	
	
	// Output ///////////////////////////////////////////////////////////////////////////////////////////// //
	
	foreach($newsList as $news) {
		echo 	'<div class="newsBox" id="news' . $news->id . '">
					<div class="newsImage"><img src="' . $news->thumbPhotoUrl . '" width="200" height="200" /></div>
					<div class="newsTitle">' . $news->title . '</div>
					<div class="newsInfo">' . $news->date . '  ' . $news->category . '</div>
					<div class="newsHeader">' . $news->header . '</div>
					<div class="newsMore">+Wiecej...</div>
					<div class="newsMargin"></div>
				</div>';
	}
	
	// //////////////////////////////////////////////////////////////////////////////////////////////////// //
 

?>