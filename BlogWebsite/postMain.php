<?php
    include_once 'header.php';
?>

<?php
    include_once 'includes/connect.php';
?>

<!-- Check if a post_ID is set.
If not, redirect to the index page-->
<?php
    if(!isset($_GET['post_ID'])) {
        header("Location: index.php");
    }
    else{
        $selected_post_ID = $_GET['post_ID'];
    }
?>

<!-- Show New Comment Button if a user is signed in-->
<?php
    if(isset($_SESSION['user_ID'])) {
        $active_usr = $_SESSION['user_ID'];
        $active_usr_type = $_SESSION['user_type_ID'];   
        include_once 'comment.btn.php';    
    }
    elseif (!isset($_SESSION['user_ID'])) {
        $active_usr = "";
        $active_usr_type = "";
    }
?>

<!-- Main webpage box-->
<div class="main">

    <?php
    $sql = "SELECT posts.post_title, posts.post_main, posts.date_posted, posts.post_ID, game_genres.genre_name, users.username, users.user_ID
        FROM posts
        INNER JOIN game_genres ON game_genres.genre_ID = posts.genre_ID
        INNER JOIN users ON users.user_ID = posts.user_ID
        WHERE posts.post_ID = $selected_post_ID";

        $result = $conn->query($sql);
        $post_data = $result->fetch_assoc();
    ?>

    <div class='main_post_box'> 
        <p class='post_title'>
            <?= $post_data['post_title'] ?> 
        </p>
        <p class='post_big'>
            <?= $post_data['post_main'] ?> 
        </p>
        <div class="post_info">
            <p class='posted_usr'>
                Posted by: 
                <?= $post_data["username"] ?>
            </p>
            <p class='posted_genre'>
                Game Genre: 
                <?= $post_data["genre_name"] ?>
            </p>
            <p class='date_posted'>
                Posted on: 
                <?= date("d.m.y", strtotime($post_data['date_posted'])) ?>
            </p>
            <?php
                if ($active_usr_type == "1") { ?>
                    <a class="main_edit_post_btn" href="editPost.php?post_ID=<?php echo $selected_post_ID ?>"><strong> ADMIN: </strong>[Edit Post] </a>
                    <?php
                }
                elseif ($active_usr == $post_data['user_ID']) { ?>
                    <a class="main_edit_post_btn" href="editPost.php?post_ID=<?php echo $selected_post_ID ?>"> [Edit Post] </a>
                    <?php
                } 
            ?>
        </div>
    </div>

    <h2 class="main_heading">
        Comments
    </h2>
    <?php
    $sql = "SELECT comments.comment_main, comments.date_commented, comments.comment_ID, comments.post_ID, users.username, users.user_ID
        FROM comments
        INNER JOIN users ON users.user_ID = comments.user_ID
        WHERE comments.post_ID = $selected_post_ID
        ORDER BY comments.date_commented DESC";

        $result = $conn->query($sql);
        $conn->close();

        while ($row = $result->fetch_assoc()) {
            ?>
            <div class='comment_box'> 
                <p class='comment'>
                    <?= $row['comment_main'] ?> 
                </p>
                <div class="comment_info">
                    <p class='commented_usr'>
                        Commenter: 
                        <?= $row["username"] ?>
                    </p>
                    <p class='date_commented'>
                        Commented on: 
                        <?= date("d.m.y", strtotime($row['date_commented'])) ?>
                    </p>
                </div>
                <?php 
                    if ($active_usr_type == "1") { ?>
                        <a class="edit_btn" href="editComment.php?comment_ID=<?php echo $row['comment_ID']?>&&post_ID=<?php echo $row['post_ID']?>"><strong> ADMIN: </strong> [Edit] </a>
                        <?php
                    }
                    elseif ($active_usr == $row['user_ID']) { ?>
                        <a class="edit_btn" href="editComment.php?comment_ID=<?php echo $row['comment_ID']?>&&post_ID=<?php echo $row['post_ID']?>"> [Edit] </a>
                    <?php
                    } 
                ?>
            </div>     
        <?php 
            }
        ?>


</div>

<?php
    include_once 'footer.php';
?>