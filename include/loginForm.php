<div id="grayout">
</div>
<div id="loginForm">
		<form id="logValForm" method="post">
			<p class="formLabel">Email:</p>
			<input type="email" class="formTextbox" id="fname" name="fname" >
			<br>
				<a class="formInfo" id="fname_label"></a>
			<br>
			<p class="formLabel">Hasło:</p>
			<input type="password" class="formTextbox" id="tbPassword" name="tbPassword" >
			<br>
				<a class="formInfo" id="tbPassword_label"></a>
			<br>
			<p class="formLabel">Potwierdź hasło:</p>
			<input type="password" class="formTextbox" id="tbPassword2" name ="tbPassword2" >
			<br>
				<a class="formInfo" id="tbPassword2_label"></a>
			<br>
			<input type="submit" value="Zaloguj" class="formButton">
		</form>
</div>


<script>
var validate = $("#logValForm").validate({
	errorPlacement: function(error, element) {
	    if (element.attr("name") == "fname" ){ 
	        $("#fname_label").html( error );
	    }
	    else if (element.attr("name") == "tbPassword" ){ 
	    	$("#tbPassword_label").html( error );
	    }
	    else if (element.attr("name") == "tbPassword2" ){ 
	    	$("#tbPassword2_label").html( error );
	    }
	},
	rules: {
		fname: {
			required: true,
			email: true
		},
		tbPassword: {
			required: true,
			minlength: 8
		},
		tbPassword2: {
			required: true,
			equalTo: "#tbPassword"
		}
	},
	 messages: {
		fname: {
			required: "Pole email jest puste!",
			email: "Zły format adresu email!",
		},
		tbPassword: {
			required: "Pole hasło jest puste!",
			minlength: jQuery.format("Minimum {0} znaków!")
		},
		tbPassword2: {
			required: "Pole hasło jest puste!",
			equalTo: "Podane hasła różnią się!"
		}
	}
});


$('.formTextbox').change(function() {
	if( $('#fname').valid()==true )
		{
			$('#fname_label').html("Ok");
			$('#fname').css("border","1px solid green");
		}
	else
		{
			$('#fname').css("border","1px solid red");
		}
		
	if( $('#tbPassword').valid()==true )
		{
			$('#tbPassword_label').html("Ok");
			$('#tbPassword').css("border","1px solid green");
		}
	else
		{
			$('#tbPassword').css("border","1px solid red");
		}
		
	if( $('#tbPassword2').valid()==true )
		{
			$('#tbPassword2_label').html("Ok");
			$('#tbPassword2').css("border","1px solid green");
		}
	else
		{
			$('#tbPassword2').css("border","1px solid red");
		}
});

function resForm(){
	validate.resetForm();
	$('.formTextbox').val('');
	$('#fname_label').html("np: użytkownik@adres.pl");
	$('#tbPassword_label').html("minimum 8 znaków");
	$('#tbPassword2_label').html("minimum 8 znaków");
	$('#fname').css("border","1px solid gray");
	$('#tbPassword').css("border","1px solid gray");
	$('#tbPassword2').css("border","1px solid gray");
}

</script>