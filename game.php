<?php include realpath($_SERVER['DOCUMENT_ROOT']).'/htmlParts/header.php' ?>
<title>Quiz</title>
<meta property="og:title" content="Quiz" />
<meta property="og:type" content="website" />
<meta property="og:image" content="/images/background.jpg" />
<meta property="og:description" content="Quiz about IT" />  
<script>
var userAnswers = "";

function getNewQuestionFromQuestionSet(str) {
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
        xmlhttp.open("GET","controlDatabase/showQuestion.php?indexOfQuestion="+str,true);
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
        // var date = new Date();
        // var ms = date.getTime();
        //var newMs= ms-1540194340000;
        xmlhttp.open("GET","controlDatabase/saveUser.php?userAnswers=" + 
            <?php 
                if (isset($_GET["username"])){
                    echo "\"".$_GET['username']."\"";
                }else{
                    //echo "\"user\"+newMs";
                    echo "\"Player\"";
                }
            ?> + "," + userAnswers,true);
        xmlhttp.send();
}
var check=true;
var timerId;
function progressCountdown(timeleft) {
    var elem = document.getElementById('countdown');
    var timerId = setInterval(countdown, 1000);

    function countdown() {
    if(navigator.onLine){
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
    }} else {
                alert('offline');
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
                        <p style="color: red;"><strong>Pozor! na každnou otázku máš PŘIBLIŽNĚ 10s.</strong></p>
                        <button style='font-size: 160%;' id='play' class='startStopButtton mui-btn mui-btn--primary mui-btn--raised' name="buttonAnswer" value='0' onClick="getNewQuestionFromQuestionSet(this.value);saveUserAnswers(0);progressCountdown(10)">Play</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </center>
<?php include realpath($_SERVER['DOCUMENT_ROOT']).'/htmlParts/footer.php';