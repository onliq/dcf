<!DOCTYPE html>
<html>
	<head>
		
		<!-- Include links ---------------------------------------------------------- -->
		<?php include 'include/links.php'; ?>
		<!-- ------------------------------------------------------------------------ -->
		<!-- Include userStatus ----------------------------------------------------- -->
		<?php include 'include/userStatus.php'; ?>
		<!-- ------------------------------------------------------------------------ -->
		<!-- Include loginForm ------------------------------------------------------ -->
		<?php include 'include/loginForm.php'; ?>
		<!-- ------------------------------------------------------------------------ -->

	<!-- Page load -------------------------------------------------------------- -->
	<script type="text/javascript">
		$(document).ready(function(){
			grayout();
		})
	</script>
	<!-- ------------------------------------------------------------------------ -->	
	</head>
	
	
	<body>
		
		<!-- Include header --------------------------------------------------------- -->
		<?php include 'include/header.php'; ?>
		<!-- ------------------------------------------------------------------------ -->
		<div id="grid">
			
			
			<div id="leftCol">
				
			</div>
			
			
			<div id="rightCol">
				
				<div class="newsContainer">
					<div class="news">
						<!-- Include news ----------------------------------------------------------- -->
						<?php include 'controllers/getNews.php'; ?>
						<!-- ------------------------------------------------------------------------ -->
					</div>
				</div>
				
			</div>
			
			
			<!-- Include footer --------------------------------------------------------- -->
			<?php include 'include/footer.php'; ?>
			<!-- ------------------------------------------------------------------------ -->
		</div>
	</body>
	
</html>
