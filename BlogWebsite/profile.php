<?php
    include_once 'header.php';
?>

<?php
    include_once 'includes/connect.php';
?>

<!-- Main webpage box-->
<div class="main">

<!-- Check if a user is logged in.
If not, redirect to the login page-->
    <?php
        if(!isset($_SESSION['user_ID'])) {
            header("Location: login.php");
        }
        else{
            $active_usr = $_SESSION["user_ID"];
        }
    ?>

<!-- Print user information box-->
    <div class="section1">
        <?php
            $sql = "SELECT users.username, users.email_address, game_genres.genre_name, user_type.user_type_name
            FROM users 
            INNER JOIN game_genres ON users.genre_ID = game_genres.genre_ID
            INNER JOIN user_type ON user_type.user_type_ID = users.user_type_ID
            WHERE users.user_ID = '$active_usr'";
            $result = $conn->query($sql);
            $user_info = $result->fetch_assoc();
        ?>
        
        <div class="user_info">
            <h2 class="box_heading">
                Profile Information
            </h2>
            <p class="data_labels">
                Username: 
            </p>
            <p class="usr_data"> 
                <?= $user_info["username"] ?>
            </p>
            <br>
            <p class="data_labels">
                Email Address: 
            </p>
            <p class="usr_data"> 
                <?= $user_info["email_address"] ?>
            </p>
            <br>
            <p class="data_labels">
                Favorite Game Genre: 
            </p>
            <p class="usr_data">           
                <?= $user_info["genre_name"] ?>
            </p>
            <br>
            <p class="data_labels">
                User Type: 
            </p>
            <p class="usr_data">
                <?= $user_info["user_type_name"] ?>
            </p>
            <p class="option">
                <a class="option_link" href="edit_profile.php">Edit Profile</a>
            </p>
        </div>
    </div>

    <div class="section2">

        <h2 class="main_heading">
            Your Posts
        </h2>

        <?php
            include_once 'post.btn.php';
        ?>
            
    <!--Print boxes of posts - if any-->
        <?php
            $sql = "SELECT posts.user_ID, posts.post_ID, posts.post_main, posts.post_title, posts.date_posted, game_genres.genre_name, users.username
            FROM posts
            INNER JOIN game_genres ON game_genres.genre_ID = posts.genre_ID
            INNER JOIN users ON users.user_ID = posts.user_ID
            WHERE users.user_ID =$active_usr
            ORDER BY posts.date_posted DESC";

            $result = $conn->query($sql);
            $conn->close();

            while ($row = $result->fetch_assoc()) {
                ?>
                <div class='prfl_post_box'> 
                    <p class='post_title'>
                        <?= $row['post_title'] ?> 
                    </p>
                    <p class='post'>
                        <?= $row['post_main'] ?> 
                    </p>
                    <br>
                    <p class='posted_usr'>
                        Posted by: 
                        <?= $row["username"] ?>
                    </p>
                    <p class='posted_genre'>
                        Game Genre: 
                        <?= $row["genre_name"] ?>
                    </p>
                    <p class='date_posted'>
                        Posted on: 
                        <?= date("d.m.y", strtotime($row['date_posted'])) ?>
                    </p>
                    <a class="post_link_btn" href="postMain.php?post_ID=<?php echo $row['post_ID']?>" >Full Post</a>
                    <?php 
                        if ($_SESSION['user_ID'] == $row['user_ID']) { ?>
                            <a class="edit_btn" href="editPost.php?post_ID=<?php echo $row['post_ID'] ?>"> [Edit Post] </a>
                            <?php
                        } 
                    ?>
                </div>     
            <?php 
                }
            ?>
    </div>
        
        <br><br><br>
        
</div>

<?php
    include_once 'footer.php';
?>