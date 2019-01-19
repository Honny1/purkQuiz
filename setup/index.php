
    <?php include realpath($_SERVER['DOCUMENT_ROOT']).'/htmlParts/header.php'; ?>
    <title>Setup page - Quiz</title>
    <meta property="og:title" content="Setup page - Quiz" />
    <meta property="og:type" content="website" />
    <meta property="og:image" content="https://quiz.buchticka.eu/images/background.jpg" />
    <meta property="og:description" content="Here you can make Quiz working!" />
  
</head>
<body style="background-color: transparent;">
    <div class="dashboardContent" >
        <center>
            <div style="background-color: rgba(255, 255, 255, 0.75);" class="mui-panel">
                <h1>Setup of Quiz</h1>
                <h2>Welcome</h2>
                <?php
                    include realpath($_SERVER['DOCUMENT_ROOT']).'/setup/dbCredentials.php';
                    // Try to create database
                    try{
                        // Create connection to database server without setting database and check connection
                        $conn = new mysqli($servername,$username,$password); 
                        if($conn->connect_error){
                            die($conn->connect_error);
                        }
                        
                        // Check encoding
                        $conn -> set_charset("UTF8") or die("Bad encoding!");
                        
                        // Create database
                        if ($conn->query("CREATE DATABASE IF NOT EXISTS $dbname;") === TRUE) {
                            echo "<h3>Database created successfully</h3>";
                            $conn->close(); // disconnect
                        } else {
                            echo "<h2 style='color: red; '>Error creating database: " . $conn->error . "</h2>";
                        }

                        // Create connection to database server and database and check connection
                        $conn = new mysqli($servername,$username,$password,$dbname); 
                        if($conn->connect_error){
                            die($conn->connect_error);
                        }
                        
                        // Check encoding
                        $conn -> set_charset("UTF8") or die("Bad encoding!");

                        echo "  <div style='background-color: rgba(240, 255, 220, 0.75); '>
                                    <h3 style='color: limegreen; '>Successfully connected to database called `$dbname`.</h3>
                                </div>";
                        // Disconnect
                        $conn->close();
                    }catch (Exception $e){
                        echo "<h2 style='color: red; '>Error : ".$e."</h2>";
                    }
                    
                    // Try to create table with attributors
                    try{
                        // Name of imported file
                        $filename = 'quiz.sql';
                    
                        // Temporary variable, used to store current query
                        $templine = '';
                        
                        // Read in entire file
                        $lines = file($filename);
                        
                        // Loop through each line
                        foreach ($lines as $line){
                            // Skip it if it's a comment
                            if (substr($line, 0, 2) == '--' || $line == ''){
                                continue;
                            }
                            
                            // Add this line to the current segment
                            $templine .= $line;
                            
                            // If it has a semicolon at the end, it's the end of the query
                            if (substr(trim($line), -1, 1) == ';'){
                                // Perform the query
                                $conn->query($templine) or echo "<div style='background-color: rgba(255, 220, 220, 0.75); '> Error performing query '<strong style='color: red; '>" . $templine . "': " . $conn->error . "<br /><br /></strong></div>";
                            
                                // Reset temp variable to empty
                                $templine = '';
                            }
                        }
                         echo " <div style='background-color: rgba(240, 255, 220, 0.75); '>
                                    <h3 style='color: limegreen; '>Tables imported successfully to database named `$dbname`.</h3>
                                </div>";
                    }catch (Exception $e){
                        echo "<h2 style='color: red; '>Error: $e</h2>";
                    }
                    $conn->close();
                ?>
                <p>Please delete folder folder "/setup"!</p>
            </div>
        </center>
    </div>
<?php include realpath($_SERVER['DOCUMENT_ROOT']).'/htmlParts/footer.php';?>
