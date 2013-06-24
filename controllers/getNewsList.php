<?php




// Vars /////////////////////////////////////////////////////////////////////////////////////////////// //
$page = $_POST['page'];
$page2 = $page-1;
$pageOffset = $page2*5;

class news {
	public $id;
	public $title;
	public $header;
	public $body;
	public $date;
	public $category;
	public $author;
	public $thumbPhotoUrl;
	public $headPhotoUrl;
}

$newsList = array();

$conn=mysqli_connect("serwer1309748.home.pl","serwer1309748_03","9!c3Q9","serwer1309748_03");
$conn2=mysqli_connect("serwer1309748.home.pl","serwer1309748_03","9!c3Q9","serwer1309748_03");
$conn3=mysqli_connect("serwer1309748.home.pl","serwer1309748_03","9!c3Q9","serwer1309748_03");
// //////////////////////////////////////////////////////////////////////////////////////////////////// //





// Count news ///////////////////////////////////////////////////////////////////////////////////////// //
if (mysqli_connect_errno())
	{
 		echo "Failed to connect to MySQL: " . mysqli_connect_error();
	}



$result = mysqli_query($conn,"SELECT COUNT(*) FROM news ");

while($row1 = mysqli_fetch_array($result))
	{
		$newsCount = $row1['COUNT(*)'];
		$pagesCount = $newsCount/5;
		$pagesCount = ceil($pagesCount);
	}
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
		$tempDate = $row1['date'];
		$news->date = substr($tempDate, 0, 16);
		$news->category = $row1['category'];
		$news->author = $row1['author'];
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
	mysqli_close($conn3);
	mysqli_close($conn2);
	mysqli_close($conn);
	// //////////////////////////////////////////////////////////////////////////////////////////////////// //
	
	
	
	
	
	
	// Output ///////////////////////////////////////////////////////////////////////////////////////////// //
	
	
	
	
	
	$i = $page;
	$iStart = $i;
	
		
		
		echo 	'<div id="newsPages1">
					<div class="prevPage">&#171</div>';
	
	
	
	switch($i) {
		case ($i == 1 && $pagesCount > 4):
			echo		'<div class="switchPage" id="p' . $i . '" style="border-bottom-style: solid; border-bottom-width: 2px; border-bottom-color: #d61180;">' . $i . '</div>';
			$i++;
			while($i <= 5) {
				echo		'<div class="switchPage" id="p' . $i . '">' . $i . '</div>';
			$i++;
			}
			break;
			
			
		case ($i == 1 && $pagesCount == 1):
			$i = 1;
			echo		'<div class="switchPage" id="p' . $i . '" style="border-bottom-style: solid; border-bottom-width: 2px; border-bottom-color: #d61180;">' . $i . '</div>';
			break;
			
			
		case ($i == 1 && $pagesCount == 2):
			$i = 1;
			echo		'<div class="switchPage" id="p' . $i . '" style="border-bottom-style: solid; border-bottom-width: 2px; border-bottom-color: #d61180;">' . $i . '</div>';
			$i++;
			echo		'<div class="switchPage" id="p' . $i . '">' . $i . '</div>';
			break;
			
			
		case ($i == 1 && $pagesCount == 3):
			$i = 1;
			echo		'<div class="switchPage" id="p' . $i . '" style="border-bottom-style: solid; border-bottom-width: 2px; border-bottom-color: #d61180;">' . $i . '</div>';
			$i++;
			echo		'<div class="switchPage" id="p' . $i . '">' . $i . '</div>';
			$i++;
			echo		'<div class="switchPage" id="p' . $i . '">' . $i . '</div>';
			break;	
				
				
		case ($i == 1 && $pagesCount == 4):
			$i = 1;
			echo		'<div class="switchPage" id="p' . $i . '" style="border-bottom-style: solid; border-bottom-width: 2px; border-bottom-color: #d61180;">' . $i . '</div>';
			$i++;
			echo		'<div class="switchPage" id="p' . $i . '">' . $i . '</div>';
			$i++;
			echo		'<div class="switchPage" id="p' . $i . '">' . $i . '</div>';
			$i++;
			echo		'<div class="switchPage" id="p' . $i . '">' . $i . '</div>';
			break;	
			
			
		case ($i == 2 && $pagesCount > 4):
			$i = 1;
			echo		'<div class="switchPage" id="p' . $i . '">' . $i . '</div>';
			$i++;
			echo		'<div class="switchPage" id="p' . $i . '" style="border-bottom-style: solid; border-bottom-width: 2px; border-bottom-color: #d61180;">' . $i . '</div>';
			$i++;
			while($i <= 5) {
				echo		'<div class="switchPage" id="p' . $i . '">' . $i . '</div>';
				$i++;
			}
			break;
			
			
		case ($i == 2 && $pagesCount == 2):
			$i = 1;
			echo		'<div class="switchPage" id="p' . $i . '">' . $i . '</div>';
			$i++;
			echo		'<div class="switchPage" id="p' . $i . '" style="border-bottom-style: solid; border-bottom-width: 2px; border-bottom-color: #d61180;">' . $i . '</div>';
			break;	
			
			
		case ($i == 2 && $pagesCount == 3):
			$i = 1;
			echo		'<div class="switchPage" id="p' . $i . '">' . $i . '</div>';
			$i++;
			echo		'<div class="switchPage" id="p' . $i . '" style="border-bottom-style: solid; border-bottom-width: 2px; border-bottom-color: #d61180;">' . $i . '</div>';
			$i++;
			echo		'<div class="switchPage" id="p' . $i . '">' . $i . '</div>';
			break;	
			
		case ($i == 2 && $pagesCount == 4):
			$i = 1;
			echo		'<div class="switchPage" id="p' . $i . '">' . $i . '</div>';
			$i++;
			echo		'<div class="switchPage" id="p' . $i . '" style="border-bottom-style: solid; border-bottom-width: 2px; border-bottom-color: #d61180;">' . $i . '</div>';
			$i++;
			echo		'<div class="switchPage" id="p' . $i . '">' . $i . '</div>';
			$i++;
			echo		'<div class="switchPage" id="p' . $i . '">' . $i . '</div>';
			break;
			
		case ($i == 3 && $pagesCount == 3):
			$i = 1;
			echo		'<div class="switchPage" id="p' . $i . '">' . $i . '</div>';
			$i++;
			echo		'<div class="switchPage" id="p' . $i . '">' . $i . '</div>';
			$i++;
			echo		'<div class="switchPage" id="p' . $i . '" style="border-bottom-style: solid; border-bottom-width: 2px; border-bottom-color: #d61180;">' . $i . '</div>';
			break;		
			
		case ($i == 3 && $pagesCount == 4):
			$i = 1;
			echo		'<div class="switchPage" id="p' . $i . '">' . $i . '</div>';
			$i++;
			echo		'<div class="switchPage" id="p' . $i . '">' . $i . '</div>';
			$i++;
			echo		'<div class="switchPage" id="p' . $i . '" style="border-bottom-style: solid; border-bottom-width: 2px; border-bottom-color: #d61180;">' . $i . '</div>';
			$i++;
			echo		'<div class="switchPage" id="p' . $i . '">' . $i . '</div>';
			break;	
			
			
		case ($i == 3 && $pagesCount > 4):
			$i = 1;
			echo		'<div class="switchPage" id="p' . $i . '">' . $i . '</div>';
			$i++;
			echo		'<div class="switchPage" id="p' . $i . '">' . $i . '</div>';
			$i++;
			echo		'<div class="switchPage" id="p' . $i . '" style="border-bottom-style: solid; border-bottom-width: 2px; border-bottom-color: #d61180;">' . $i . '</div>';
			$i++;
			echo		'<div class="switchPage" id="p' . $i . '">' . $i . '</div>';
			$i++;
			echo		'<div class="switchPage" id="p' . $i . '">' . $i . '</div>';
			break;		
			
			
			
		case ($i != 1 && $i != 2 && $i != $pagesCount && $i != $pagesCount-1 && $i < $pagesCount && $i < $pagesCount-1):
			$i = $i-2;
			echo		'<div class="switchPage" id="p' . $i . '">' . $i . '</div>';
			$i++;
			echo		'<div class="switchPage" id="p' . $i . '">' . $i . '</div>';
			$i++;
			echo		'<div class="switchPage" id="p' . $i . '" style="border-bottom-style: solid; border-bottom-width: 2px; border-bottom-color: #d61180;">' . $i . '</div>';
			$i++;
			echo		'<div class="switchPage" id="p' . $i . '">' . $i . '</div>';
			$i++;
			echo 		'<div class="switchPage" id="p' . $i . '">' . $i . '</div>';
			break;
			
			
		case ($i == $pagesCount-1 && $i < $pagesCount):
			$i = $i-3;
			while($i < $pagesCount-1) {
				echo		'<div class="switchPage" id="p' . $i . '">' . $i . '</div>';
				$i++;
			}
			echo 			'<div class="switchPage" id="p' . $i . '" style="border-bottom-style: solid; border-bottom-width: 2px; border-bottom-color: #d61180;">' . $i . '</div>';
			$i++;
			echo		'<div class="switchPage" id="p' . $i . '">' . $i . '</div>';
			break;
			
			
		case ($i == $pagesCount):
			$i = $i-4;
			while($i < $pagesCount) {
				echo		'<div class="switchPage" id="p' . $i . '">' . $i . '</div>';
				$i++;
			}
			echo 			'<div class="switchPage" id="p' . $i . '" style="border-bottom-style: solid; border-bottom-width: 2px; border-bottom-color: #d61180;">' . $i . '</div>';
			break;		
	}


	echo 		'<div class="nextPage" id="lastPage=' . $pagesCount . '">&#187</div>
				</div>';
	
	
	
	
	
	
	foreach($newsList as $news) {
		echo 	'<div class="newsBox" id="news' . $news->id . '">
					<div class="newsBoxImage"><a href="news.php?id=' . $news->id . '"><img src="' . $news->thumbPhotoUrl . '" width="200" height="200" /></a></div>
					<div class="newsBoxTitle"><a href="news.php?id=' . $news->id . '">' . $news->title . '</a></div>
					<div class="newsBoxInfo">' . $news->date . '   : ' . $news->category . '<br>'
					. '  przez: ' . $news->author . '</div>
					<div class="newsBoxHeader">' . $news->header . '</div>
					<div class="newsBoxMore"><a href="news.php?id=' . $news->id . '">+Więcej...</a></div>
					<div class="newsBoxMargin"></div>
				</div>';
	}
	
	
	
	
	$i = $page;
	$iStart = $i;
	
		
		
		echo 	'<div id="newsPages2">
					<div class="prevPage">&#171</div>';
	
	
	
	switch($i) {
		case ($i == 1 && $pagesCount > 4):
			echo		'<div class="switchPage" id="p' . $i . '" style="border-bottom-style: solid; border-bottom-width: 2px; border-bottom-color: #d61180;">' . $i . '</div>';
			$i++;
			while($i <= 5) {
				echo		'<div class="switchPage" id="p' . $i . '">' . $i . '</div>';
			$i++;
			}
			break;
			
			
		case ($i == 1 && $pagesCount == 1):
			$i = 1;
			echo		'<div class="switchPage" id="p' . $i . '" style="border-bottom-style: solid; border-bottom-width: 2px; border-bottom-color: #d61180;">' . $i . '</div>';
			break;
			
			
		case ($i == 1 && $pagesCount == 2):
			$i = 1;
			echo		'<div class="switchPage" id="p' . $i . '" style="border-bottom-style: solid; border-bottom-width: 2px; border-bottom-color: #d61180;">' . $i . '</div>';
			$i++;
			echo		'<div class="switchPage" id="p' . $i . '">' . $i . '</div>';
			break;
			
			
		case ($i == 1 && $pagesCount == 3):
			$i = 1;
			echo		'<div class="switchPage" id="p' . $i . '" style="border-bottom-style: solid; border-bottom-width: 2px; border-bottom-color: #d61180;">' . $i . '</div>';
			$i++;
			echo		'<div class="switchPage" id="p' . $i . '">' . $i . '</div>';
			$i++;
			echo		'<div class="switchPage" id="p' . $i . '">' . $i . '</div>';
			break;	
				
				
		case ($i == 1 && $pagesCount == 4):
			$i = 1;
			echo		'<div class="switchPage" id="p' . $i . '" style="border-bottom-style: solid; border-bottom-width: 2px; border-bottom-color: #d61180;">' . $i . '</div>';
			$i++;
			echo		'<div class="switchPage" id="p' . $i . '">' . $i . '</div>';
			$i++;
			echo		'<div class="switchPage" id="p' . $i . '">' . $i . '</div>';
			$i++;
			echo		'<div class="switchPage" id="p' . $i . '">' . $i . '</div>';
			break;	
			
			
		case ($i == 2 && $pagesCount > 4):
			$i = 1;
			echo		'<div class="switchPage" id="p' . $i . '">' . $i . '</div>';
			$i++;
			echo		'<div class="switchPage" id="p' . $i . '" style="border-bottom-style: solid; border-bottom-width: 2px; border-bottom-color: #d61180;">' . $i . '</div>';
			$i++;
			while($i <= 5) {
				echo		'<div class="switchPage" id="p' . $i . '">' . $i . '</div>';
				$i++;
			}
			break;
			
			
		case ($i == 2 && $pagesCount == 2):
			$i = 1;
			echo		'<div class="switchPage" id="p' . $i . '">' . $i . '</div>';
			$i++;
			echo		'<div class="switchPage" id="p' . $i . '" style="border-bottom-style: solid; border-bottom-width: 2px; border-bottom-color: #d61180;">' . $i . '</div>';
			break;	
			
			
		case ($i == 2 && $pagesCount == 3):
			$i = 1;
			echo		'<div class="switchPage" id="p' . $i . '">' . $i . '</div>';
			$i++;
			echo		'<div class="switchPage" id="p' . $i . '" style="border-bottom-style: solid; border-bottom-width: 2px; border-bottom-color: #d61180;">' . $i . '</div>';
			$i++;
			echo		'<div class="switchPage" id="p' . $i . '">' . $i . '</div>';
			break;	
			
		case ($i == 2 && $pagesCount == 4):
			$i = 1;
			echo		'<div class="switchPage" id="p' . $i . '">' . $i . '</div>';
			$i++;
			echo		'<div class="switchPage" id="p' . $i . '" style="border-bottom-style: solid; border-bottom-width: 2px; border-bottom-color: #d61180;">' . $i . '</div>';
			$i++;
			echo		'<div class="switchPage" id="p' . $i . '">' . $i . '</div>';
			$i++;
			echo		'<div class="switchPage" id="p' . $i . '">' . $i . '</div>';
			break;
			
		case ($i == 3 && $pagesCount == 3):
			$i = 1;
			echo		'<div class="switchPage" id="p' . $i . '">' . $i . '</div>';
			$i++;
			echo		'<div class="switchPage" id="p' . $i . '">' . $i . '</div>';
			$i++;
			echo		'<div class="switchPage" id="p' . $i . '" style="border-bottom-style: solid; border-bottom-width: 2px; border-bottom-color: #d61180;">' . $i . '</div>';
			break;		
			
		case ($i == 3 && $pagesCount == 4):
			$i = 1;
			echo		'<div class="switchPage" id="p' . $i . '">' . $i . '</div>';
			$i++;
			echo		'<div class="switchPage" id="p' . $i . '">' . $i . '</div>';
			$i++;
			echo		'<div class="switchPage" id="p' . $i . '" style="border-bottom-style: solid; border-bottom-width: 2px; border-bottom-color: #d61180;">' . $i . '</div>';
			$i++;
			echo		'<div class="switchPage" id="p' . $i . '">' . $i . '</div>';
			break;	
			
			
		case ($i == 3 && $pagesCount > 4):
			$i = 1;
			echo		'<div class="switchPage" id="p' . $i . '">' . $i . '</div>';
			$i++;
			echo		'<div class="switchPage" id="p' . $i . '">' . $i . '</div>';
			$i++;
			echo		'<div class="switchPage" id="p' . $i . '" style="border-bottom-style: solid; border-bottom-width: 2px; border-bottom-color: #d61180;">' . $i . '</div>';
			$i++;
			echo		'<div class="switchPage" id="p' . $i . '">' . $i . '</div>';
			$i++;
			echo		'<div class="switchPage" id="p' . $i . '">' . $i . '</div>';
			break;		
			
			
			
		case ($i != 1 && $i != 2 && $i != $pagesCount && $i != $pagesCount-1 && $i < $pagesCount && $i < $pagesCount-1):
			$i = $i-2;
			echo		'<div class="switchPage" id="p' . $i . '">' . $i . '</div>';
			$i++;
			echo		'<div class="switchPage" id="p' . $i . '">' . $i . '</div>';
			$i++;
			echo		'<div class="switchPage" id="p' . $i . '" style="border-bottom-style: solid; border-bottom-width: 2px; border-bottom-color: #d61180;">' . $i . '</div>';
			$i++;
			echo		'<div class="switchPage" id="p' . $i . '">' . $i . '</div>';
			$i++;
			echo 		'<div class="switchPage" id="p' . $i . '">' . $i . '</div>';
			break;
			
			
		case ($i == $pagesCount-1 && $i < $pagesCount):
			$i = $i-3;
			while($i < $pagesCount-1) {
				echo		'<div class="switchPage" id="p' . $i . '">' . $i . '</div>';
				$i++;
			}
			echo 			'<div class="switchPage" id="p' . $i . '" style="border-bottom-style: solid; border-bottom-width: 2px; border-bottom-color: #d61180;">' . $i . '</div>';
			$i++;
			echo		'<div class="switchPage" id="p' . $i . '">' . $i . '</div>';
			break;
			
			
		case ($i == $pagesCount):
			$i = $i-4;
			while($i < $pagesCount) {
				echo		'<div class="switchPage" id="p' . $i . '">' . $i . '</div>';
				$i++;
			}
			echo 			'<div class="switchPage" id="p' . $i . '" style="border-bottom-style: solid; border-bottom-width: 2px; border-bottom-color: #d61180;">' . $i . '</div>';
			break;		
	}


	echo 		'<div class="nextPage" id="lastPage=' . $pagesCount . '">&#187</div>
				</div>';
	
	
	
	
	// //////////////////////////////////////////////////////////////////////////////////////////////////// //
 

?>