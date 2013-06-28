<script type="text/javascript">
// Login ---------------------------------------------------- //
function grayout() {
	
		$('#grayout').css({"display":"none"});
		$('#registerForm').css({"display":"none"});
		
		$("#registerButton").click(function(){
			$('#grayout').css({"display":""});
			$('#registerForm').css({"display":""});
			// $("body").css("overflow", "hidden");
			resForm();
		});
		
		$("#grayout").click(function(){
			$('#grayout').css({"display":"none"});
			$('#registerForm').css({"display":"none"});
			
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