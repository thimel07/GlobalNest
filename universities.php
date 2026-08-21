<?php
include "includes/db.php";
include "includes/header.php";

$country_id =
isset($_GET["country"])
? intval($_GET["country"])
: 0;

$query = "SELECT universities.*, countries.name AS country_name FROM universities LEFT JOIN
 countries ON universities.country_id = countries.id WHERE universities.country_id = $country_id";

$result = mysqli_query($conn,$query);
?>

<section class="section">
    <div class="section-title">
        <p>
            UNIVERSITY GUIDE
        </p>

        <h2>
            Universities
        </h2>

        <p>
            Find universities and nearby accommodation.
        </p>
    </div>

    <div class="country-grid">
        <?php
        while (
            $university =
            mysqli_fetch_assoc($result)
        ):
        ?>

        <div class="feature-card">
            <h3>
                <?php echo $university["name"];?>
            </h3>

            <p> 
                City:
                <?php echo $university["city"]; ?>
            </p>

            <p>
                <?php echo $university["description"]; ?>
            </p><br>
            <a href="explore.php?university=<?php echo urlencode($university["name"]); ?>" class="primary-btn">
                Find Nearby Homes
            </a>
        </div>
        <?php endwhile; ?>
    </div>
</section>
<?php include "includes/footer.php"; ?>
