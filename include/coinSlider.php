<!-- Coin slider script ----------------------------------------------------- -->
		<script type="text/javascript">
		$(document).ready(function() {
			$('#coin-slider').coinslider({
				width: 722, // width of slider panel
				height: 268, // height of slider panel
				spw: 7, // squares per width
				sph: 5, // squares per height
				delay: 5000, // delay between images in ms
				sDelay: 8, // delay beetwen squares in ms
				opacity: 0.8, // opacity of title and navigation
				titleSpeed: 500, // speed of title appereance in ms
				effect: 'random', // random, swirl, rain, straight
				navigation: true, // prev next and buttons
				links : true, // show images as links
				hoverPause: true // pause on hover
			});
		});
		</script>
<!-- ------------------------------------------------------------------------ -->		
		
		
<div id="coinSliderContainer">
	<div id='coin-slider'>
		<a href="dance-icon.png" target="_blank">
			<img src='photos/slider1.png' >
			<span>
				Lorem ipsum dolor sit amet.
			</span>	
		</a>
		<a href="imgN_url">
			<img src='photos/slider2.png' >
			<span>
				Fusce pharetra varius consequat.
			</span>
		</a>
		<a href="imgN_url">
			<img src='photos/slider3.png' >
			<span>
				Sit amet varius consequat.
			</span>
		</a>
		<a href="imgN_url">
			<img src='photos/slider4.png' >
			<span>
				Fusce pharetra varius consequat.
			</span>
		</a>
	</div>
</div>