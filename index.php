<html>
<head>
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
        xmlhttp.open("GET","onlyGodKonwHowItWorks.php?idQuestion="+str,true);
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
        xmlhttp.open("GET","onlyGodKonwHowSaveUser.php?userAnswers="+"user"+ms+","+userAnswers,true);
        xmlhttp.send();
}
</script>
</head>
<body>
<div id="txtHint"><button value="1" onClick="getNewQuestionFromDatabase(this.value);saveUserAnswers(0)">START</button></div>
</body>
</html>