<script type="text/javascript">
		// Login ---------------------------------------------------- //
			function grayout() {
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
			}
		// ---------------------------------------------------------- //
</script>

<div id="userTopBar">
	<a id="loginButton">Logowanie</a><a id="registerButton">Rejestracja</a>
</div>
