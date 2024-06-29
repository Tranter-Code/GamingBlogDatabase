<?php
    include_once 'header.php';
?>

<?php
    include_once 'includes/connect.php';
?>

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

<!-- Check if a comment_ID is set.
If not, redirect to the index page-->
<?php
    if(!isset($_GET['comment_ID']) && !isset($_GET['post_ID'])) {
        header("Location: index.php");
    }
    else{
        $selected_comment_ID = $_GET['comment_ID'];
        $commented_post_ID = $_GET['post_ID'];
    }
?>

<!-- Main webpage box-->
<div class="main">

    <?php
        $sql = "SELECT posts.post_title, posts.post_main, posts.date_posted, posts.post_ID, game_genres.genre_name, users.username
        FROM posts
        INNER JOIN game_genres ON game_genres.genre_ID = posts.genre_ID
        INNER JOIN users ON users.user_ID = posts.user_ID
        WHERE posts.post_ID = $commented_post_ID";

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
        </div>
    </div>

    <h2 class="main_heading">
        Comment
    </h2>

    <div class="signup_login">
        <?php
            $sql = "SELECT comments.comment_ID, comments.comment_main
            FROM comments
            WHERE comments.comment_ID = $selected_comment_ID";

            $result = $conn->query($sql);
            $row = $result->fetch_assoc();
        ?>

        <h2 class="form_heading">
            Editing Your Comment
        </h2>
        <form action="editComment.php?comment_ID=<?php echo $_GET['comment_ID']?>&&post_ID=<?php echo $_GET['post_ID']?>" method="post" name="form1">
            <textarea class="comment_txt" type="post" name="comment_main" placeholder="Comment Here..." required><?php echo $row['comment_main']?></textarea>
            <div id="button">
                <button type='submit' name='submit'> Update Comment </button>
            </div>
            <div id="del_button">
                <button id='delete_button' type='delete' name='delete'> Delete Comment </button>
            </div>
            <?php
                if(isset($_POST['submit'])) {

                    $comment_main_update = $_POST['comment_main'];

                    $sql = "UPDATE comments
                    SET comment_main='$comment_main_update'
                    WHERE comment_ID = $selected_comment_ID";
                    $result = $conn->query($sql);

                    if ($result) {
                        header("Location: postMain.php?post_ID=$commented_post_ID");
                    }
                    else {
                        echo "<section class='error_msg'><strong>Error: </strong> Something Went Wrong. <br><br> Please try again.</section>";
                    }
                }

                if (isset($_POST["delete"])) {

                    echo
                        "<section class='confirm_del_msg'>
                        <p>
                            Are you sure you want to delete this comment?
                        </p>
                        <div id='del_button'>
                            <button id='delete_button' type='delete' name='confirm'> Confirm Delete </button>
                        </div>
                        </section>";

                }

                if (isset($_POST["confirm"])) {

                    $sql = "DELETE FROM comments
                        WHERE comment_ID = $selected_comment_ID";
                    $result = $conn->query($sql);

                    if ($result) {
                        header("Location: postMain.php?post_ID=$commented_post_ID");
                    } else {
                        echo "<section class='error_msg'><strong>Error: </strong> Something Went Wrong. <br><br> Please try again.</section>";
                    }
                }
            ?>
        </form>

    </div>

</div>

<?php
    include_once 'footer.php';
?>