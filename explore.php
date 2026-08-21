<?php

include "includes/db.php";
include "includes/header.php";

$search =isset($_GET["search"])? mysqli_real_escape_string($conn, $_GET["search"]): "";

$country = isset($_GET["country"])? mysqli_real_escape_string($conn,$_GET["country"]): "";

$type = isset($_GET["type"])? mysqli_real_escape_string( $conn,$_GET["type"]): "";

$university = isset($_GET["university"]) ? mysqli_real_escape_string( $conn,$_GET["university"] ): "";

$query ="SELECT * FROM properties WHERE 1=1";

if ($search != "") {
    $query .=" AND ( title LIKE '%$search%' OR city LIKE '%$search%' OR country LIKE '%$search%' OR property_type LIKE '%$search%')";
}

if ($country != "") {
    $query .=" AND country='$country'";
}

if ($type != "") {
    $query .=" AND property_type='$type'";
}

if ($university != "") {
    $query .=" AND university='$university'";
}

$query .= " ORDER BY id DESC";

$result = mysqli_query($conn,$query); ?>

<section class="section">
    <div class="section-title">
        <p> REAL ESTATE </p>
        <h2> Find Your Perfect Place </h2>
        <p> Search accommodation around universities and workplaces.</p>
    </div>

    <form method="GET" class="search-box">
        <div class="feature-card" style="margin-bottom:20px;">

    <h3>  Quick Search </h3>
    <p> Results update automatically. </p>

    <input type="text" id="ajaxSearch" placeholder="Type city, country or property..."
    style="width:100%;padding:14px;margin-top:10px;border:1px solid #ddd;border-radius:8px;">

</div>

<div id="ajaxResults" class="country-grid" style="margin-bottom:50px;">
</div>
        <input type="text" name="search"  placeholder="Search city or property">

        <select name="country">
            <option value=""> All Countries </option>
            <option>United Kingdom </option>
            <option> Canada </option>
            <option>  Australia </option>
            <option> Germany</option>
        </select>

        <select name="type">
            <option value=""> All Types </option>
            <option> Dorm </option>
            <option> Room</option>
            <option>Apartment  </option>
            <option> House </option>
        </select>

        <button type="submit">
            Search
        </button>
    </form>

    <div class="country-grid" style="margin-top:50px;">

        <?php  while ( $property = mysqli_fetch_assoc($result) ): ?>

        <div class="country-card">
            <img src="<?php echo $property["image"]; ?>" alt="">

            <div>
                <h3><?php echo $property["title"]; ?> </h3>

                <p>
                    <?php  echo $property["city"]; ?>,
                    <?php echo $property["country"]; ?>
                </p>

                <p> Type: <?php echo $property["property_type"]; ?> </p>

                <p> University: <?php echo $property["university_distance"]; ?>  </p>

                <p> Safety:<?php  echo $property["safety"];?>  </p>

                <h3>
                    $<?php echo $property["price"]; ?>
                    / month
                </h3><br>

                <a href="property.php?id=<?php echo $property["id"]; ?>"  class="primary-btn">
                    View Property
                </a>
            </div>
        </div>
        <?php endwhile; ?>
    </div>
</section>
<?php include "includes/footer.php"; ?>
