<?php
//return questions to web  
    include '../htmlParts/header.php';
    include './dbConnect.php';
    include '../globalVar/variables.php';
    ?>
    <title>Prepare DB for Day D - Quiz</title>
    <meta property="og:title" content="Prepare DB for Day D - Quiz" />
    <meta property="og:type" content="website" />
    <meta property="og:image" content="http://quiz.buchticka.eu/images/background.jpg" />
    <meta property="og:description" content="DELETE answers from db" />
</head>
<body style='background-color: transparent;'>
    <div class='dashboardContent' >
        <center>
            <div style='background-color: rgba(255, 255, 255, 0.75); min-width:400px;' class='mui-panel'>
                <?php

                    $deleteAnswersQuery = mysqli_query($conn, "DELETE FROM answers; ");
                    if (!$deleteAnswersQuery) {die ('<h2>SQL Error: </h2><p>' . mysqli_error($conn).'</p>');}
                    $deleteRankQuery = mysqli_query($conn, "DELETE FROM rank;");
                    if (!$deleteRankQuery) {die ('<h2>SQL Error: </h2><p>' . mysqli_error($conn).'</p>');}
                    echo "<h2>Successfully prepared!</h2>";

                    include '../htmlParts/footer.php';
                ?>
            </div>
        </center>
    </div>
</body>
</html>