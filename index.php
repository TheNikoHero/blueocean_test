<?php

include('include/config.php'); // the database connection file, in config.php, 
// it also includes/require_once, the various class files.

// fail parameters
$failed = $_GET['f']; // failed-something
$succes = $_GET['s']; // succed something

$getCnt = $_GET['cnt']; // cnt for content, checking if the URL has various 'cnt' values
?>
<html>
    <head>
        <title>Nikolaj test site</title>
        <meta charset="UTF-8">
         <meta name="viewport" content="width=device-width, user-scalable=no,initial-scale=1.0, minimum-scale=1.0, maximum-scale=2.0" />
        <base href="http://testdev.nwlauritsen.com/"> <!-- Base makes sure that the .htacces file can read through your pages -->
                <link href="style/style.css" rel="stylesheet" type="text/css"/> 
    </head>
    <body>
                <div id="overlay"></div>
        <header>
            <div class="header_wrapper">
                <div id="title_tagline">
                    <h1>Imageboard website</h1>
                    <p>Psst! Click on the images!</p>
                </div>
                <nav>
                    <ul>
                        <li><a href="/pages/home">View</a></li>
                        <li><a href="/pages/create">Upload</a></li>
                    </ul>
                </nav>
            </div>
            <div class="clear"></div>
        </header>

        <div id="wrapper">
            <div class="content">
                
                <?php
                switch ($getCnt) {
                    //the homepage
                    case 'home':
                        include('pages/home.php');
                        break;

                    //the create page
                    case 'create':
                        include('pages/create.php');
                        break;

                    default:
                        include('pages/home.php');
                        break;
                    }
                ?>
            </div>

        </div>
                  <script src="https://code.jquery.com/jquery-1.10.2.js"></script>
        <script src="js/core.js" type="text/javascript"></script>
    </body>
</html>


