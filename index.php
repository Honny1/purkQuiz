<?php include "header.php" ?>
<title>Quiz</title>
<meta property="og:title" content="Quiz" />
<meta property="og:type" content="website" />
<meta property="og:image" content="https://buchticka.eu/quiz/background.jpg" />
<meta property="og:description" content="Quiz about IT" />  
<script>
var userAnswers = "";

function getNewQuestionFromDatabase(str) {
        if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        } else {
            // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("txtHint").innerHTML = this.responseText;
            }
        };
        xmlhttp.open("GET","onlyGodKnowHowItWorks.php?idQuestion="+str,true);
        xmlhttp.send();
    }

function saveUserAnswers(userAnswer) {
	var date = new Date();
    var ms = date.getTime();
    if (userAnswer!=0) {
        userAnswers+=userAnswer+","+ms+",";
    }else{
  	     userAnswers+=ms+",";
  }
}  

function saveAnswersToDatabase() {
    if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        } else {
            // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("txtHint").innerHTML = this.responseText;
            }
        };
        var date = new Date();
        var ms = date.getTime();
        var newMs= ms-1540153340000;
        xmlhttp.open("GET","onlyGodKnowHowSaveUser.php?userAnswers="+"user"+newMs+","+userAnswers,true);
        xmlhttp.send();
}
var check=true;
var timerId;
function progressCountdown(timeleft) {
    var elem = document.getElementById('countdown');
    var timerId = setInterval(countdown, 1000);

    function countdown() {
    if (check) {
        if (timeleft == -1) {
            clearTimeout(timerId);
            end();
            check=true;
        } else {
            if (timeleft!=10) { document.getElementById("countdown").innerHTML = timeleft;}
            timeleft--;
    }}else{
        clearTimeout(timerId);
        check=true;
    }
}

}
function stopCountdown() {
    check=false;
}   
function end(){
    document.getElementById('NaN').click();
}
</script>
</head>
<body style="background-color: transparent;">
    <center>
        <div id="txtHint">
            <div class='gamePin'>
                <div style='background-color: rgba(255, 255, 255, 0.75);' class='mui-panel'>
                        <h1>Začít hrát</h1>
                        <h3>Stikni tlačítko a hrej!</h3>
                        <button style='font-size: 160%;' class='startStopButtton mui-btn mui-btn--primary mui-btn--raised' name="buttonAnswer" value="1" onClick="getNewQuestionFromDatabase(this.value);saveUserAnswers(0);progressCountdown(10)"><!--<button style='height: 15000%;' name="buttonAnswer"class='mui-btn mui-btn--primary mui-btn--raised' value="1" onClick="getNewQuestionFromDatabase(this.value);saveUserAnswers(0);progressCountdown(10)">-->Play</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </center>
<?php include 'footer.php';