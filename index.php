<!DOCTYPE html>
<html>
	<head>
		
		<!-- Links ------------------------------------------------------------------ -->
		<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script>
		<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
		<script type="text/javascript" src="src/coin-slider.min.js"></script>
		<link rel="stylesheet" type="text/css" href="template/style.css">
		<link rel="stylesheet" href="template/coin-slider-styles.css" type="text/css" />
		<!-- ------------------------------------------------------------------------ -->
		
		<!-- Navigation buttons animation (old) ------------------------------------- -->
		<script type="text/javascript">
			$(document).ready(function(){
				$(".navButtonUnderlight").hide();
				// $(".navButton").hover(function(){
					// // $(".navButtonUnderlight").hide();
					// var id = $(this).children(".navButtonUnderlight").attr("id");
					// $("#" + id).stop(true, false).fadeIn(200);
				// },
				// function(){
					// var id = $(this).children(".navButtonUnderlight").attr("id");
					// $("#" + id).stop(true, false).fadeOut();
				// });
			});
		</script>
		<!-- ------------------------------------------------------------------------ -->
		
	</head>
	
	
	<body>
		<!-- Include header --------------------------------------------------------- -->
		<?php include 'views/header.php'; ?>
		<!-- ------------------------------------------------------------------------ -->
		<div id="grid">
			<!-- Include left column ---------------------------------------------------- -->
			<?php include 'views/leftCol.php'; ?>
			<!-- ------------------------------------------------------------------------ -->
			<!-- Include right column --------------------------------------------------- -->
			<?php include 'views/rightCol.php'; ?>
			<!-- ------------------------------------------------------------------------ -->
			<!-- Include footer --------------------------------------------------------- -->
			<?php include 'views/footer.php'; ?>
			<!-- ------------------------------------------------------------------------ -->
		</div>
	</body>
	
</html>

