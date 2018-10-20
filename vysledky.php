<!DOCTYPE html>
<html>
<head>
</head>
<body onLoad="getStatisticTable()">
<table id="myTable">
  <tr>
    <th>NAME</th> 
    <th>SCORE<button onclick="sortTable(1)">Sort</button></th>
  </tr>
<?php 
include 'getScore.php';
include 'dbconnect.php';
$answersSql = "SELECT * FROM answers";
$answersQuery = mysqli_query($conn, $answersSql);

if (!$answersQuery) {die ('SQL Error: ' . mysqli_error($conn));}

while ($answerRow = mysqli_fetch_array($answersQuery)) {
	echo "<tr>
    		<td>".$answerRow['name']."</td>
    		<td>". round(getScore($answerRow['name']))."</td>
		 </tr>";
    }
mysqli_close($conn);
?>
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
    document.getElementById("max").innerHTML ="MAX="+ Math.max(...array_scores);
    document.getElementById("min").innerHTML ="MIN="+ Math.min(...array_scores);
    document.getElementById("avg").innerHTML ="AVG="+sum/array_scores.length;

}
//todo čas jak dlouho a kdy přidat do tabulky ... a udělat gaf https://jpgraph.net/features/src/show-example.php?target=new_bar1.php
</script>
<p id="max"></p>
<p id="min"></p>
<p id="avg"></p>
</body>
</html>