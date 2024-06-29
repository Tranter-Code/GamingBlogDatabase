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

<!-- Main webpage box-->
<div class="main">

    <div class="signup_login">
        <?php
            $sql = "SELECT posts.post_ID, posts.post_title, posts.post_main, posts.date_posted, game_genres.genre_name, game_genres.genre_ID
            FROM posts
            INNER JOIN game_genres on posts.genre_ID = game_genres.genre_ID
            WHERE posts.post_ID = $selected_post_ID";

            $result = $conn->query($sql);
            $row = $result->fetch_assoc();
        ?>

        <h2 class="form_heading">
            Editing Your Post
        </h2>
        <form action="editPost.php?post_ID=<?php echo $_GET['post_ID']?>" method="post" name="form1">
            <input type='text' name='post_title' placeholder="Title" value="<?php echo $row['post_title']; ?>" required>
            <select name="genre_ID">
            <option value="<?php echo $row['genre_ID'] ?>">Genre - Click to change </option>
            <?php
                $sql2 = "SELECT * FROM game_genres";
                $result2 = $conn->query($sql2);
                while ($row2 = $result2->fetch_assoc()) {
                    $genre_ID = $row2['genre_ID'];
                    $genre_name = $row2['genre_name'];
                    echo "<option value=\"$genre_ID\">$genre_name</option>";
                }
            ?>
            </select>
            <textarea class="post_txt" type="post" name="post_main" placeholder="Post Here..." required><?php echo $row['post_main']?></textarea>
            <div id="button">
                <button type='submit' name='submit'> Update Post </button>
            </div>
            <div id="del_button">
                <button id='delete_button' type='delete' name='delete'> Delete Post </button>
            </div>
            <?php
                if (isset($_POST["submit"])) {
                    
                    $postTitle_update = $_POST["post_title"];
                    $genreID_update = $_POST["genre_ID"];
                    $postMain_update = $_POST["post_main"];
                    $selected_post_ID = $_GET['post_ID'];

                    $sql = "UPDATE posts
                    SET post_title='$postTitle_update', genre_ID='$genreID_update', post_main='$postMain_update'
                    WHERE post_ID=$selected_post_ID";
                    $result = $conn->query($sql);

                    if ($result) {
                        header("Location: postMain.php?post_ID=$selected_post_ID");
                    }
                    else {
                        echo "<section class='error_msg'><strong>Error: </strong> Something Went Wrong. <br><br> Please try again.</section>";
                    }
                }

                if (isset($_POST["delete"])) {

                    echo
                        "<section class='confirm_del_msg'>
                        <p>
                            Are you sure you want to delete this post?
                        </p>
                        <div id='del_button'>
                            <button id='delete_button' type='delete' name='confirm'> Confirm Delete </button>
                        </div>
                        </section>";

                }

                if (isset($_POST["confirm"])) {

                    $sql = "DELETE FROM posts
                        WHERE post_ID = $selected_post_ID";
                    $result = $conn->query($sql);

                    if ($result) {
                        header("Location: profile.php?message=post_deleted");
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