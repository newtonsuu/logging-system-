<!DOCTYPE>
<html>
	<head>
		<link rel="stylesheet" href="css/styles.css">
		<script type="module" src="js/ionicons.esm.js"></script>
		<script type="module" src="js/mods.js"></script>
		<script>
			// const msg=[];
			var current_step = 0; 
			var current_input_value = "";
			window.onload = function(){
				startSpeechRecognition();
			};

			function startSpeechRecognition() {
				if (!"webkitSpeechRecognition" in window) {
					document.querySelector("#recognized_speech").innerHTML = "Speech Recognition not available in this browser.";
					return;
				}

				let speechRecognition = new webkitSpeechRecognition();

				speechRecognition.continuous = true;
				speechRecognition.interimResults = true;
				speechRecognition.lang = "English";

				speechRecognition.onresult = (event) => {
					for (let i = event.resultIndex; i < event.results.length; ++i) {
						if (event.results[i].isFinal) {
							//alert(event.results[i][0].transcript.trim());
							processRecognizedSpeech(event.results[i][0].transcript.trim());
						}
					}

				};

				speechRecognition.start();
			}

			function processRecognizedSpeech(recognized_speech) {
				console.log("current step: " + current_step);
				console.log("recognized speech: " + recognized_speech)
				// document.querySelector('#a1').innerHTML = recognized_speech;
				//alert("Is the data correct? " + recognized_speech);
				// if(true){
				// 	msg.push(recognized_speech);
				// }
				// else{
					
				// z
				// document.querySelector("#recognized_speech").innerHTML = msg;
				// document.querySelector("#recognized_speech").innerHTML = recognized_speech;
				// console.log("command: " + recognized_speech);
				
				

				switch(recognized_speech) {
					case "start":
						if(current_step == 0){
							current_step = 1;
							console.log("Starting form fill up");
							document.querySelector("#instruction").innerHTML = "Started form fill up. Say 'next' to proceed.";
						}
						break;
					case "end":
						location.reload();
						break;
					case "next":
						if(current_step == 1){
							current_step = 2;
							document.querySelector(".form_1_btns .btn_next").click();
							document.querySelector("#instruction").innerHTML = "Please, say your address.";
						}
						else if(current_step == 8){
							current_step = 9;
							document.querySelector(".form_2_btns .btn_next").click();
							document.querySelector("#instruction").innerHTML = "Please, say your Age.";
						}
						break;
					case "back":
						if(current_step == 8){
							current_step = 1;
							document.querySelector(".form_2_btns .btn_back").click();
							document.querySelector("#instruction").innerHTML = "Started form fill up. Say 'next' to proceed.";
						}
					case "yes":
						if(current_step == 3){
							current_step = 4;
							document.querySelector("#address").value = current_input_value;
							document.querySelector("#instruction").innerHTML = "Please, say your time of arrival.";
						}
						else if(current_step == 5){
							current_step = 6;
							document.querySelector("#arrived").value = current_input_value;
							document.querySelector("#instruction").innerHTML = "Please, say your time of departure.";
						}
						else if(current_step == 7){
							current_step = 8;
							document.querySelector("#departed").value = current_input_value;
							document.querySelector("#instruction").innerHTML = "Please, Say 'next' to proceed or say 'back' to return";
						}
						if(current_step == 9){
							current_step = 10;
							document.querySelector("#age").value = current_input_value;
							document.querySelector("#instruction").innerHTML = "Please, say your firstname.";
						}
						break;
					case "no":
						if(current_step == 3){
							current_step = 2;
							document.querySelector("#instruction").innerHTML = "Please, say your address.";
						}
						else if(current_step == 5){
							current_step = 4;
							document.querySelector("#instruction").innerHTML = "Please, say your time of arrival.";
						}
						else if(current_step == 7){
							current_step = 6;
							document.querySelector("#instruction").innerHTML = "Please, say your time of departure.";
						}
						else if(current_step == 9){
							current_step = 8;
							document.querySelector("#instruction").innerHTML = "Please, say your age.";
						}
						break;
					
					case "hello":
						document.querySelector("#response_speech").innerHTML = "Hi!";
						break;
					case "turn blue":
						document.querySelector("#response_speech").innerHTML = "changing background to blue";
						document.body.style.backgroundColor = "blue";
						break;
					case "turn green":
						document.querySelector("#response_speech").innerHTML = "changing background to green";
						document.body.style.backgroundColor = "green";
						break;
					default:
						console.log("command not recognized: " + recognized_speech);
						if(current_step == 2){
							current_step = 3;
							current_input_value = recognized_speech;
							document.querySelector("#instruction").innerHTML = "Your address is " +
								current_input_value + ". Please say 'yes' to proceed and 'no' to retry.";
						}
						else if(current_step == 4){
							current_step = 5;
							current_input_value = recognized_speech;
							document.querySelector("#instruction").innerHTML = "Your arrived time is " +
								current_input_value + ". Please say 'yes' to proceed and 'no' to retry.";
						}
						else if(current_step == 6){
							current_step = 7;
							current_input_value = recognized_speech;
							document.querySelector("#instruction").innerHTML = "Your departed time is " +
								current_input_value + ". Please say 'yes' to proceed and 'no' to retry.";
						}
						if(current_step == 9){
							current_step = 10;
							current_input_value = recognized_speech;
							document.querySelector("#instruction").innerHTML = "Your Age is " +
								current_input_value + ". Please say 'yes' to proceed and 'no' to retry.";
						}
				}
			}

		</script>
	</head>
	<body>
		<!-- <span>Captured: <span id="recognized_speech"></span></span>
		<br>
		<span>Question: <span id="response_speech"></span></span> -->
		

	<div class="wrapper">
		<div class="header">
			<ul>
				<li class="active form_1_progessbar">
					<div>
						<p>1</p>
					</div>
				</li>
				<li class="form_2_progessbar">
					<div>
						<p>2</p>
					</div>
				</li>
				<li class="form_3_progessbar">
					<div>
						<p>3</p>
					</div>
				</li>
			</ul>
		</div>
		<div class="form_wrap">
			<div class="form_1 data_info">
				<h2>Personal Info</h2>
				<form>
					<!-- <div class="form_container">
						<div class="input_wrap">
						questionaire
						</div> -->
						<!-- <div id="a1" class="input_wrap">
						Answers here
						</div> -->
						<!-- <div class="input_wrap">
							<label for="first name">First Name</label>
							<input type="text" name="First Name" class="input" id="speech">
						</div>
						<div class="input_wrap">
							<label for="password">Middle Name</label>
							<input type="text" name="password" class="input" id="password">
						</div>
						<div class="input_wrap">
							<label for="confirm_password">Last Name</label>
							<input type="text" name="confirm password" class="input" id="confirm_password">
						</div>  -->
					<!-- </div> -->
				</form>
			</div>
			<div class="form_2 data_info" style="display: none;">
				<h2>Logging Info</h2>
				<form>
					<div class="form_container">
						<div class="input_wrap">
							<label for="address">Adress</label>
							<input type="text" name="Address" class="input" id="address">
						</div>
						<div class="input_wrap">
							<label for="arrived">Time Arrived</label>
							<input type="text" name="Time Arrived" class="input" id="arrived">
						</div>
						<div class="input_wrap">
								<label for="departed">Time Departed</label>
								<input type="text" name="Time Departed" class="input" id="departed">
							</div>
						</div>
					</form>
				</div>
				<div class="form_3 data_info" style="display: none;">
					<h2>Professional Info</h2>
					<form>
						<div class="form_container">
							<div class="input_wrap">
								<label for="age">Age</label>
								<input type="text" name="Age" class="input" id="age">
							</div>
							<div class="input_wrap">
								<label for="experience">First Name</label>
								<input type="text" name="Total Experience" class="input" id="experience">
							</div>
							<div class="input_wrap">
								<label for="designation">Last Name</label>
								<input type="text" name="Designation" class="input" id="designation">
							</div>
						</div>
					</form>
				</div>
			</div>
			<div class="btns_wrap">
				<div class="common_btns form_1_btns">
					<button type="button" class="btn_next">Next <span class="icon">
						<ion-icon name="arrow-forward-sharp"></ion-icon></span></button>
				</div>
				<div class="common_btns form_2_btns" style="display: none;">
					<button type="button" class="btn_back"><span class="icon">
						<ion-icon name="arrow-back-sharp"></ion-icon></span>Back</button>
					<button type="button" class="btn_next">Next <span class="icon">
						<ion-icon name="arrow-forward-sharp"></ion-icon></span></button>
				</div>
				<div class="common_btns form_3_btns" style="display: none;">
					<button type="button" class="btn_back"><span class="icon">
						<ion-icon name="arrow-back-sharp"></ion-icon></span>Back</button>
					<button type="button" class="btn_done">Done</button>
				</div>
			</div>
			<div class= "footer"> 
				<div id="instruction">
					Say 'start' to start fill up form
				</div>
			</div>
		</div>
	</div>
	
<div class="modal_wrapper">
	<div class="shadow"></div>
	<div class="success_wrap">
		<span class="modal_icon"><ion-icon name="checkmark-sharp"></ion-icon></span>
		<p>You have successfully completed the process. Please, say 'end' to exit fill up form.	</p>
	</div>
</div>
	</body>
	<body> </div>
</html>