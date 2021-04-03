<?php
include('./controlDatabase/dbConnect.php');
$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

   $query = "SELECT * FROM user";
   $result = $conn->query($query);
   $hodnota = False;
   if (mysqli_num_rows($result) > 0) {
      while ($row = mysqli_fetch_assoc($result)) {
         if ($row["username"] == $_POST["username"] && $row["password"] == $_POST["password"]) {
            $hodnota = true;
         }
      }
   }
   if ($hodnota) {
      if ($_POST['username'] == 'test' && $_POST['password'] == 'test') {
         $conn->query("DELETE FROM `rank` WHERE `rank`.`user_name` = 'test';");
         $conn->query("DELETE FROM `answers` WHERE `answers`.`name` = 'test';");
      }
      header("location: game.php?username=" . $_POST["username"]);
   } else {
      $error = "Your Login Name or Password is invalid";
   }
   $conn->close();
}
include './htmlParts/header.php' ?>
</head>

<body style="background-color: transparent; ">
   <h1 style="text-align: center; ">WELCOME TO QUIZ</h1>
   <div align="center" style="background-color: transparent; ">
      <div style="width: 500px; " align="left">
         <div style="background-color: #000000; color:#FFFFFF; padding:3px; text-align: center; font-size: 111%; ">
            <b>Login</b>
         </div>
         <div class="mui-panel" style="background-color: rgba(255, 255, 255, 0.7); padding-left:30px; padding-right:30px; ">
            <form class="mui-form--inline" action="" method="post">
               <table style="width: 100%; ">
                  <tr>
                     <td>
                        <div class="mui-textfield  mui-textfield--float-label" style="width: 100%; ">
                           <input class="box" type="text" name="username" required>
                           <label style="text-align: center; ">Nick</label>
                        </div>

                     </td>
                  </tr>
                  <tr>
                     <td>
                        <div class="mui-textfield  mui-textfield--float-label" style="width: 100%; ">
                           <input class="box" type="password" name="password" required>
                           <label style="text-align: center; ">Password</label>
                        </div>
                     </td>
                  </tr>
               </table>
               <br />
               <br />
               <center><input style-"color: red;" class="mui-btn mui-btn--flat" type="submit" value="OK" /></center>
            </form>
            <?php
            if ($error != "") {
               echo "
				<div style = \"font-size:11px; color:#cc0000; margin-top:10px\">
					$error
				</div>";
            }
            ?>
         </div>
      </div>
      <?php include './htmlParts/footer.php' ?>
</body>

</html>