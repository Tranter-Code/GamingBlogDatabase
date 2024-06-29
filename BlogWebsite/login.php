<?php
    include_once 'header.php';
?>

<?php
    include_once 'includes/connect.php';
?>

<!-- Main webpage box-->
<div class="main">
    <div class="signup_login">
        <h2 class="form_heading">Login</h2>
        <form action="login.php" method="post" name="form1">
            <input type='email' name='email' placeholder="Email Address" required>
            <input type='password' name='password' placeholder="Password" required>
            <div class="button">
                <button type='submit' name='submit'> Login </button>
            </div>
        </form>
    </div>
            

    <?php
        if (isset($_POST['submit'])) {
            $email = $_POST['email'];
            $password = md5($_POST['password']);

            $sql = "SELECT * from users where email_address='$email' and password='$password'";
            $result = $conn->query($sql);
            $conn->close();

            $matching_users = mysqli_num_rows($result);

            if ($matching_users > 0) {
                $row = $result->fetch_assoc();
                $_SESSION["email"] = $email;
                $_SESSION["user_ID"] = $row['user_ID'];
                $_SESSION["username"] = $row['username'];
                $_SESSION["genre_ID"] = $row['genre_ID'];
                $_SESSION["user_type_ID"] = $row['user_type_ID'];
                header("location: profile.php");
            } 
            else {
                echo "<section class='error_msg'><strong>Error: </strong> Email address or Password was incorrect. <br><br> Please try again.</section>";
            }
        }    
    ?>
</div>
        
<?php
    include_once 'footer.php';
?>