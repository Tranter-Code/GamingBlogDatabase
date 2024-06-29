<?php
    include_once 'header.php';
?>

<?php
    include_once 'includes/connect.php';
?>

<!-- Main webpage box-->
<div class="main">

<!-- Show New Post Button if a user is signed in-->
    <?php
        if(isset($_SESSION['user_ID'])) {           
            include_once 'post.btn.php';    
        }
    ?>

    <h2 class="main_heading">
        All Posts
    </h2>

<!--Print boxes of posts - if any-->
    <?php
       
        $sql = "SELECT posts.post_ID, posts.user_ID, posts.post_main, posts.post_title, posts.date_posted, game_genres.genre_name, users.username
        FROM posts
        INNER JOIN game_genres ON game_genres.genre_ID = posts.genre_ID
        INNER JOIN users ON users.user_ID = posts.user_ID
        ORDER BY posts.date_posted DESC"; 

        $result = $conn->query($sql);
        $conn->close();

        while ($row = $result->fetch_assoc()) {
            ?>
            <div class='post_box'> 
                <p class='post_title'>
                    <?= $row['post_title'] ?> 
                </p>
                <p class='post'>
                    <?= $row['post_main'] ?> 
                </p>
                <div class="post_info">
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
                </div>
            </div>     
        <?php 
            }
        ?>

</div>

<?php
    include_once 'footer.php';
?>

