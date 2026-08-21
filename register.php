<?php
include "includes/db.php";

session_start();
$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = mysqli_real_escape_string(  $conn, $_POST["name"]);

    $email = mysqli_real_escape_string( $conn,  $_POST["email"]);

    $password = password_hash( $_POST["password"], PASSWORD_DEFAULT);

    $country = mysqli_real_escape_string( $conn,$_POST["country"] );

    $check = mysqli_query( $conn,"SELECT id FROM users WHERE email='$email'"
    );

    if (mysqli_num_rows($check) > 0) {
        $message = "Email already exists.";
    } 
    else {
        $query ="INSERT INTO users (name,email,password,country)
        VALUES ('$name','$email','$password','$country')";

        if (mysqli_query($conn,$query)) {
            header("Location: login.php");
            exit();
        } 
        else {
            $message ="Registration failed.";
        }
    }
}
?>

<?php include "includes/header.php"; ?>
<section class="form-page">
<div class="form-box">
    <div class="logo">
        Global<span>Nest</span>
    </div>

    <h1> Create Account</h1>

    <p>Start your international journey.</p>

    <?php if ($message): ?>
        <p style="color:red;">
            <?php echo $message; ?>
        </p>
    <?php endif; ?>

    <form method="POST">
        <label>Full Name</label>
        <input type="text" name="name" required>

        <label>  Email </label>
        <input type="email" name="email" required>

        <label> Password </label>
        <input type="password"  name="password" required>

        <label> Country</label>
        <select name="country">
            <option>  United Kingdom</option>
            <option> Canada </option>
            <option>  Australia</option>
            <option> Germany </option>
            <option>  United States </option>
        </select>

        <button type="submit" class="primary-btn">
            Create Account
        </button>
    </form>

    <p style="margin-top:20px;">
        Already have an account?
        <a href="login.php" style="color:#8b62a0;">
            Login
        </a>
    </p>
</div>

</section>
<?php include "includes/footer.php"; ?>
