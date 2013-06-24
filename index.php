<!DOCTYPE html>
<html>
	<head>
		
		<!-- Links ------------------------------------------------------------------ -->
		<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script>
		<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
		<script type="text/javascript" src="src/coin-slider.min.js"></script>
		<script type="text/javascript" src="src/jquery.watermark.min.js"></script>
		<link rel="stylesheet" type="text/css" href="template/style.css">
		<link rel="stylesheet" href="template/coin-slider-styles.css" type="text/css" />
		<meta http-equiv="Content-Type" content="text/plain; charset=utf-8" />
		<!-- ------------------------------------------------------------------------ -->
		
		
		
	</head>
	
	
	<body>
		<!-- Include userStatus ----------------------------------------------------- -->
		<?php include 'views/userStatus.php'; ?>
		<!-- ------------------------------------------------------------------------ -->
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
		<!-- Include loginForm ------------------------------------------------------ -->
		<?php include 'views/loginForm.php'; ?>
		<!-- ------------------------------------------------------------------------ -->
	</body>
	
</html>

<!-- Login -->
<script type="text/javascript">

	$(document).ready(function(){
		
		$('#grayout').css({"display":"none"});
		$('#loginForm').css({"display":"none"});
		
		$("#loginButton").click(function(){
			$('#grayout').css({"display":""});
			$('#loginForm').css({"display":""});
		});
		
		$("#grayout").click(function(){
			$('#grayout').css({"display":"none"});
			$('#loginForm').css({"display":"none"});
		});
		$('#fname').watermark("Wpisz login");
		$('#tbPassword').watermark("Wpisz hasło");
		$('#tbPassword2').watermark("Potwierdź hasło");
	});
</script>
<!-- -->
