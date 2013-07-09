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
	
	// Loading instructors dropdown list
	function loadInstructorsList(){
			$.ajax({
					url: "controllers/getInstructorsList.php",
					type: "POST",
					cache: false
					}).done(function(data) {
			  		$("#instructors").html(data);
			  		if(window.location.search.indexOf('instructor') < 0){ // if no instructor param - load default classes list
						loadClassesList2(0);
					}else{
						var iName = getURLParameter("instructor"); // if instructor param exists - set correct option as selected, and load proper classes list
						var value = $('#selectInstructors option').filter(function () { return $(this).html() == iName; }).val();
						$('#selectInstructors option[value="' + value + '"]').prop('selected', true);
						loadClassesList2(value)
					}
					loadClassesList1(); // load on_select_change function
				});
	}
	
	// Change classes dropdown list on instructor change
	function loadClassesList1(){
		$("#selectInstructors").on("change", function(){
			$("#selectInstructors option:selected").each(function () {
	            var id = $(this).attr("value");
	            if(id == 0){ // controlls proper classes lists displaying
	            	$("#classes1").hide();
	            	$("#classes2").show();
	            	loadClassesList2(0);
	            }else{
	            	$("#classes1").show();
	            	$("#classes2").hide();
		            $.ajax({ // loading classes list
								url: "controllers/getClassesList.php",
								type: "POST",
								data:  {instructorId: id},
								cache: false
								}).done(function(data) {
						  		$("#classes1").html(data);
							});
						}
	  			});	
			})
	}
	
	// Startup default classes dropdownlist
	function loadClassesList2(id){
            $.ajax({
						url: "controllers/getClassesList.php",
						type: "POST",
						data: {instructorId: id},
						cache: false
						}).done(function(data) {
				  		$("#classes2").html(data);
				  		if(window.location.search.indexOf('classes') < 0){
									
						}else{ // Setting proper option as selected
							var classes = getURLParameter("classes");
							var value2 = $('#selectClasses option').filter(function () { return $(this).html() == classes; }).val();
							$('#selectClasses option[value="' + value2 + '"]').prop('selected', true);
						}
				  });
	}
		
		
			
	// function setStartupFilters(){
		// loadInstructorsList();
		// var test = $("#selectInstructors option:selected").html();
		// alert(test);
		// if($("#selectInstructors option:selected").html() == "Wszyscy instruktorzy"){
			// alert("Asd");
			// loadClassesList1();
		// }else{
			// alert("222");
		// }
	// }
	
	
	// Change filtering on button click
	function filter(){
		$("#filterButton").click(function(){
			
			var date = getCurrentDate();
			var instructor = $("#selectInstructors option:selected").html();
			var classes = $("#selectClasses option:selected").html();
			
			$("#drawSchedule").html("");
			
			if(instructor == "Wszyscy instruktorzy" && classes == "Wszystkie zajęcia"){
				// alert("opt1");
				window.location.replace('schedule.php?date=' + date);
			}else{
				if(instructor != "Wszyscy instruktorzy" && classes == "Wszystkie zajęcia"){
				// alert("opt2");
				window.location.replace('schedule.php?date=' + date + '&instructor=' + instructor);
				}else{
					if(instructor == "Wszyscy instruktorzy" && classes != "Wszystkie zajęcia"){
					// alert("opt3");
					window.location.replace('schedule.php?date=' + date + '&classes=' + classes);
					}else{
						if(instructor != "Wszyscy instruktorzy" && classes != "Wszystkie zajęcia"){
							// alert("opt4");
							window.location.replace('schedule.php?date=' + date + '&instructor=' + instructor + '&classes=' + classes);
						}else{
							// alert("opt5");		
						}
					}
				}
			}
		})
	}
	
	
	// Checking if filters params exists in URL
	function inCaseGetSchedule(){
		var date = getCurrentDate();
		if(window.location.search.indexOf('instructor') < 0 && window.location.search.indexOf('classes') < 0){
			    	getSchedule(date);
			}else{
					if(window.location.search.indexOf('instructor') > -1 && window.location.search.indexOf('classes') < 0){
						var instructor = getURLParameter("instructor");
						getSchedule(date, instructor);
					}else{
						if(window.location.search.indexOf('instructor') < 0 && window.location.search.indexOf('classes') > -1){
							var classes = getURLParameter("classes");
							getSchedule(date, instructor, classes);
						}else{
							if(window.location.search.indexOf('instructor') > -1 && window.location.search.indexOf('classes') > -1){
								var instructor = getURLParameter("instructor");
								var classes = getURLParameter("classes");
								getSchedule(date, instructor, classes);
							}
							}
						}
				}		
	}
	
	
	// Drawing schedule on screen
	function getSchedule(date, instructor, classes){
		var date = date;
		$.ajax({ 
	    type: 'GET', 
	    url: 'controllers/getSchedule.php', 
	    data: {date: date, scheduleMode: "normal", instructor: instructor, classes: classes},
	    dataType: 'json',
	    error: function (data) {
	    	loadInstructorsList();
			loadClassesList2();
	    },
	    success: function (data) { 
	    	var color = 0;
			$.each(data,function(i,row){
				
			   	var startHour = row.start.substr(0,2);
			   	var startMinute = row.start.substr(3,2);
			   	var endHour = row.end.substr(0,2);
			   	var endMinute = row.end.substr(3,2);
			   	
				$("#drawSchedule").append(
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
	
	// Getting URL parameters
	function getURLParameter(name) {
    	return decodeURI(
        	(RegExp(name + '=' + '(.+?)(&|$)').exec(location.search)||[,null])[1]
    	);
	}
	
	// Getting current date
	function getCurrentDate() {
		
		if(window.location.search.indexOf('date') > -1){
			var date = getURLParameter("date");
		}else{
			var d = new Date();

			var month = d.getMonth()+1;
			var day = d.getDate();
	
			var date = d.getFullYear() + '/' +
	  	  	(month<10 ? '0' : '') + month + '/' +
	  	  	(day<10 ? '0' : '') + day;    
		}
		return date;	
	}


	</script>
	<!-- ------------------------------------------------------------------------ -->	

	<!-- Page load -------------------------------------------------------------- -->
	<script type="text/javascript">
		$(document).ready(function(){
			
			grayout();
			
			loadInstructorsList();
			inCaseGetSchedule();
			filter();
			
			// setStartupFilters();
			// loadClassesList1();
			// setFilters();
			// getSchedule('2013/07/01', 'Klaudia Nierodzik')
			
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
				<div id="scheduleOptionsContent"> 
					<div id="scheduleOptions">
						<div id="pickScheduleType">
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
									echo ('<a href="schedule.php?date='); echo ($date); echo('&room=A'); echo ('">Filtr: Sala A</a>');
								}else{
									echo ('<a href="schedule.php?room=A">Filtr: Sala A</a>');
								}
								
							?>
						</div>
						<div id="filterOptions">
							<div id="instructors"></div>
							<div id="classes1"></div>
							<div id="classes2"></div>
							<input type="button" id="filterButton" value="Filter" />
						</div>
					</div>
				</div>
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
							echo ('<a href="schedule.php?date='); $datePrev = date('Y/m/d', strtotime($date . ' - 7 day')); echo $datePrev; echo ('">');
							echo ('<div class="weekDaysButton" id="prevWeek">&#171</div></a>');
							
							switch($dayOfWeek){
								
								case ($dayOfWeek == 'Monday'):
									echo ('<a href="schedule.php?date='); echo $date; echo ('">');
									echo ('<div class="weekDaysButton" id="mon" style="border-bottom: 2px solid #d61180">Poniedziałek</div></a>');
									echo ('<a href="schedule.php?date='); $date2 = date('Y/m/d', strtotime($date . ' + 1 day')); echo $date2; echo ('">');
									echo ('<div class="weekDaysButton" id="tue">Wtorek</div></a>');
									echo ('<a href="schedule.php?date='); $date2 = date('Y/m/d', strtotime($date2 . ' + 1 day')); echo $date2; echo ('">');
									echo ('<div class="weekDaysButton" id="wed">Środa</div></a>');
									echo ('<a href="schedule.php?date='); $date2 = date('Y/m/d', strtotime($date2 . ' + 1 day')); echo $date2; echo ('">');
									echo ('<div class="weekDaysButton" id="thu">Czwartek</div></a>');
									echo ('<a href="schedule.php?date='); $date2 = date('Y/m/d', strtotime($date2 . ' + 1 day')); echo $date2; echo ('">');
									echo ('<div class="weekDaysButton" id="fri">Piątek</div></a>');
									echo ('<a href="schedule.php?date='); $date2 = date('Y/m/d', strtotime($date2 . ' + 1 day')); echo $date2; echo ('">');
									echo ('<div class="weekDaysButton" id="sat">Sobota</div></a>');
									echo ('<a href="schedule.php?date='); $date2 = date('Y/m/d', strtotime($date2 . ' + 1 day')); echo $date2; echo ('">');
									echo ('<div class="weekDaysButton" id="sun">Niedziela</div></a>');
									break;
									
								case ($dayOfWeek == 'Tuesday'):
									echo ('<a href="schedule.php?date='); $date2 = date('Y/m/d', strtotime($date . ' -1 day')); echo $date2; echo ('">');
									echo ('<div class="weekDaysButton" id="mon">Poniedziałek</div></a>');
									echo ('<a href="schedule.php?date='); echo $date; echo ('">');
									echo ('<div class="weekDaysButton" id="tue" style="border-bottom: 2px solid #d61180">Wtorek</div></a>');
									echo ('<a href="schedule.php?date='); $date3 = date('Y/m/d', strtotime($date . ' +1 day')); echo $date3; echo ('">');
									echo ('<div class="weekDaysButton" id="wed">Środa</div></a>');
									echo ('<a href="schedule.php?date='); $date3 = date('Y/m/d', strtotime($date3 . ' + 1 day')); echo $date3; echo ('">');
									echo ('<div class="weekDaysButton" id="thu">Czwartek</div></a>');
									echo ('<a href="schedule.php?date='); $date3 = date('Y/m/d', strtotime($date3 . ' + 1 day')); echo $date3; echo ('">');
									echo ('<div class="weekDaysButton" id="fri">Piątek</div></a>');
									echo ('<a href="schedule.php?date='); $date3 = date('Y/m/d', strtotime($date3 . ' + 1 day')); echo $date3; echo ('">');
									echo ('<div class="weekDaysButton" id="sat">Sobota</div></a>');
									echo ('<a href="schedule.php?date='); $date3 = date('Y/m/d', strtotime($date3 . ' + 1 day')); echo $date3; echo ('">');
									echo ('<div class="weekDaysButton" id="sun">Niedziela</div></a>');
									break;
									
								case ($dayOfWeek == 'Wednesday'):
									echo ('<a href="schedule.php?date='); $date2 = date('Y/m/d', strtotime($date . ' - 2 day')); echo $date2; echo ('">');
									echo ('<div class="weekDaysButton" id="mon">Poniedziałek</div></a>');
									echo ('<a href="schedule.php?date='); $date2 = date('Y/m/d', strtotime($date . ' - 1 day')); echo $date2; echo ('">');
									echo ('<div class="weekDaysButton" id="tue">Wtorek</div></a>');
									echo ('<a href="schedule.php?date='); echo $date; echo ('">');
									echo ('<div class="weekDaysButton" id="wed" style="border-bottom: 2px solid #d61180">Środa</div></a>');
									echo ('<a href="schedule.php?date='); $date3 = date('Y/m/d', strtotime($date . ' + 1 day')); echo $date3; echo ('">');
									echo ('<div class="weekDaysButton" id="thu">Czwartek</div></a>');
									echo ('<a href="schedule.php?date='); $date3 = date('Y/m/d', strtotime($date3 . ' + 1 day')); echo $date3; echo ('">');
									echo ('<div class="weekDaysButton" id="fri">Piątek</div></a>');
									echo ('<a href="schedule.php?date='); $date3 = date('Y/m/d', strtotime($date3 . ' + 1 day')); echo $date3; echo ('">');
									echo ('<div class="weekDaysButton" id="sat">Sobota</div></a>');
									echo ('<a href="schedule.php?date='); $date3 = date('Y/m/d', strtotime($date3 . ' + 1 day')); echo $date3; echo ('">');
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
									echo ('<a href="schedule.php?date='); $date3 = date('Y/m/d', strtotime($date . ' + 1 day')); echo $date3; echo ('">');
									echo ('<div class="weekDaysButton" id="fri">Piątek</div></a>');
									echo ('<a href="schedule.php?date='); $date3 = date('Y/m/d', strtotime($date3 . ' + 1 day')); echo $date3; echo ('">');
									echo ('<div class="weekDaysButton" id="sat">Sobota</div></a>');
									echo ('<a href="schedule.php?date='); $date3 = date('Y/m/d', strtotime($date3 . ' + 1 day')); echo $date3; echo ('">');
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
									echo ('<a href="schedule.php?date='); $date3 = date('Y/m/d', strtotime($date . ' + 1 day')); echo $date3; echo ('">');
									echo ('<div class="weekDaysButton" id="sat">Sobota</div></a>');
									echo ('<a href="schedule.php?date='); $date3 = date('Y/m/d', strtotime($date3 . ' + 1 day')); echo $date3; echo ('">');
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
									echo ('<a href="schedule.php?date='); $date3 = date('Y/m/d', strtotime($date . ' + 1 day')); echo $date3; echo ('">');
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
							
							echo ('<a href="schedule.php?date='); $dateNext = date('Y/m/d', strtotime($date . ' + 7 day')); echo $dateNext; echo ('">');
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
										$hoursList = array("16: 00", "16: 15", "16: 30", "16: 45", "17: 00", "17:15", "17: 30", "17: 45", "18: 00", "18: 15", 
															"18: 30", "18: 45", "19: 00", "19: 15", "19: 30", "19: 45", "20: 00", "20: 15", "20: 30", "20: 45", 
															"21: 00", "21: 15", "21: 30", "21: 45", "22: 00",);
										for ($i = 0; $i < 25; $i ++) {
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
								for($i = 0; $i < 13; $i++) {
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
							<div id="drawSchedule"></div>
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

