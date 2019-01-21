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
        xmlhttp.open("GET","controlDatabase/showQuestion.php?indexOfQuestion="+str+"&name="+
            <?php 
                if (isset($_GET["username"])){
                    echo "\"".$_GET['username']."\"";
                }else{
                    echo "\"Player\"";
                }
            ?>,true);
        xmlhttp.send();
    }

function saveUserAnswers(userAnswer) {
    var date = new Date();
    var ms = date.getTime();
    if (userAnswer != 0) {
        userAnswers += userAnswer + "," + ms + ",";
    }else{
  	     userAnswers += ms + ",";
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
        xmlhttp.open("GET","controlDatabase/saveUser.php?userAnswers=" + 
            <?php 
                if (isset($_GET["username"])){
                    echo "\"".$_GET['username']."\"";
                }else{
                    echo "\"Player\"";
                }
            ?> + "," + userAnswers, true);
        xmlhttp.send();
}

var check = true;
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
                    check = true;
                } else {
                    if (timeleft!=10) {
                        document.getElementById("countdown").innerHTML = timeleft;
                    }
                    timeleft--;
                }
            } else{
                clearTimeout(timerId);
                check = true;
            }
        } else {
                alert('offline');
        }
    }

}

function stopCountdown() {
    check = false;
}   

function end(){
    document.getElementById('NaN').click();
}

</script>
</head>
<body style="background-color: transparent;">
    <center>
        <canvas id="canvasForMatrix" scrolling="no"></canvas>
        <div id="txtHint">
            <div class="gamePin">
                <div style='background-color: rgba(255, 255, 255, 0.75);' class='mui-panel'>
                    <h1>Začít hrát</h1>
                    <h3>Stikni tlačítko a hrej!</h3>
                    <h2 style="color: red;">Pozor!</h2> 
                    <p style="font-size: 130%;" >Na každnou otázku máš PŘIBLIŽNĚ 10s.</p>
                    <button style='font-size: 160%;' id='play' class='startStopButtton mui-btn mui-btn--primary mui-btn--raised' name="buttonAnswer" value='0' onClick="getNewQuestionFromQuestionSet(this.value);saveUserAnswers(0);progressCountdown(10)">Play</button>
                    </div>
                </div>
            </div>
        </div>
    </center>
    <script>
        var c = document.getElementById("canvasForMatrix");
        var ctx = c.getContext("2d");
        
        //making the canvas full screen
        c.height = (window.innerHeight);
        c.width = (window.innerWidth);

        //chinese characters - taken from the unicode charset
        var chinese = "01110000 01100001 01110011 01110011 01110111 01101111 01110010 01100100";
        //converting the string into an array of single characters
        chinese = chinese.split("");

        var font_size = 10;
        var columns = c.width/font_size; //number of columns for the rain
        //an array of drops - one per column
        var drops = [];
        //x below is the x coordinate
        //1 = y co-ordinate of the drop(same for every drop initially)
        for(var x = 0; x < columns; x++)
            drops[x] = 1; 

        //drawing the characters
        function draw()
        {
            //Black BG for the canvas
            //translucent BG to show trail
            ctx.fillStyle = "rgba(0, 0, 0, 0.05)";
            ctx.fillRect(0, 0, c.width, c.height);
            
            ctx.fillStyle = "#0F0"; //green text
            ctx.font = font_size + "px arial";
            //looping over drops
            for(var i = 0; i < drops.length; i++)
            {
                //a random chinese character to print
                var text = chinese[Math.floor(Math.random()*chinese.length)];
                //x = i*font_size, y = value of drops[i]*font_size
                ctx.fillText(text, i*font_size, drops[i]*font_size);
                
                //sending the drop back to the top randomly after it has crossed the screen
                //adding a randomness to the reset to make the drops scattered on the Y axis
                if(drops[i]*font_size > c.height && Math.random() > 0.975)
                    drops[i] = 0;
                
                //incrementing Y coordinate
                drops[i]++;
            }
        }

        setInterval(draw, 33);
    </script>
<?php include realpath($_SERVER['DOCUMENT_ROOT']).'/htmlParts/footer.php';?>
