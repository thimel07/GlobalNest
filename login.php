<?php
include "includes/db.php";

session_start();
$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = mysqli_real_escape_string( $conn, $_POST["email"]);

    $password =
    $_POST["password"];

    $query = mysqli_query( $conn, "SELECT * FROM users WHERE email='$email'");

    if (mysqli_num_rows($query) == 1) {
        $user = mysqli_fetch_assoc($query);

        if (password_verify( $password, $user["password"] ) ) 
        {
            $_SESSION["user_id"] = $user["id"];

            $_SESSION["user_name"] = $user["name"];
            header( "Location: dashboard.php" );
            exit();
        } 
        else {
            $message = "Incorrect password.";
        }
    } 
    else {
        $message = "Account not found.";
    }
}
?>

<?php include "includes/header.php"; ?>

<section class="form-page">

<div class="form-box">
    <div class="logo">
        Global<span>Nest</span>
    </div>

    <h1> Welcome Back</h1>
    <p> Login to your GlobalNest account.</p>

    <?php if ($message): ?>
        <p style="color:red;"> <?php echo $message; ?> </p>
    <?php endif; ?>

    <form method="POST">
        <label> Email </label>
        <input type="email" name="email" required>


        <label> Password</label>

        <input type="password" name="password" required>

        <button type="submit" class="primary-btn">
            Login
        </button>
    </form>

    <p style="margin-top:20px;">
        Don't have an account?
        <a href="register.php" style="color:#8b62a0;">
            Register
        </a>
    </p>
</div>
</section>
<?php include "includes/footer.php"; ?>
