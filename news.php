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
				<!-- <div id="leftMenu">
					<img src="template/img/leftMenu.png" />
				</div> -->
			</div>
			
			
			<div id="rightCol">
				
				<div class="newsContainer">
					<div class="news">
						<!-- Include news ----------------------------------------------------------- -->
						<?php include 'controllers/getNews.php'; ?>
						<!-- ------------------------------------------------------------------------ -->
						<!-- <div class="newsHeadPhoto">
							<img src="photos/slider4.png" />
						</div>
						<div class="newsTitle">
							Lorem ipsum dolor sit amet, consectetur adipiscing elit.
						</div>
						<div class="newsInfo">
							2013-06-19 09:40:00 bangers<br>
							przez: danceoffnia
						</div>
						<div class="newsHeader">
							Fusce pharetra varius consequat. Etiam consectetur porta erat, eu euismod dolor dictum id. Mauris ullamcorper lectus lorem, varius laoreet nisi placerat at. Aliquam tempor tempor mauris, vitae varius massa. Aliquam felis ipsum, eleifend.
						</div>
						<div class="newsBody">
							Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam sed risus sit amet nunc malesuada faucibus.  				Suspendisse porttitor et ligula non bibendum. Mauris aliquet consectetur bibendum. Maecenas sagittis neque nibh, eu ullamcorper  				tellus vehicula vel. Pellentesque vehicula, elit sed vestibulum blandit, justo lectus imperdiet eros, at rhoncus libero libero  				nec ligula. Morbi luctus, dui ut hendrerit pellentesque, nisi tellus Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam sed risus sit amet nunc malesuada faucibus.  				Suspendisse porttitor et ligula non bibendum. Mauris aliquet consectetur bibendum. Maecenas sagittis neque nibh, eu ullamcorper  				tellus vehicula vel. Pellentesque vehicula, elit sed vestibulum blandit, justo lectus imperdiet eros, at rhoncus libero libero  				nec ligula. Morbi luctus, dui ut hendrerit pellentesque, nisi tellus Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam sed risus sit amet nunc malesuada faucibus.  				Suspendisse porttitor et ligula non bibendum. Mauris aliquet consectetur bibendum. Maecenas sagittis neque nibh, eu ullamcorper  				tellus vehicula vel. Pellentesque vehicula, elit sed vestibulum blandit, justo lectus imperdiet eros, at rhoncus libero libero  				nec ligula. Morbi luctus, dui ut hendrerit pellentesque, nisi tellus Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam sed risus sit amet nunc malesuada faucibus.  				Suspendisse porttitor et ligula non bibendum. Mauris aliquet consectetur bibendum. Maecenas sagittis neque nibh, eu ullamcorper  				tellus vehicula vel. Pellentesque vehicula, elit sed vestibulum blandit, justo lectus imperdiet eros, at rhoncus libero libero  				nec ligula. Morbi luctus, dui ut hendrerit pellentesque, nisi tellus Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam sed risus sit amet nunc malesuada faucibus.  				Suspendisse porttitor et ligula non bibendum. Mauris aliquet consectetur bibendum. Maecenas sagittis neque nibh, eu ullamcorper  				tellus vehicula vel. Pellentesque vehicula, elit sed vestibulum blandit, justo lectus imperdiet eros, at rhoncus libero libero  				nec ligula. Morbi luctus, dui ut hendrerit pellentesque, nisi tellus Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam sed risus sit amet nunc malesuada faucibus.  				Suspendisse porttitor et ligula non bibendum. Mauris aliquet consectetur bibendum. Maecenas sagittis neque nibh, eu ullamcorper  				tellus vehicula vel. Pellentesque vehicula, elit sed vestibulum blandit, justo lectus imperdiet eros, at rhoncus libero libero  				nec ligula. Morbi luctus, dui ut hendrerit pellentesque, nisi tellus Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam sed risus sit amet nunc malesuada faucibus.  				Suspendisse porttitor et ligula non bibendum. Mauris aliquet consectetur bibendum. Maecenas sagittis neque nibh, eu ullamcorper  				tellus vehicula vel. Pellentesque vehicula, elit sed vestibulum blandit, justo lectus imperdiet eros, at rhoncus libero libero  				nec ligula. Morbi luctus, dui ut hendrerit pellentesque, nisi tellus Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam sed risus sit amet nunc malesuada faucibus.  				Suspendisse porttitor et ligula non bibendum. Mauris aliquet consectetur bibendum. Maecenas sagittis neque nibh, eu ullamcorper  				tellus vehicula vel. Pellentesque vehicula, elit sed vestibulum blandit, justo lectus imperdiet eros, at rhoncus libero libero  				nec ligula. Morbi luctus, dui ut hendrerit pellentesque, nisi tellus 
						</div> -->
					</div>
				</div>
				
			</div>
			
			
			<!-- Include footer --------------------------------------------------------- -->
			<?php include 'include/footer.php'; ?>
			<!-- ------------------------------------------------------------------------ -->
		</div>
	</body>
	
</html>

