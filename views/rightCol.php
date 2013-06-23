

<!-- Functions -------------------------------------------------------------- -->
<script type="text/javascript">
// Check hashtag -------------------------------------------- //
	function getHashtag(){
		if(window.location.hash) {
      		var hash = window.location.hash.substring(1);
  		} else {
  			var hash = 1;
  		}
  		return hash;
	}	
// ---------------------------------------------------------- //	

// Load news ------------------------------------------------ //
	function loadNews(page){
		$.ajax({
				url: "controllers/getNews.php",
				type: "POST",
				data: "page=" + page,
				cache: false
				}).done(function(data) {
		  		$("#newsContainer").html(data);
			});
	}
// ---------------------------------------------------------- //	

// Switch page ---------------------------------------------- //
	function switchPage(){
		$(".switchPage").click(function(){
			var page = $(this).attr("id");
			page = page.substr(1,3);
			window.location.hash = page;
			loadNews(page);
		});
	}
// ---------------------------------------------------------- //	


</script>
<!-- ------------------------------------------------------------------------ -->	






<!-- Page load -------------------------------------------------------------- -->
<script type="text/javascript">
	$(document).ready(function(){
		loadNews(getHashtag());
		switchPage();
	})
</script>
<!-- ------------------------------------------------------------------------ -->	







<div id="rightCol">
	
	<!-- Include Coin Slider ---------------------------------------------------- -->
	<?php include 'coinSlider.php'; ?>
	
	<!-- ------------------------------------------------------------------------ -->

	<div id="newsPages1">
		<div class="switchPage" id="p1">1  </div>
		<div class="switchPage" id="p2">2  </div>
	</div>
	<div id="newsLoadScreen">
		<div id="newsContainer"></div>
	</div>
	
	<div id="newsPages2">
		<div class="switchPage" id="p1">1  </div>
		<div class="switchPage" id="p2">2  </div>
	</div>
	
</div>