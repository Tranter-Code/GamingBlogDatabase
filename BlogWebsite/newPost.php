<?php
    include_once 'header.php';
?>

<?php
    include_once 'includes/connect.php';
?>

<!-- Main webpage box-->
<div class="main">
    <div class="newpostform">
        <h2 class="form_heading">New Post</h2>
        <form action="newPost.php" method="post" name="form1">
            <input type="text" name="post_title" placeholder="Title" required>
            <select name="genre_ID">
                <option value=""> choose a genre </option>
                <?php
                    $sql = "SELECT * FROM game_genres";
                    $result = $conn->query($sql);
                    while ($row = $result->fetch_assoc()) {
                        $genre_ID = $row['genre_ID'];
                        $genre_name = $row['genre_name'];
                        echo "<option value=\"$genre_ID\">$genre_name</option>";
                    }
                ?>
            </select>
            <textarea class="post_txt" type="post" name="post_main" placeholder="Post Here..." required></textarea>

            <div id="button">
                <button type='submit' name='submit'> Post </button>
            </div>
        </form>
    </div>

    <?php
        if (isset($_POST["submit"])) {

            $post_title = $_POST["post_title"];
            $post_main = $_POST["post_main"];
            $genre_ID = $_POST["genre_ID"];
            $user_posted = $_SESSION["user_ID"];


            $sql = "INSERT INTO posts (post_title, post_main, genre_ID, user_ID, date_posted) 
            values ('$post_title', '$post_main', '$genre_ID', '$user_posted', now())";
            $result = $conn->query($sql);
            $conn->close();

            if ($result) {
                header("Location: profile.php");
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