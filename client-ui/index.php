<html>
	<head>
		<link rel="stylesheet" href="css/styles.css">
		<script>
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
							processRecognizedSpeech(event.results[i][0].transcript.trim());
						}
					}

				};

				speechRecognition.start();
			}

			function processRecognizedSpeech(recognized_speech) {
				document.querySelector("#recognized_speech").innerHTML = recognized_speech;
				console.log("command: " + recognized_speech);

				switch(recognized_speech) {
					case "hello":
						document.querySelector("#response_speech").innerHTML = "Hi!";
						break;
					case "turn blue":
						document.querySelector("#response_speech").innerHTML = "changing background to blue";
						document.body.style.backgroundColor = "blue";
						break;
					default:
						console.log("command not recognized: " + recognized_speech);
				}
			}
		</script>
	</head>
	<body>
		<span>Captured Speech: <span id="recognized_speech"></span></span>
		<br>
		<span>Response: <span id="response_speech"></span></span>
	</body>
</html>