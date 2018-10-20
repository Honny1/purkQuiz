<!DOCTYPE html>
<html>
<head>
</head>
<body>
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
</script>
</body>
</html>