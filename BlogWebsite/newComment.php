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

<?php
    $selected_post_ID = $_GET['post_ID'];
?>

<!-- Main webpage box-->
<div class="main">

    <?php
        $sql = "SELECT posts.post_title, posts.post_main, posts.date_posted, posts.post_ID, game_genres.genre_name, users.username
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
        </div>
    </div>



    <div class="newcommentform">
        <h2 class="form_heading">New Comment</h2>
        <form action="newComment.php?post_ID=<?php echo $_GET['post_ID'] ?>" method="post" name="form1">
            <textarea class="comment_txt" type="post" name="comment_main" placeholder="Comment Here..." required></textarea>

            <div id="button">
                <button type='submit' name='submit'> Comment </button>
            </div>
        </form>
    </div>

    <?php
        if (isset($_POST["submit"])) {

            $comment_main = $_POST["comment_main"];
            $user_commented_ID = $_SESSION['user_ID'];
            $selected_post_ID = $_GET['post_ID'];

            $sql2 = "INSERT INTO comments (comment_main, date_commented, post_ID, user_ID)
            values ('$comment_main', now(), '$selected_post_ID', '$user_commented_ID')";
            
            $result = $conn->query($sql2);

            if ($result) {
                header("Location: postMain.php?post_ID=$selected_post_ID");
            }
            else {
                echo "<section class='error_msg'><strong>Error: </strong> Something Went Wrong. <br><br> Please try again.</section>";
            }
        }
    ?>
</div>


<?php
    include_once 'footer.php';
?>