<!DOCTYPE html>
<html>
	<head>
		
		<!-- Include links ---------------------------------------------------------- -->
		<?php include 'include/links.php'; ?>
		<!-- ------------------------------------------------------------------------ -->
		
		
		
		
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
						url: "controllers/getNewsList.php",
						type: "POST",
						data: "page=" + page,
						cache: false
						}).done(function(data) {
				  		$(".newsBoxContainer").html(data);
				  		$(".switchPage").on("click", switchPage())
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
				var hash = getHashtag();
				$(".nextPage").click(function(){
					var lastPage = $(this).attr("id");
					lastPage = lastPage.substr(9,3);
					var page = parseInt(hash);
					if (page == lastPage) {
						
					} else {
						page++;
						window.location.hash = page;
						loadNews(page);
					}
				});
				$(".prevPage").click(function(){
					var page = parseInt(hash);
					if(page > 1) {
					page--;
					window.location.hash = page;
					loadNews(page);
					} else {};
				});
			}
		// ---------------------------------------------------------- //	
		</script>
		<!-- ------------------------------------------------------------------------ -->	
		
		
		
		
		<!-- Page load -------------------------------------------------------------- -->
		<script type="text/javascript">
			$(document).ready(function(){
				grayout();
				
				var checkPage = getHashtag();
				if (checkPage > $("#nextPage").attr("id")) {
					window.location.hash = page;
					loadNews(page);
				} else {
					window.location.hash = 1;
					loadNews(1);
					switchPage();
				}
				$("#datePicker").DatePickerShow();
			})
		</script>
		<!-- ------------------------------------------------------------------------ -->	
		
		
		
		
	</head>
	
	
	<body>
		<!-- Include userStatus ----------------------------------------------------- -->
		<?php include 'include/userStatus.php'; ?>
		<!-- ------------------------------------------------------------------------ -->
		<!-- Include loginForm ------------------------------------------------------ -->
		<?php include 'include/registerForm.php'; ?>
		<!-- ------------------------------------------------------------------------ -->
		<!-- Include header --------------------------------------------------------- -->
		<?php include 'include/header.php'; ?>
		<!-- ------------------------------------------------------------------------ -->
		<div id="grid">
			
			
			<div id="leftCol">
				<div id="datePicker"></div>
			</div>
			

		
		<div id="rightCol">
			
			<!-- Include Coin Slider ---------------------------------------------------- -->
			<?php include 'include/coinSlider.php'; ?>
			
			<!-- ------------------------------------------------------------------------ -->
		
			<!-- <div id="newsPages1">
				<div class="switchPage" id="p1">1  </div>
				<div class="switchPage" id="p2">2  </div>
			</div> -->
			<div id="newsLoadScreen">
				<div class="newsBoxContainer"></div>
			</div>
			
			<!-- <div id="newsPages2">
				<div class="switchPage" id="p1">1  </div>
				<div class="switchPage" id="p2">2  </div>
			</div> -->
			
		</div>
			<!-- Include footer --------------------------------------------------------- -->
			<?php include 'include/footer.php'; ?>
			<!-- ------------------------------------------------------------------------ -->
		</div>
		
	</body>
	
</html>