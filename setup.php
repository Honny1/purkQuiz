
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
                <h1>Welcome</h1>
                <h2>Setup of Quiz</h2>
                <?php
                    try{
                        require_once realpath($_SERVER['DOCUMENT_ROOT']).'/controlDatabase/dbconnect.php';
                        echo "  <div style='background-color: rgba(240, 255, 220, 0.75); '>
                                    <h3 style='color: limegreen; '>Successfully connected to database!</h3>
                                    <p  style='color: limegreen; '>Table named `".$dbname."` is already existing.</p>
                                </div>";
                    }catch (Exception $e){
                        echo "<h2>Pozor: ".$e."</h2>";
                        // Create connection
                        $conn = new mysqli($servername,$username,$password); 
                        // Check connection
                        if($conn->connect_error){
                            die($conn->connect_error);
                        }
                        // Check encoding
                        $conn -> set_charset("UTF8") or die("Spatne kodovani!");

                        // Create database
                        $sql = "CREATE DATABASE ".$dbname."`";
                        if ($conn->query($sql) === TRUE) {
                            echo "<h3>Database created successfully</h3>";
                        } else {
                            echo "Error creating database: " . $conn->error;
                        }

                        //$conn->close();

                    }
                ?>
            </div>
        </center>
    </div>
<?php include realpath($_SERVER['DOCUMENT_ROOT']).'/htmlParts/footer.php';?>