<script type="text/javascript">
// Login ---------------------------------------------------- //
function grayout() {
	
		$('#grayout').css({"display":"none"});
		$('#loginForm').css({"display":"none"});
		
		$("#loginButton").click(function(){
			$('#grayout').css({"display":""});
			$('#loginForm').css({"display":""});
			// $("body").css("overflow", "hidden");
			resForm();
		});
		
		$("#grayout").click(function(){
			$('#grayout').css({"display":"none"});
			$('#loginForm').css({"display":"none"});
			
		});
		
		$('#fname').watermark("Wpisz adres email");
		$('#tbPassword').watermark("Wpisz hasło");
		$('#tbPassword2').watermark("Potwierdź hasło");
}
                    // ---------------------------------------------------------- //
</script>

<div id="userTopBar">
	<a id="loginButton">Logowanie</a><a id="registerButton">Rejestracja</a>
</div>