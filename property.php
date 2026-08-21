<?php

include "includes/db.php";
include "includes/header.php";

$id = isset($_GET["id"]) ? intval($_GET["id"]): 0;

$result = mysqli_query($conn, "SELECT * FROM properties WHERE id=$id");

$property = mysqli_fetch_assoc($result);

if (!$property) {
    echo "<section class='section'>";
    echo "<h2>Property not found.</h2>";
    echo "</section>";
    include "includes/footer.php";
    exit();
}
?>

<section class="section">
    <div class="hero" style="padding:0;background:white;">

        <div>
            <p class="small-title">  PROPERTY </p>

            <h1 style="font-size:45px;">
                <?php echo $property["title"]; ?>
            </h1>

            <p>
                <?php echo $property["city"]; ?>,
                <?php echo $property["country"];?>
            </p>

            <h2 style="margin-top:20px;">
                $<?php echo $property["price"]; ?>
                / month
            </h2>
        </div>

        <div>
            <img src="<?php echo $property["image"]; ?>" style="width:100%;height:400px;object-fit:cover;border-radius:20px;">
        </div>
    </div>

    <div class="feature-grid"style="margin-top:60px;">

        <div class="feature-card">
            <h3> University Distance </h3>
            <p> <?php  echo $property["university_distance"];?></p>
        </div>

        <div class="feature-card">
            <h3> Workplace Distance</h3>
            <p><?php echo $property["workplace_distance"]; ?></p>
        </div>

        <div class="feature-card">
            <h3>Safety </h3>
            <p> <?php echo $property["safety"]; ?></p>
        </div>

        <div class="feature-card">
            <h3>Rooms </h3>
            <p> <?phpecho $property["rooms"];?> </p>
        </div>
    </div>

    <div style="margin-top:60px;">
        <h2> About this property</h2>

        <p style="margin-top:15px;color:#666;">
            <?php echo $property["description"]; ?>
        </p> <br>

        <?php if (isset($_SESSION["user_id"])): ?>
        <a href="book.php?id=<?php echo $property["id"]; ?>"  class="primary-btn">
            Book / Request Property
        </a>
        <?php else: ?>

        <a href="login.php" class="primary-btn">
            Login to Book
        </a>
        <?php endif; ?>
    </div>
</section>
<?php include "includes/footer.php"; ?>
