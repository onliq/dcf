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
	
	
	<!-- Functions -------------------------------------------------------------- -->	
	<script type="text/javascript">
	function getSchedule(date){
		var date = date;
		$.ajax({ 
	    type: 'POST', 
	    url: 'controllers/getSchedule.php', 
	    data: {date: date},
	    dataType: 'json',
	    success: function (data) { 
	    	var color = 0;
			$.each(data,function(i,row){
				
			   	var startHour = row.start.substr(0,2);
			   	var startMinute = row.start.substr(3,2);
			   	var endHour = row.end.substr(0,2);
			   	var endMinute = row.end.substr(3,2);
			   	
				$("#scheduleBackground").append(
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
	</script>
	<!-- ------------------------------------------------------------------------ -->	

	<!-- Page load -------------------------------------------------------------- -->
	<script type="text/javascript">
		$(document).ready(function(){
			grayout();
			var date = new Date("2013/06/27");
			var currentDay = date.getDate();
			var currentMonth = date.getMonth();
			var currentYear = date.getFullYear();
			date = (currentYear + "/" + currentMonth + "/" + currentDay);
			getSchedule(date);
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
				<div id="weekDays">
					<div id="weekDaysContent">
						
						<?php 
						
							if (isset($_GET['date'])){
								$dayOfWeek = date('l', strtotime($_GET['date']));
								$date = date('Y/m/d', strtotime($_GET['date']));
								// echo 'Date: ' . $date . '  Day: ' . $dayOfWeek;
							}else{
								$dayOfWeek = date("l");
								$date = date("Y/m/d");
								// echo 'Date: ' . $date . '  Day: ' . $dayOfWeek;
							}
							
							echo ('<div class="weekDaysButton" id="prevWeek">&#171</div>');
							
							switch($dayOfWeek){
								
								case ($dayOfWeek == 'Monday'):
									echo ('<a href="schedule.php?date='); echo $date; echo ('">');
									echo ('<div class="weekDaysButton" id="mon" style="border-bottom: 2px solid #d61180">Poniedziałek</div></a>');
									echo ('<a href="schedule.php?date='); $date = date('Y/m/d', strtotime($date . ' + 1 day')); echo $date; echo ('">');
									echo ('<div class="weekDaysButton" id="tue">Wtorek</div></a>');
									echo ('<a href="schedule.php?date='); $date = date('Y/m/d', strtotime($date . ' + 1 day')); echo $date; echo ('">');
									echo ('<div class="weekDaysButton" id="wed">Środa</div></a>');
									echo ('<a href="schedule.php?date='); $date = date('Y/m/d', strtotime($date . ' + 1 day')); echo $date; echo ('">');
									echo ('<div class="weekDaysButton" id="thu">Czwartek</div></a>');
									echo ('<a href="schedule.php?date='); $date = date('Y/m/d', strtotime($date . ' + 1 day')); echo $date; echo ('">');
									echo ('<div class="weekDaysButton" id="fri">Piątek</div></a>');
									echo ('<a href="schedule.php?date='); $date = date('Y/m/d', strtotime($date . ' + 1 day')); echo $date; echo ('">');
									echo ('<div class="weekDaysButton" id="sat">Sobota</div></a>');
									echo ('<a href="schedule.php?date='); $date = date('Y/m/d', strtotime($date . ' + 1 day')); echo $date; echo ('">');
									echo ('<div class="weekDaysButton" id="sun">Niedziela</div></a>');
									break;
									
								case ($dayOfWeek == 'Tuesday'):
									echo ('<a href="schedule.php?date='); $date2 = date('Y/m/d', strtotime($date . ' -1 day')); echo $date2; echo ('">');
									echo ('<div class="weekDaysButton" id="mon">Poniedziałek</div></a>');
									echo ('<a href="schedule.php?date='); echo $date; echo ('">');
									echo ('<div class="weekDaysButton" id="tue" style="border-bottom: 2px solid #d61180">Wtorek</div></a>');
									echo ('<a href="schedule.php?date='); $date = date('Y/m/d', strtotime($date . ' +1 day')); echo $date; echo ('">');
									echo ('<div class="weekDaysButton" id="wed">Środa</div></a>');
									echo ('<a href="schedule.php?date='); $date = date('Y/m/d', strtotime($date . ' + 1 day')); echo $date; echo ('">');
									echo ('<div class="weekDaysButton" id="thu">Czwartek</div></a>');
									echo ('<a href="schedule.php?date='); $date = date('Y/m/d', strtotime($date . ' + 1 day')); echo $date; echo ('">');
									echo ('<div class="weekDaysButton" id="fri">Piątek</div></a>');
									echo ('<a href="schedule.php?date='); $date = date('Y/m/d', strtotime($date . ' + 1 day')); echo $date; echo ('">');
									echo ('<div class="weekDaysButton" id="sat">Sobota</div></a>');
									echo ('<a href="schedule.php?date='); $date = date('Y/m/d', strtotime($date . ' + 1 day')); echo $date; echo ('">');
									echo ('<div class="weekDaysButton" id="sun">Niedziela</div></a>');
									break;
									
								case ($dayOfWeek == 'Wednesday'):
									echo ('<a href="schedule.php?date='); $date2 = date('Y/m/d', strtotime($date . ' - 2 day')); echo $date2; echo ('">');
									echo ('<div class="weekDaysButton" id="mon">Poniedziałek</div></a>');
									echo ('<a href="schedule.php?date='); $date2 = date('Y/m/d', strtotime($date . ' - 1 day')); echo $date2; echo ('">');
									echo ('<div class="weekDaysButton" id="tue">Wtorek</div></a>');
									echo ('<a href="schedule.php?date='); echo $date; echo ('">');
									echo ('<div class="weekDaysButton" id="wed" style="border-bottom: 2px solid #d61180">Środa</div></a>');
									echo ('<a href="schedule.php?date='); $date = date('Y/m/d', strtotime($date . ' + 1 day')); echo $date; echo ('">');
									echo ('<div class="weekDaysButton" id="thu">Czwartek</div></a>');
									echo ('<a href="schedule.php?date='); $date = date('Y/m/d', strtotime($date . ' + 1 day')); echo $date; echo ('">');
									echo ('<div class="weekDaysButton" id="fri">Piątek</div></a>');
									echo ('<a href="schedule.php?date='); $date = date('Y/m/d', strtotime($date . ' + 1 day')); echo $date; echo ('">');
									echo ('<div class="weekDaysButton" id="sat">Sobota</div></a>');
									echo ('<a href="schedule.php?date='); $date = date('Y/m/d', strtotime($date . ' + 1 day')); echo $date; echo ('">');
									echo ('<div class="weekDaysButton" id="sun">Niedziela</div></a>');
									break;
									
								case ($dayOfWeek == 'Thursday'):
									echo ('<a href="schedule.php?date='); $date2 = date('Y/m/d', strtotime($date . ' - 3 day')); echo $date2; echo ('">');
									echo ('<div class="weekDaysButton" id="mon">Poniedziałek</div></a>');
									echo ('<a href="schedule.php?date='); $date2 = date('Y/m/d', strtotime($date . ' - 2 day')); echo $date2; echo ('">');
									echo ('<div class="weekDaysButton" id="tue">Wtorek</div></a>');
									echo ('<a href="schedule.php?date='); $date2 = date('Y/m/d', strtotime($date . ' - 1 day')); echo $date2; echo ('">');
									echo ('<div class="weekDaysButton" id="wed">Środa</div></a>');
									echo ('<a href="schedule.php?date='); echo $date; echo ('">');
									echo ('<div class="weekDaysButton" id="thu" style="border-bottom: 2px solid #d61180">Czwartek</div></a>');
									echo ('<a href="schedule.php?date='); $date = date('Y/m/d', strtotime($date . ' + 1 day')); echo $date; echo ('">');
									echo ('<div class="weekDaysButton" id="fri">Piątek</div></a>');
									echo ('<a href="schedule.php?date='); $date = date('Y/m/d', strtotime($date . ' + 1 day')); echo $date; echo ('">');
									echo ('<div class="weekDaysButton" id="sat">Sobota</div></a>');
									echo ('<a href="schedule.php?date='); $date = date('Y/m/d', strtotime($date . ' + 1 day')); echo $date; echo ('">');
									echo ('<div class="weekDaysButton" id="sun">Niedziela</div></a>');
									break;
									
								case ($dayOfWeek == 'Friday'):
									echo ('<a href="schedule.php?date='); $date2 = date('Y/m/d', strtotime($date . ' - 4 day')); echo $date2; echo ('">');
									echo ('<div class="weekDaysButton" id="mon">Poniedziałek</div></a>');
									echo ('<a href="schedule.php?date='); $date2 = date('Y/m/d', strtotime($date . ' - 3 day')); echo $date2; echo ('">');
									echo ('<div class="weekDaysButton" id="tue">Wtorek</div></a>');
									echo ('<a href="schedule.php?date='); $date2 = date('Y/m/d', strtotime($date . ' - 2 day')); echo $date2; echo ('">');
									echo ('<div class="weekDaysButton" id="wed">Środa</div></a>');
									echo ('<a href="schedule.php?date='); $date2 = date('Y/m/d', strtotime($date . ' - 1 day')); echo $date2; echo ('">');
									echo ('<div class="weekDaysButton" id="thu">Czwartek</div></a>');
									echo ('<a href="schedule.php?date='); echo $date; echo ('">');
									echo ('<div class="weekDaysButton" id="fri" style="border-bottom: 2px solid #d61180">Piątek</div></a>');
									echo ('<a href="schedule.php?date='); $date = date('Y/m/d', strtotime($date . ' + 1 day')); echo $date; echo ('">');
									echo ('<div class="weekDaysButton" id="sat">Sobota</div></a>');
									echo ('<a href="schedule.php?date='); $date = date('Y/m/d', strtotime($date . ' + 1 day')); echo $date; echo ('">');
									echo ('<div class="weekDaysButton" id="sun">Niedziela</div></a>');
									break;
									
								case ($dayOfWeek == 'Saturday'):
									echo ('<a href="schedule.php?date='); $date2 = date('Y/m/d', strtotime($date . ' - 5 day')); echo $date2; echo ('">');
									echo ('<div class="weekDaysButton" id="mon">Poniedziałek</div></a>');
									echo ('<a href="schedule.php?date='); $date2 = date('Y/m/d', strtotime($date . ' - 4 day')); echo $date2; echo ('">');
									echo ('<div class="weekDaysButton" id="tue">Wtorek</div></a>');
									echo ('<a href="schedule.php?date='); $date2 = date('Y/m/d', strtotime($date . ' - 3 day')); echo $date2; echo ('">');
									echo ('<div class="weekDaysButton" id="wed">Środa</div></a>');
									echo ('<a href="schedule.php?date='); $date2 = date('Y/m/d', strtotime($date . ' - 2 day')); echo $date2; echo ('">');
									echo ('<div class="weekDaysButton" id="thu">Czwartek</div></a>');
									echo ('<a href="schedule.php?date='); $date2 = date('Y/m/d', strtotime($date . ' - 1 day')); echo $date2; echo ('">');
									echo ('<div class="weekDaysButton" id="fri">Piątek</div></a>');
									echo ('<a href="schedule.php?date='); echo $date; echo ('">');
									echo ('<div class="weekDaysButton" id="sat" style="border-bottom: 2px solid #d61180">Sobota</div></a>');
									echo ('<a href="schedule.php?date='); $date = date('Y/m/d', strtotime($date . ' + 1 day')); echo $date; echo ('">');
									echo ('<div class="weekDaysButton" id="sun">Niedziela</div></a>');
									break;
									
								case ($dayOfWeek == 'Sunday'):
									echo ('<a href="schedule.php?date='); $date2 = date('Y/m/d', strtotime($date . ' - 6 day')); echo $date2; echo ('">');
									echo ('<div class="weekDaysButton" id="mon">Poniedziałek</div></a>');
									echo ('<a href="schedule.php?date='); $date2 = date('Y/m/d', strtotime($date . ' - 5 day')); echo $date2; echo ('">');
									echo ('<div class="weekDaysButton" id="tue">Wtorek</div></a>');
									echo ('<a href="schedule.php?date='); $date2 = date('Y/m/d', strtotime($date . ' - 4 day')); echo $date2; echo ('">');
									echo ('<div class="weekDaysButton" id="wed">Środa</div></a>');
									echo ('<a href="schedule.php?date='); $date2 = date('Y/m/d', strtotime($date . ' - 3 day')); echo $date2; echo ('">');
									echo ('<div class="weekDaysButton" id="thu">Czwartek</div></a>');
									echo ('<a href="schedule.php?date='); $date2 = date('Y/m/d', strtotime($date . ' - 2 day')); echo $date2; echo ('">');
									echo ('<div class="weekDaysButton" id="fri">Piątek</div></a>');
									echo ('<a href="schedule.php?date='); $date2 = date('Y/m/d', strtotime($date . ' - 1 day')); echo $date2; echo ('">');
									echo ('<div class="weekDaysButton" id="sat">Sobota</div></a>');
									echo ('<a href="schedule.php?date='); echo $date; echo ('">');
									echo ('<div class="weekDaysButton" id="sun" style="border-bottom: 2px solid #d61180">Niedziela</div></a>');
									break;
							}
							
							echo ('<div class="weekDaysButton" id="nextWeek">&#187</div>');
							
						?>
						<!-- <div class="weekDaysButton" id="prevWeek">&#171</div>
						<div class="weekDaysButton" id="mon">Poniedziałek</div>
						<div class="weekDaysButton" id="tue">Wtorek</div>
						<div class="weekDaysButton" id="wed">Środa</div>
						<div class="weekDaysButton" id="thu">Czwartek</div>
						<div class="weekDaysButton" id="fri">Piątek</div>
						<div class="weekDaysButton" id="sat">Sobota</div>
						<div class="weekDaysButton" id="sun">Niedziela</div>
						<div class="weekDaysButton" id="nextWeek">&#187</div> -->
					</div>
				</div>
				<div id="schedule">
					<div id="scheduleTable">
						<div id="scheduleHeader">
							<div class="classRoom" id="salaA">A</div>
							<div class="classRoom" id"salaB">B</div>
							<div class="classRoom" id="salaC">C</div>
							<div class="classRoom" id="salaD">D</div>
						</div>
						<div id="scheduleBackground"></div>
					</div>
				</div>
				
			</div>
			
			
			<!-- Include footer --------------------------------------------------------- -->
			<?php include 'include/footer.php'; ?>
			<!-- ------------------------------------------------------------------------ -->
		</div>
	</body>
	
</html>

