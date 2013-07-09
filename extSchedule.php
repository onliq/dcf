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
		<?php include 'include/registerForm.php'; ?>
		<!-- ------------------------------------------------------------------------ -->
	
	
	<!-- Functions -------------------------------------------------------------- -->	
	<script type="text/javascript">
	
	function inCaseGetSchedule(){
		if(window.location.search.indexOf('date') < 0 && window.location.search.indexOf('room') < 0){
				var date = getCurrentDate();
			    	getSchedule(date);
			}else{
				if(window.location.search.indexOf('date') > -1 && window.location.search.indexOf('room') < 0){
					var date = getURLParameter("date");
					getSchedule(date);
				}else{
					if(window.location.search.indexOf('date') < 0 && window.location.search.indexOf('room') > -1){
						var date = getCurrentDate();
						var room = getURLParameter("room");
						getSchedule(date, room);
					}else{
						if(window.location.search.indexOf('date') > -1 && window.location.search.indexOf('room') > -1){
							var date = getURLParameter("date");
							var room = getURLParameter("room");
							getSchedule(date, room);
						}
					}
				}
			}
	}
	
	
	function getSchedule(date, room){
		var date = date;
		$.ajax({ 
	    type: 'GET', 
	    url: 'controllers/getSchedule.php', 
	    data: {date: date, scheduleMode: "extended", room: room},
	    dataType: 'json',
	    success: function (data) { 
	    	var color = 0;
			$.each(data,function(i,row){
				
			   	var startHour = row.start.substr(0,2);
			   	var startMinute = row.start.substr(3,2);
			   	var endHour = row.end.substr(0,2);
			   	var endMinute = row.end.substr(3,2);
			   	
				$("#drawExtendedSchedule").append(
				   	"<div class='classes" + row.room + "' id='class" + row.id + "'>" + row.name + "</div>"
				);
				
				if(0==color%2){
				   	$("#class" + row.id).css({"background-color" : "#d61180"});
				   	color++;
			   	}else{
			   		$("#class" + row.id).css({"background-color" : "Gray"});
			   		color++;
			   	};
			   	
			   	var startPos = ((startHour-16)*4 + startMinute/15)*15+15;
			   	var endPos = (((endHour-16)*4 + endMinute/15)*15)-startPos+15;
			   	
			   	$("#class" + row.id).css({"margin-top" : startPos + "px",
			  	 							"height" : endPos + "px"});
			});
	    	}
		});
	}
	
	
	function getURLParameter(name) {
    	return decodeURI(
        	(RegExp(name + '=' + '(.+?)(&|$)').exec(location.search)||[,null])[1]
    	);
	}
	
	
	function getCurrentDate() {
		var d = new Date();

		var month = d.getMonth()+1;
		var day = d.getDate();
	
		var output = d.getFullYear() + '/' +
	  	  (month<10 ? '0' : '') + month + '/' +
	  	  (day<10 ? '0' : '') + day;
		return output;	    
	}


	</script>
	<!-- ------------------------------------------------------------------------ -->	

	<!-- Page load -------------------------------------------------------------- -->
	<script type="text/javascript">
		$(document).ready(function(){
			
			grayout();

			inCaseGetSchedule();
			
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
				<div id="scheduleOptions"> 
					<?php
						echo ("Rozkład: ");
						if (isset($_GET['date'])){
							$date = date('Y/m/d', strtotime($_GET['date']));
							echo ('<a href="schedule.php?date='); echo ($date); echo ('">Standardowy</a>');
							echo ('<a href="extSchedule.php?date='); echo ($date); echo ('">Rozszerzony</a>');
						}else{
							echo ('<a href="schedule.php">Standardowy</a>
									<a href="extSchedule.php">Rozszerzony</a>');
						}
						if (isset($_GET['date'])){
							$date = date('Y/m/d', strtotime($_GET['date']));
							echo ('<a href="extSchedule.php?date='); echo ($date); echo('&room=A'); echo ('">Filtr: Sala A</a>');
						}else{
							echo ('<a href="extSchedule.php?room=A">Filtr: Sala A</a>');
						}
						
					?>
				<div id="weekDays">
					<div id="weekDaysContent">
						
						<?php 
						
							if (isset($_GET['date'])){
								$dayOfWeek = date('l', strtotime($_GET['date']));
								$date = date('Y/m/d', strtotime($_GET['date']));
							}else{
								$dayOfWeek = date("l");
								$date = date("Y/m/d");
							}
							echo ('<a href="extSchedule.php?date='); $datePrev = date('Y/m/d', strtotime($date . ' - 7 day')); echo $datePrev; echo ('">');
							echo ('<div class="weekDaysButton" id="prevWeek">&#171</div></a>');
							
							switch($dayOfWeek){
								
								case ($dayOfWeek == 'Monday'):
									echo ('<a href="extSchedule.php?date='); echo $date; echo ('">');
									echo ('<div class="weekDaysButton" id="mon" style="border-bottom: 2px solid #d61180">Poniedziałek</div></a>');
									echo ('<a href="extSchedule.php?date='); $date2 = date('Y/m/d', strtotime($date . ' + 1 day')); echo $date2; echo ('">');
									echo ('<div class="weekDaysButton" id="tue">Wtorek</div></a>');
									echo ('<a href="extSchedule.php?date='); $date2 = date('Y/m/d', strtotime($date2 . ' + 1 day')); echo $date2; echo ('">');
									echo ('<div class="weekDaysButton" id="wed">Środa</div></a>');
									echo ('<a href="extSchedule.php?date='); $date2 = date('Y/m/d', strtotime($date2 . ' + 1 day')); echo $date2; echo ('">');
									echo ('<div class="weekDaysButton" id="thu">Czwartek</div></a>');
									echo ('<a href="extSchedule.php?date='); $date2 = date('Y/m/d', strtotime($date2 . ' + 1 day')); echo $date2; echo ('">');
									echo ('<div class="weekDaysButton" id="fri">Piątek</div></a>');
									echo ('<a href="extSchedule.php?date='); $date2 = date('Y/m/d', strtotime($date2 . ' + 1 day')); echo $date2; echo ('">');
									echo ('<div class="weekDaysButton" id="sat">Sobota</div></a>');
									echo ('<a href="extSchedule.php?date='); $date2 = date('Y/m/d', strtotime($date2 . ' + 1 day')); echo $date2; echo ('">');
									echo ('<div class="weekDaysButton" id="sun">Niedziela</div></a>');
									break;
									
								case ($dayOfWeek == 'Tuesday'):
									echo ('<a href="extSchedule.php?date='); $date2 = date('Y/m/d', strtotime($date . ' -1 day')); echo $date2; echo ('">');
									echo ('<div class="weekDaysButton" id="mon">Poniedziałek</div></a>');
									echo ('<a href="extSchedule.php?date='); echo $date; echo ('">');
									echo ('<div class="weekDaysButton" id="tue" style="border-bottom: 2px solid #d61180">Wtorek</div></a>');
									echo ('<a href="extSchedule.php?date='); $date3 = date('Y/m/d', strtotime($date . ' +1 day')); echo $date3; echo ('">');
									echo ('<div class="weekDaysButton" id="wed">Środa</div></a>');
									echo ('<a href="extSchedule.php?date='); $date3 = date('Y/m/d', strtotime($date3 . ' + 1 day')); echo $date3; echo ('">');
									echo ('<div class="weekDaysButton" id="thu">Czwartek</div></a>');
									echo ('<a href="extSchedule.php?date='); $date3 = date('Y/m/d', strtotime($date3 . ' + 1 day')); echo $date3; echo ('">');
									echo ('<div class="weekDaysButton" id="fri">Piątek</div></a>');
									echo ('<a href="extSchedule.php?date='); $date3 = date('Y/m/d', strtotime($date3 . ' + 1 day')); echo $date3; echo ('">');
									echo ('<div class="weekDaysButton" id="sat">Sobota</div></a>');
									echo ('<a href="extSchedule.php?date='); $date3 = date('Y/m/d', strtotime($date3 . ' + 1 day')); echo $date3; echo ('">');
									echo ('<div class="weekDaysButton" id="sun">Niedziela</div></a>');
									break;
									
								case ($dayOfWeek == 'Wednesday'):
									echo ('<a href="extSchedule.php?date='); $date2 = date('Y/m/d', strtotime($date . ' - 2 day')); echo $date2; echo ('">');
									echo ('<div class="weekDaysButton" id="mon">Poniedziałek</div></a>');
									echo ('<a href="extSchedule.php?date='); $date2 = date('Y/m/d', strtotime($date . ' - 1 day')); echo $date2; echo ('">');
									echo ('<div class="weekDaysButton" id="tue">Wtorek</div></a>');
									echo ('<a href="extSchedule.php?date='); echo $date; echo ('">');
									echo ('<div class="weekDaysButton" id="wed" style="border-bottom: 2px solid #d61180">Środa</div></a>');
									echo ('<a href="extSchedule.php?date='); $date3 = date('Y/m/d', strtotime($date . ' + 1 day')); echo $date3; echo ('">');
									echo ('<div class="weekDaysButton" id="thu">Czwartek</div></a>');
									echo ('<a href="extSchedule.php?date='); $date3 = date('Y/m/d', strtotime($date3 . ' + 1 day')); echo $date3; echo ('">');
									echo ('<div class="weekDaysButton" id="fri">Piątek</div></a>');
									echo ('<a href="extSchedule.php?date='); $date3 = date('Y/m/d', strtotime($date3 . ' + 1 day')); echo $date3; echo ('">');
									echo ('<div class="weekDaysButton" id="sat">Sobota</div></a>');
									echo ('<a href="extSchedule.php?date='); $date3 = date('Y/m/d', strtotime($date3 . ' + 1 day')); echo $date3; echo ('">');
									echo ('<div class="weekDaysButton" id="sun">Niedziela</div></a>');
									break;
									
								case ($dayOfWeek == 'Thursday'):
									echo ('<a href="extSchedule.php?date='); $date2 = date('Y/m/d', strtotime($date . ' - 3 day')); echo $date2; echo ('">');
									echo ('<div class="weekDaysButton" id="mon">Poniedziałek</div></a>');
									echo ('<a href="extSchedule.php?date='); $date2 = date('Y/m/d', strtotime($date . ' - 2 day')); echo $date2; echo ('">');
									echo ('<div class="weekDaysButton" id="tue">Wtorek</div></a>');
									echo ('<a href="extSchedule.php?date='); $date2 = date('Y/m/d', strtotime($date . ' - 1 day')); echo $date2; echo ('">');
									echo ('<div class="weekDaysButton" id="wed">Środa</div></a>');
									echo ('<a href="extSchedule.php?date='); echo $date; echo ('">');
									echo ('<div class="weekDaysButton" id="thu" style="border-bottom: 2px solid #d61180">Czwartek</div></a>');
									echo ('<a href="extSchedule.php?date='); $date3 = date('Y/m/d', strtotime($date . ' + 1 day')); echo $date3; echo ('">');
									echo ('<div class="weekDaysButton" id="fri">Piątek</div></a>');
									echo ('<a href="extSchedule.php?date='); $date3 = date('Y/m/d', strtotime($date3 . ' + 1 day')); echo $date3; echo ('">');
									echo ('<div class="weekDaysButton" id="sat">Sobota</div></a>');
									echo ('<a href="extSchedule.php?date='); $date3 = date('Y/m/d', strtotime($date3 . ' + 1 day')); echo $date3; echo ('">');
									echo ('<div class="weekDaysButton" id="sun">Niedziela</div></a>');
									break;
									
								case ($dayOfWeek == 'Friday'):
									echo ('<a href="extSchedule.php?date='); $date2 = date('Y/m/d', strtotime($date . ' - 4 day')); echo $date2; echo ('">');
									echo ('<div class="weekDaysButton" id="mon">Poniedziałek</div></a>');
									echo ('<a href="extSchedule.php?date='); $date2 = date('Y/m/d', strtotime($date . ' - 3 day')); echo $date2; echo ('">');
									echo ('<div class="weekDaysButton" id="tue">Wtorek</div></a>');
									echo ('<a href="extSchedule.php?date='); $date2 = date('Y/m/d', strtotime($date . ' - 2 day')); echo $date2; echo ('">');
									echo ('<div class="weekDaysButton" id="wed">Środa</div></a>');
									echo ('<a href="extSchedule.php?date='); $date2 = date('Y/m/d', strtotime($date . ' - 1 day')); echo $date2; echo ('">');
									echo ('<div class="weekDaysButton" id="thu">Czwartek</div></a>');
									echo ('<a href="extSchedule.php?date='); echo $date; echo ('">');
									echo ('<div class="weekDaysButton" id="fri" style="border-bottom: 2px solid #d61180">Piątek</div></a>');
									echo ('<a href="extSchedule.php?date='); $date3 = date('Y/m/d', strtotime($date . ' + 1 day')); echo $date3; echo ('">');
									echo ('<div class="weekDaysButton" id="sat">Sobota</div></a>');
									echo ('<a href="extSchedule.php?date='); $date3 = date('Y/m/d', strtotime($date3 . ' + 1 day')); echo $date3; echo ('">');
									echo ('<div class="weekDaysButton" id="sun">Niedziela</div></a>');
									break;
									
								case ($dayOfWeek == 'Saturday'):
									echo ('<a href="extSchedule.php?date='); $date2 = date('Y/m/d', strtotime($date . ' - 5 day')); echo $date2; echo ('">');
									echo ('<div class="weekDaysButton" id="mon">Poniedziałek</div></a>');
									echo ('<a href="extSchedule.php?date='); $date2 = date('Y/m/d', strtotime($date . ' - 4 day')); echo $date2; echo ('">');
									echo ('<div class="weekDaysButton" id="tue">Wtorek</div></a>');
									echo ('<a href="extSchedule.php?date='); $date2 = date('Y/m/d', strtotime($date . ' - 3 day')); echo $date2; echo ('">');
									echo ('<div class="weekDaysButton" id="wed">Środa</div></a>');
									echo ('<a href="extSchedule.php?date='); $date2 = date('Y/m/d', strtotime($date . ' - 2 day')); echo $date2; echo ('">');
									echo ('<div class="weekDaysButton" id="thu">Czwartek</div></a>');
									echo ('<a href="extSchedule.php?date='); $date2 = date('Y/m/d', strtotime($date . ' - 1 day')); echo $date2; echo ('">');
									echo ('<div class="weekDaysButton" id="fri">Piątek</div></a>');
									echo ('<a href="extSchedule.php?date='); echo $date; echo ('">');
									echo ('<div class="weekDaysButton" id="sat" style="border-bottom: 2px solid #d61180">Sobota</div></a>');
									echo ('<a href="extSchedule.php?date='); $date3 = date('Y/m/d', strtotime($date . ' + 1 day')); echo $date3; echo ('">');
									echo ('<div class="weekDaysButton" id="sun">Niedziela</div></a>');
									break;
									
								case ($dayOfWeek == 'Sunday'):
									echo ('<a href="extSchedule.php?date='); $date2 = date('Y/m/d', strtotime($date . ' - 6 day')); echo $date2; echo ('">');
									echo ('<div class="weekDaysButton" id="mon">Poniedziałek</div></a>');
									echo ('<a href="extSchedule.php?date='); $date2 = date('Y/m/d', strtotime($date . ' - 5 day')); echo $date2; echo ('">');
									echo ('<div class="weekDaysButton" id="tue">Wtorek</div></a>');
									echo ('<a href="extSchedule.php?date='); $date2 = date('Y/m/d', strtotime($date . ' - 4 day')); echo $date2; echo ('">');
									echo ('<div class="weekDaysButton" id="wed">Środa</div></a>');
									echo ('<a href="extSchedule.php?date='); $date2 = date('Y/m/d', strtotime($date . ' - 3 day')); echo $date2; echo ('">');
									echo ('<div class="weekDaysButton" id="thu">Czwartek</div></a>');
									echo ('<a href="extSchedule.php?date='); $date2 = date('Y/m/d', strtotime($date . ' - 2 day')); echo $date2; echo ('">');
									echo ('<div class="weekDaysButton" id="fri">Piątek</div></a>');
									echo ('<a href="extSchedule.php?date='); $date2 = date('Y/m/d', strtotime($date . ' - 1 day')); echo $date2; echo ('">');
									echo ('<div class="weekDaysButton" id="sat">Sobota</div></a>');
									echo ('<a href="extSchedule.php?date='); echo $date; echo ('">');
									echo ('<div class="weekDaysButton" id="sun" style="border-bottom: 2px solid #d61180">Niedziela</div></a>');
									break;
							}
							
							echo ('<a href="extSchedule.php?date='); $dateNext = date('Y/m/d', strtotime($date . ' + 7 day')); echo $dateNext; echo ('">');
							echo ('<div class="weekDaysButton" id="nextWeek">&#187</div></a>');
							
						?>
					
					</div>
				</div>
				<div id="schedule">
					<div id="scheduleContent">
						<div id="scheduleHeader">
							<div class="classRoom" id="salaA">A</div>
							<div class="classRoom" id"salaB">B</div>
							<div class="classRoom" id="salaC">C</div>
							<div class="classRoom" id="salaD">D</div>
						</div>
						<div id="scheduleTable">
							<table class="hoursTableLeft">
								<?php
									function hours() {
										$hoursList = array("9: 00", "9: 15", "9: 30", "9: 45", "10: 00", "10: 15", "10: 30", "10: 45", "11: 00", "11: 15", "11: 30", 
															"11: 45", "12: 00", "12: 15", "12: 30", "12: 45", "13: 00", "13: 15", "13: 30", "13: 45", "14: 00", 
															"14: 15", "14: 30", "14: 45", "15: 00", "15: 15", "15: 30", "15: 45", "16: 00", "16: 15", "16: 30", 
															"16: 45", "17: 00", "17:15", "17: 30", "17: 45", "18: 00", "18: 15", "18: 30", "18: 45", "19: 00", 
															"19: 15", "19: 30", "19: 45", "20: 00", "20: 15", "20: 30", "20: 45", "21: 00", "21: 15", "21: 30", 
															"21: 45", "22: 00",);
										for ($i = 0; $i < 53; $i ++) {
											echo ('<tr><td class="hours">');
											echo ($hoursList[$i]);
											echo ('</td></tr>');
											}
									}
								hours();
								?>
								
							</table>
							<?php
							echo ("<table class='sTable'>");
								for($i = 0; $i < 27	; $i++) {
									echo ('<tr class="rows">
												<td class="td01"></td>
												<td class="td1"></td>
												<td class="td1"></td>
												<td class="td1"></td>
												<td class="td1"></td>
											</tr>
											<tr class="rows">
												<td class="td02"></td>
												<td class="td2"></td>
												<td class="td2"></td>
												<td class="td2"></td>
												<td class="td2"></td>
											</tr>'
										);
								}
								echo ("</table>");
							?>
							
							<table class="hoursTableRight">
								<?php
								hours();
								?>
							</table>
							<div id="drawExtendedSchedule"></div>
						</div>
					</div>
				</div>
				
			</div>
			
			
			<!-- Include footer --------------------------------------------------------- -->
			<?php include 'include/footer.php'; ?>
			<!-- ------------------------------------------------------------------------ -->
		</div>
	</body>
	
</html>

