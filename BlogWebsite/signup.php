<?php
    include_once 'header.php';
?>

<?php
    include_once 'includes/connect.php';
?>

<!-- Main webpage box-->
<div class="main">
    <div class="signup_login">
        <h2 class="form_heading">Sign Up</h2>
        <form action="signup.php" method="post" name="form1">
            <input type='text' name='username' placeholder="Username" required>
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
            <input type='email' name='email' placeholder="Email Address" required>
            <input type='password' name='password' placeholder="Password" required>
            <input type='password' name='passwordrepeat' placeholder="Password Again" required>
            <div id="button">
                <button type='submit' name='submit'> Sign Up </button>
            </div>
        </form>
    </div>
            
    <?php
        if (isset($_POST["submit"])) {

            $username = $_POST["username"];
            $genre_ID = $_POST["genre_ID"];
            $email = $_POST["email"];
            $password = md5($_POST["password"]);
            $passwordrepeat = md5($_POST["passwordrepeat"]);




            if ($password == $passwordrepeat) {

                $sql = "SELECT email_address from users where email_address='$email'";
                $email_result = $conn->query($sql);

                $existing_users = mysqli_num_rows($email_result);

                if($existing_users > 0) {
                    echo "<section class='error_msg'><strong>Error: </strong> User already exists with this Email address. <br><br> Please try again.</section>";
                } else {
                    $sql = "INSERT INTO users (username, genre_ID, email_address, password, user_type_ID) values('$username', '$genre_ID', '$email', '$password', '2')";
                    $result = $conn->query($sql);
                    $conn->close();

                    if ($result) {
                        echo "<section class='notif_msg'> User Registered. </section>";
                    }
                    else {
                        echo "<section class='error_msg'><strong>Error: </strong> Registration error. <br><br> Please try again.</section>";
                    }
                }
            } else {
                echo "<section class='error_msg'><strong>Error: </strong> Passwords don't match. <br><br> Please try again.</section>";
            }
                
        }
    ?>
</div>

<?php
    include_once 'footer.php';
?>