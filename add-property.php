<?php
session_start();
include "includes/db.php";
if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    exit();
}

$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $title = mysqli_real_escape_string( $conn,  $_POST["title"] );
    $country =mysqli_real_escape_string( $conn, $_POST["country"] );
    $city = mysqli_real_escape_string( $conn,   $_POST["city"]  );
    $property_type = mysqli_real_escape_string(  $conn,  $_POST["property_type"] );
    $price = floatval($_POST["price"]);
    $university =  mysqli_real_escape_string( $conn, $_POST["university"] );
    $university_distance = mysqli_real_escape_string($conn, $_POST["university_distance"]);
    $workplace_distance = mysqli_real_escape_string(  $conn, $_POST["workplace_distance"]  );
    $safety = mysqli_real_escape_string( $conn, $_POST["safety"] );
    $rooms = intval($_POST["rooms"]);
    $description =mysqli_real_escape_string(  $conn, $_POST["description"]);
    $image = "";

    if ( isset($_FILES["image"]) &&  $_FILES["image"]["error"] == 0 ) {
        $file_name =
        $_FILES["image"]["name"];
        $file_tmp =
        $_FILES["image"]["tmp_name"];
        $file_size = $_FILES["image"]["size"];

        $extension = strtolower( pathinfo( $file_name,PATHINFO_EXTENSION) );

        $allowed = ["jpg", "jpeg", "png", "webp"];

        if (in_array($extension, $allowed)) {
            if ($file_size <= 5000000) {
                $new_name =  time(). "_" . rand(100,999) . "."  . $extension;

                $upload_path = "uploads/". $new_name;

                if ( move_uploaded_file( $file_tmp, $upload_path ) ) {
                    $image =
                    $upload_path;
                }
            }
        }
    }

    if ($image == "") {
        $image =  "https://images.unsplash.com/photo-1560448204-e02f11c3d0e2?auto=format&fit=crop&w=900&q=80";
    }

    $user_id =
    $_SESSION["user_id"];

    $query = "INSERT INTO properties ( title,country,city, property_type, price,
    university, university_distance, workplace_distance,safety,  rooms,description, image, user_id)

    VALUES ( '$title','$country','$city','$property_type','$price', '$university', '$university_distance',
    '$workplace_distance', '$safety', '$rooms', '$description','$image', '$user_id')";

    if (mysqli_query($conn, $query)) {
        header( "Location: dashboard.php" );
        exit();
    } 
    else {
        $message =  "Property could not be added.";
    }
}
include "includes/header.php";
?>

<section class="section">
    <div class="section-title">
        <p>  REAL ESTATE  </p>

        <h2>  Add Your Property  </h2>
        <p> List a dorm, room, apartment or house. </p>
    </div>

    <?php if ($message): ?>
        <p style="color:red;"> <?php echo $message; ?> </p>
    <?php endif; ?>

    <div class="form-box"  style="width:100%;max-width:800px;">

        <form method="POST"  enctype="multipart/form-data">
            <label>  Property Title </label>
            <input type="text"   name="title" placeholder="Example: Modern Student Apartment" required>

            <label>Country </label>
            <select name="country" required>
                <option> United Kingdom</option>
                <option> Canada  </option>
                <option> Australia </option>
                <option>  Germany </option>
                <option> United States </option>
                <option>  Bangladesh</option>
            </select>

            <label>   City </label>
            <input type="text" name="city" required>

            <label> Property Type  </label>
            <select  name="property_type"   required>
                <option>  Dorm</option>
                <option> Room </option>
                <option>   Apartment </option>
                <option> House  </option>
            </select>

            <label>  Monthly Price </label>
            <input type="number"   name="price"  min="0" required>

            <label> University </label>
            <input type="text"  name="university"  placeholder="Example: University of London">

            <label>  Distance From University   </label>
            <input  type="text" name="university_distance"  placeholder="Example: 1.5 km">

            <label>  Distance From Workplace  </label>
            <input type="text" name="workplace_distance"placeholder="Example: 4 km">

            <label>  Safety Level </label>
            <select name="safety">
                <option>  Excellent </option>
                <option>   Good  </option>
                <option> Average </option>
                <option>    Needs Attention</option>
            </select>

            <label>Number of Rooms</label>
            <input type="number"  name="rooms"  min="1" required>

            <label>  Property Description </label>
            <textarea name="description" rows="6" placeholder="Describe the property..."></textarea>

            <label> Property Image </label>
            <input  type="file"  name="image" accept=".jpg,.jpeg,.png,.webp">

            <p style="font-size:13px;color:#777;margin-top:8px;">
                Recommended:  JPG, PNG or WEBP.  Maximum 5 MB.
            </p>

            <button type="submit"  class="primary-btn">
                Add Property
            </button>
        </form>
    </div>
</section>

<?php
include "includes/footer.php";
?>
