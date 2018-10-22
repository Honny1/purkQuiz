
    <?php //include "../header.php" ?>
    <title>Results of Quiz</title>
    <meta http-equiv="refresh" content="15;url=./marek.php">
    <meta property="og:title" content="Results of Quiz" />
    <meta property="og:type" content="website" />
    <meta property="og:image" content="https://buchticka.eu/quiz/background.jpg" />
    <meta property="og:description" content="Results of Quiz about IT" />

    <style type="text/css">
        html{
            background-color: black;
            background-image: none;
            color: greenyellow;
            text-align: center;
        }
        table{
            text-align: center;
        }
        th{
            text-align: center;
        }
        td{
            text-align: center;
        }
    </style>
  
</head>
<body style="min-width: 500px; background-color: transparent; font-family: Trebuchet MS; text-align: center;"><center>
      
    <div class="mui-container">
      <div style="min-width: 369px;" class="mui-panel">
        <h1>Výsledky quizu</h1>
        <h2>Četnost odpovědí u jednostlivých otázek</h2>
        <div id="chartContainer" style="height: 370px;"></div>
        <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
        <table class="mui-table mui-table--bordered">
            <thead>
                <th style="text-align: center; width: 33%;">Max</th>
                <th style="text-align: center; width: 33%;">Min</th>
                <th style="text-align: center; width: 33%;">Avg</th>
            </thead>
            <tbody>
                <td id="max"></td>
                <td id="min"></td>
                <td id="avg"></td>
            </tbody>
        </table>

        <table id="myTable" class="mui-table mui-table--bordered">
            <thead>
                <tr>
                    <th style="text-align: center;">Name</th>
                    <th style="text-align: center; min-width: 110px;">Score</th>
                    <th style="text-align: center; width: 60px;">AQ1</th> 
                    <th style="text-align: center; width: 60px;">AQ2</th> 
                    <th style="text-align: center; width: 60px;">AQ3</th> 
                    <th style="text-align: center; width: 60px;">AQ4</th> 
                    <th style="text-align: center; width: 60px;">AQ5</th> 
                    <th style="text-align: center; width: 60px;">AQ6</th> 
                    <th style="text-align: center;">Time</th> 
                </tr>
            </thead>
            <tbody>
            <?php 
                include '../getScore.php';
                include '../dbconnect.php';
                $answersSql = "SELECT * FROM answers ORDER BY ID DESC";
                $answersQuery = mysqli_query($conn, $answersSql);

                if (!$answersQuery) {die ('SQL Error: ' . mysqli_error($conn));}

                while ($answerRow = mysqli_fetch_array($answersQuery)) {
                    echo "<tr>
                            <td>".$answerRow['name']."</td>
                            <td>". round(getScore($answerRow['name']))."</td>
                            <td>".$answerRow['AQ1']."</td>
                            <td>".$answerRow['AQ2']."</td>
                            <td>".$answerRow['AQ3']."</td>
                            <td>".$answerRow['AQ4']."</td>
                            <td>".$answerRow['AQ5']."</td>
                            <td>".$answerRow['AQ6']."</td>
                            <td>".bcdiv(bcsub($answerRow['timeAQ3'],$answerRow['startTime']),'1000',2) ."s</td>
                         </tr>";
                    }
                mysqli_close($conn);
            ?>
            </tbody>
        </table>

        <script>
            function sortTable(n) {
              var table, rows, switching, i, x, y, shouldSwitch, dir, switchcount = 0;
              table = document.getElementById("myTable");
              switching = true; 
              dir = "asc"; 
              
              while (switching) {
               
                switching = false;
                rows = table.rows;
               
                for (i = 1; i < (rows.length - 1); i++) {
                  
                  shouldSwitch = false;
                  
                  x = rows[i].getElementsByTagName("TD")[n];
                  y = rows[i + 1].getElementsByTagName("TD")[n];
                  
                  if (dir == "asc") {
                    if (x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) {
                      
                      shouldSwitch= true;
                      break;
                    }
                  } else if (dir == "desc") {
                    if (Number(x.innerHTML.toLowerCase()) < Number(y.innerHTML.toLowerCase())) {
                      shouldSwitch = true;
                      break;
                    }
                  }
                }
                if (shouldSwitch) {
                  rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
                  switching = true;
                  switchcount ++;      
                } else {
                  if (switchcount == 0 && dir == "asc") {
                    dir = "desc";
                    switching = true;
                  }
                }
              }
            }

            function getStatisticTable() {
                var table, rows, x, rowslen,i;
                var array_scores = new Array();
                table = document.getElementById("myTable");
                rowslen = table.rows.length;
                rows = table.rows;
                for (i = 1; i < (rowslen - 1); i++) {  
                    x =rows[i].getElementsByTagName("TD");  
                    array_scores.push(Number(x[1].innerHTML.toLowerCase()));
              }
                var sum = array_scores.reduce(function(a, b) { return a + b; }, 0);
                document.getElementById("max").innerHTML =Math.max(...array_scores);
                document.getElementById("min").innerHTML =Math.min(...array_scores);
                document.getElementById("avg").innerHTML =sum/array_scores.length;

            }
            //todo čas jak dlouho a kdy přidat do tabulky a odpovedi... a udělat gaf https://jpgraph.net/features/src/show-example.php?target=new_bar1.php
            //AQ1
            function getStatisticAQ1A() {
                var table, rows, x, rowslen,i;
                var array_scores = new Array();
                var a=0;
                table = document.getElementById("myTable");
                rowslen = table.rows.length;
                rows = table.rows;
                for (i = 1; i < (rowslen - 1); i++) {  
                    x =rows[i].getElementsByTagName("TD");  
                    if (x[2].innerHTML.toLowerCase()=="a"){
                        a++;
                    }
              }      
              return a;
            }

            function getStatisticAQ1B() {
                var table, rows, x, rowslen,i;
                var array_scores = new Array();
                var a=0;
                table = document.getElementById("myTable");
                rowslen = table.rows.length;
                rows = table.rows;
                for (i = 1; i < (rowslen - 1); i++) {  
                    x =rows[i].getElementsByTagName("TD");  
                    if (x[2].innerHTML.toLowerCase()=="b"){
                        a++;
                    }
              }      
              return a;
            }
            function getStatisticAQ1C() {
                var table, rows, x, rowslen,i;
                var array_scores = new Array();
                var a=0;
                table = document.getElementById("myTable");
                rowslen = table.rows.length;
                rows = table.rows;
                for (i = 1; i < (rowslen - 1); i++) {  
                    x =rows[i].getElementsByTagName("TD");  
                    if (x[2].innerHTML.toLowerCase()=="c"){
                        a++;
                    }
              }      
              return a;
            }
            function getStatisticAQ1D() {
                var table, rows, x, rowslen,i;
                var array_scores = new Array();
                var a=0;
                table = document.getElementById("myTable");
                rowslen = table.rows.length;
                rows = table.rows;
                for (i = 1; i < (rowslen - 1); i++) {  
                    x =rows[i].getElementsByTagName("TD");  
                    if (x[2].innerHTML.toLowerCase()=="d"){
                        a++;
                    }
              }      
              return a;
            }
            //AQ2
            function getStatisticAQ2A() {
                var table, rows, x, rowslen,i;
                var array_scores = new Array();
                var a=0;
                table = document.getElementById("myTable");
                rowslen = table.rows.length;
                rows = table.rows;
                for (i = 1; i < (rowslen - 1); i++) {  
                    x =rows[i].getElementsByTagName("TD");  
                    if (x[3].innerHTML.toLowerCase()=="a"){
                        a++;
                    }
              }      
              return a;
            }

            function getStatisticAQ2B() {
                var table, rows, x, rowslen,i;
                var array_scores = new Array();
                var a=0;
                table = document.getElementById("myTable");
                rowslen = table.rows.length;
                rows = table.rows;
                for (i = 1; i < (rowslen - 1); i++) {  
                    x =rows[i].getElementsByTagName("TD");  
                    if (x[3].innerHTML.toLowerCase()=="b"){
                        a++;
                    }
              }      
              return a;
            }
            function getStatisticAQ2C() {
                var table, rows, x, rowslen,i;
                var array_scores = new Array();
                var a=0;
                table = document.getElementById("myTable");
                rowslen = table.rows.length;
                rows = table.rows;
                for (i = 1; i < (rowslen - 1); i++) {  
                    x =rows[i].getElementsByTagName("TD");  
                    if (x[3].innerHTML.toLowerCase()=="c"){
                        a++;
                    }
              }      
              return a;
            }
            function getStatisticAQ2D() {
                var table, rows, x, rowslen,i;
                var array_scores = new Array();
                var a=0;
                table = document.getElementById("myTable");
                rowslen = table.rows.length;
                rows = table.rows;
                for (i = 1; i < (rowslen - 1); i++) {  
                    x =rows[i].getElementsByTagName("TD");  
                    if (x[3].innerHTML.toLowerCase()=="d"){
                        a++;
                    }
              }      
              return a;
            }
            //AQ3
            function getStatisticAQ3A() {
                var table, rows, x, rowslen,i;
                var array_scores = new Array();
                var a=0;
                table = document.getElementById("myTable");
                rowslen = table.rows.length;
                rows = table.rows;
                for (i = 1; i < (rowslen - 1); i++) {  
                    x =rows[i].getElementsByTagName("TD");  
                    if (x[4].innerHTML.toLowerCase()=="a"){
                        a++;
                    }
              }      
              return a;
            }

            function getStatisticAQ3B() {
                var table, rows, x, rowslen,i;
                var array_scores = new Array();
                var a=0;
                table = document.getElementById("myTable");
                rowslen = table.rows.length;
                rows = table.rows;
                for (i = 1; i < (rowslen - 1); i++) {  
                    x =rows[i].getElementsByTagName("TD");  
                    if (x[4].innerHTML.toLowerCase()=="b"){
                        a++;
                    }
              }      
              return a;
            }
            function getStatisticAQ3C() {
                var table, rows, x, rowslen,i;
                var array_scores = new Array();
                var a=0;
                table = document.getElementById("myTable");
                rowslen = table.rows.length;
                rows = table.rows;
                for (i = 1; i < (rowslen - 1); i++) {  
                    x =rows[i].getElementsByTagName("TD");  
                    if (x[4].innerHTML.toLowerCase()=="c"){
                        a++;
                    }
              }      
              return a;
            }
            function getStatisticAQ3D() {
                var table, rows, x, rowslen,i;
                var array_scores = new Array();
                var a=0;
                table = document.getElementById("myTable");
                rowslen = table.rows.length;
                rows = table.rows;
                for (i = 1; i < (rowslen - 1); i++) {  
                    x =rows[i].getElementsByTagName("TD");  
                    if (x[4].innerHTML.toLowerCase()=="d"){
                        a++;
                    }
              }      
              return a;
            }

            window.onload = function () {
                getStatisticTable();
            var chart = new CanvasJS.Chart("chartContainer", {
                exportEnabled: false,
                animationEnabled: false,
                //backgroundColor: "#F5DEB3",
                backgroundColor: "rgba(255, 255, 255, 0.5)",
                title:{
                    //text: "Výsledky quizu",
                    fontFamily: "Trebuchet MS",
                    title: "",
                    titleFontColor: "rgb(173,255,47)",
                    lineColor: "rgb(173,255,47)",
                    labelFontColor: "rgb(173,255,47)",
                    tickColor: "rgb(173,255,47)"
                },
                subtitles: [{
                    //text: "Četnost odpovědí u jednostlivých otázek",
                    fontFamily: "Trebuchet MS"
                }], 
                axisX: {
                    //title: "další text co vymyslí marek"
                    title: "",
                    titleFontColor: "rgb(173,255,47)",
                    lineColor: "rgb(173,255,47)",
                    labelFontColor: "rgb(173,255,47)",
                    tickColor: "rgb(173,255,47)"
                },
                axisY: {
                    title: "",
                    titleFontColor: "rgb(173,255,47)",
                    lineColor: "rgb(173,255,47)",
                    labelFontColor: "rgb(173,255,47)",
                    tickColor: "rgb(173,255,47)"
                },
              axisY2: {
                    title: "",
                    titleFontColor: "rgb(173,255,47)",
                    lineColor: "rgb(173,255,47)",
                    labelFontColor: "rgb(173,255,47)",
                    tickColor: "rgb(173,255,47)"
                },
              
                toolTip: {
                    shared: true
                },
                legend: {
                    cursor: "pointer",
                    itemclick: toggleDataSeries
                },
                data: [{
                    type: "column",
                    name: "A",
                    showInLegend: true,      
                    yValueFormatString: "#,##0.# Units",
                    dataPoints: [
                        { label: "AQ1", y: getStatisticAQ1A()},
                        { label: "AQ2", y: getStatisticAQ2A()},
                        { label: "AQ3", y: getStatisticAQ3A()},
                        { label: "AQ4", y: 10 }
                    ]
                },
                {
                    type: "column",
                    name: "B",
                    axisYType: "secondary",
                    showInLegend: true,
                    yValueFormatString: "#,##0.# Units",
                    dataPoints: [
                        { label: "AQ1", y: getStatisticAQ1B()},
                        { label: "AQ2", y: getStatisticAQ2B()},
                        { label: "AQ3", y: getStatisticAQ3B()},
                        { label: "AQ4", y: 10 }
                    ]
                },
                {
                    type: "column",
                    name: "C",
                    axisYType: "secondary",
                    showInLegend: true,
                    yValueFormatString: "#,##0.# Units",
                    dataPoints: [
                        { label: "AQ1", y: getStatisticAQ1C()},
                        { label: "AQ2", y: getStatisticAQ2C()},
                        { label: "AQ3", y: getStatisticAQ3C()},
                        { label: "AQ4", y: 10 }
                    ]
                },
                {
                    type: "column",
                    name: "D",
                    axisYType: "secondary",
                    showInLegend: true,
                    yValueFormatString: "#,##0.# Units",
                    dataPoints: [
                        { label: "AQ1", y: getStatisticAQ1D()},
                        { label: "AQ2", y: getStatisticAQ2D()},
                        { label: "AQ3", y: getStatisticAQ3D()},
                        { label: "AQ4", y: 10 }
                    ]
                }]
            });
            chart.render();

            function toggleDataSeries(e) {
                if (typeof (e.dataSeries.visible) === "undefined" || e.dataSeries.visible) {
                    e.dataSeries.visible = false;
                } else {
                    e.dataSeries.visible = true;
                }
                e.chart.render();
            }

            }

        </script></div></div>
        <button style="display: none;" onload="sortTable(1)">MILUJU NEVIDITELNÝ TLAČÍTKA</button></center>
</body>
</html>