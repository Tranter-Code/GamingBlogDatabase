<?php
    session_start();
?>

<!doctype html>
<html lang=eng>
    <head>
        <title>21187515 Gaming Blog</title>
        <link rel="stylesheet" href="styles/main.css">
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
    </head>
    <body>
        <header>
            <nav>
                <div class="nav_bar">

                    <h1 class="logo_temp">Gaming Blog</h1>

                    

                    <ul>
                    <li><a class="nav_button" href="index.php">Home</a></li>
                        <?php
                        if(isset($_SESSION['user_ID'])) {
                            echo '<li><a class="nav_button" href="profile.php">Profile</a></li>
                            <li><a class="nav_button" href="includes/logout.php">Log Out</a></li>';
                        }
                        else {
                            echo '<li><a class="nav_button" href="signup.php">Sign Up</a></li>
                            <li><a class="nav_button" href="login.php">Login</a></li>';
                        }
                        ?>
                    </ul>
                    <?php 
                        if(isset($_SESSION['user_ID'])) { ?>
                            <h1 class="logged_in">
                                Logged in as: 
                                <?= $_SESSION["username"]; ?>
                            </h1>
                        <?php
                            }
                        ?>
                        
                </div>
            </nav>
        </header>
