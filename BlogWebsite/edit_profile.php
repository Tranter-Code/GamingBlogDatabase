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

    <div class="signup_login">
        <?php
            $sql = "SELECT users.username, users.email_address, users.genre_ID, game_genres.genre_name 
            FROM users
            INNER JOIN game_genres on users.genre_ID = game_genres.genre_ID
            WHERE users.user_ID = $active_usr";

            $result = $conn->query($sql);
            $row = $result->fetch_assoc();
        ?>

        <h2 class="form_heading">Editing Your Profile</h2>
        <form action="edit_profile.php" method="post" name="form1">
            <input type='text' name='username' placeholder="Username" value="<?php echo $row['username']; ?>" required>
            <input type='email' name='email' placeholder="Email Address" value="<?php echo $row['email_address']; ?>" required>
            <select name="genre_ID">
            <option value="">Genre - Click to change </option>
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
            <div id="button">
                <button type='submit' name='submit'> Update Account </button>
            </div>
        </form>

        <?php
            if (isset($_POST["submit"])) {
             
                $username_update = $_POST["username"];
                $email_address_update = $_POST["email"];
                $genre_ID_update = $_POST["genre_ID"];

                if ($_POST["genre_ID"] == "") {
                    $genre_ID_update = $_SESSION["genre_ID"];
                }

                $sql = "UPDATE users
                SET username='$username_update', email_address='$email_address_update', genre_ID='$genre_ID_update'
                WHERE user_ID=$active_usr";
                $result = $conn->query($sql);

                $_SESSION['username'] = $username_update;
                $_SESSION['email_address'] = $email_address_update;
                $_SESSION['genre_ID'] = $genre_ID_update;

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
</div>


<?php
    include_once 'footer.php';
?>