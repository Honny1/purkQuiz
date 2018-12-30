<?php
   include(realpath($_SERVER['DOCUMENT_ROOT']).'/controlDatabase/dbConnect.php');
   $error="";
   
   if($_SERVER["REQUEST_METHOD"] == "POST") {
      
     $query = "SELECT * FROM user";
     $result = $conn ->query($query);
     $hodnota=False;
     if (mysqli_num_rows($result)>0){
	        while($row = mysqli_fetch_assoc($result)){
                if ($row["username"]==$_POST["username"] && $row["password"]==$_POST["password"]) {
                  $hodnota = true;
                }
            }
     }
     if($hodnota) {
        header("location: game.php?username=".$_POST["username"]);
     }else{
         $error = "Your Login Name or Password is invalid";
     }
     mysqli_close($conn);
   }
?>
<html>
   
   <head>
      <title>QUIZ</title>
      <meta http-equiv="content-type" content="text/html; charset=utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <link href="//cdn.muicss.com/mui-0.9.41/css/mui.min.css" rel="stylesheet" type="text/css" />
      <script src="//cdn.muicss.com/mui-0.9.41/js/mui.min.js"></script> 
      <link rel="shortcut icon" type="image/png" href="images/favicon.png"/>
      <link rel="stylesheet" type="text/css" href="css/style.css">  
   </head>
   
   <body>
      <h1>WELCOME IN QUIZ</h1>
      <div align = "center" style = "background-color:">
         <div style = "width:300px; border: solid 1px #000000; " align = "left">
            <div style = "background-color:#000000; color:#FFFFFF; padding:3px;"><b>Login</b></div>
            <div style = "margin:30px">
               <form class="mui-form--inline" action = "" method = "post">
                  <label>UserName:</label><div class="mui-textfield"><input type = "text" name = "username" class = "box" required/></div><br /><br />
                  <label>Password:</label><div class="mui-textfield"><input type = "password" name = "password" class = "box" required/></div><br/><br />
                  <input class="mui-btn mui-btn--flat" type = "submit" value = "Confirm"/><br />
               </form>
               <div style = "font-size:11px; color:#cc0000; margin-top:10px"><?php echo $error; ?></div>
            </div>				
         </div>
      </div>
      <br/>
      <p>By: Hony</p>
   </body>
</html>