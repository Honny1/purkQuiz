 <?php
include $_SERVER['DOCUMENT_ROOT'].'globalVar/variables.php';
?>
<!doctype html>
<html>
 <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Chrome, Firefox OS and Opera -->
    <meta name="theme-color" content="<?php print($themeColor); ?> ">
    <!-- Windows Phone -->
    <meta name="msapplication-navbutton-color" content="<?php print($themeColor); ?> ">
    <!-- iOS Safari -->
    <meta name="apple-mobile-web-app-status-bar-style" content="<?php print($themeColor); ?> ">

    <!-- load STYLES -->
    <link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon">
    <link href="/styles/style.css" rel="stylesheet" type="text/css" />
    <link href="/styles/mui.css" rel="stylesheet" type="text/css" />
    <script src="/styles/mui.min.js"></script>
    <!-- SHARING -->
    <meta property="og:url" content="quiz.buchticka.eu/<?php print($_SERVER['REQUEST_URI']); ?>" />
    <!-- STYLES -->
    <style type="text/css">
        .footer{
            /*width: 100%; */
            background-color: rgba(255, 255, 255, 0.75); /* transparent;*/
            position: fixed;
            /*top: 20%;*/
            bottom: 0%;
            left:  30%;
            right: 30%;
            -webkit-box-shadow: 0 2px 2px 0 rgba(0, 0, 0, 0.16), 0 0px 2px 0 rgba(0, 0, 0, 0.12);
            box-shadow: 0 2px 2px 0 rgba(0, 0, 0, 0.16), 0 0px 2px 0 rgba(0, 0, 0, 0.12);
        }
    </style>
    