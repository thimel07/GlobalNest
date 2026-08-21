<?php
session_start();
include "includes/db.php";

if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    exit();
}

$id = isset($_GET["id"]) ? intval($_GET["id"]) : 0;

$user_id = $_SESSION["user_id"];

$result = mysqli_query( $conn, "SELECT * FROM properties WHERE id=$id AND user_id=$user_id");

$property = mysqli_fetch_assoc($result);

if (!$property) {
    die("Property not found or you do not have permission.");
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = mysqli_real_escape_string( $conn,  $_POST["title"] );

    $country = mysqli_real_escape_string($conn, $_POST["country"] );

    $city = mysqli_real_escape_string(  $conn,  $_POST["city"] );

    $property_type = mysqli_real_escape_string(  $conn,  $_POST["property_type"]);
    $price = floatval($_POST["price"]);

    $university = mysqli_real_escape_string(  $conn, $_POST["university"]);
    $university_distance =mysqli_real_escape_string(  $conn, $_POST["university_distance"]);

    $workplace_distance =  mysqli_real_escape_string( $conn, $_POST["workplace_distance"] );

    $safety = mysqli_real_escape_string( $conn,  $_POST["safety"] );

    $rooms =  intval($_POST["rooms"]);

    $description = mysqli_real_escape_string( $conn,  $_POST["description"]   );
    $image = $property["image"];

    if ( isset($_FILES["image"])  && $_FILES["image"]["error"] == 0) {
        $file_name =
        $_FILES["image"]["name"];
        $file_tmp = $_FILES["image"]["tmp_name"];

        $extension = strtolower(  pathinfo($file_name, PATHINFO_EXTENSION) );
        $allowed = ["jpg", "jpeg", "png", "webp"];

        if (in_array($extension, $allowed)) {
            $new_name = time() . "_" . rand(100,999) . "." . $extension;

            $upload_path = "uploads/" . $new_name;

            if ( move_uploaded_file( $file_tmp,$upload_path ) ) {
                $image =  $upload_path;
            }
        }
    }

    $query = "UPDATE properties SET title='$title', country='$country', city='$city',
    property_type='$property_type', price='$price',  university='$university',university_distance='$university_distance',
    workplace_distance='$workplace_distance',

    safety='$safety', rooms='$rooms',description='$description', image='$image'  WHERE id=$id  AND user_id=$user_id";

    if (mysqli_query($conn, $query)) {
        header(  "Location: property.php?id=$id");
        exit();
    }
}
include "includes/header.php";
?>

<section class="section">
    <div class="section-title">
        <p>  EDIT PROPERTY </p>
        <h2> Update Your Property </h2>
    </div>

    <div class="form-box" style="width:100%;max-width:800px;">
        <form  method="POST" enctype="multipart/form-data">

            <label>Property Title</label>
            <input type="text" name="title" value="<?php echo htmlspecialchars($property["title"]); ?>"  required>

            <label> Country </label>
            <input type="text" name="country" value="<?php echo htmlspecialchars($property["country"]); ?>" required>


            <label>  City </label>
            <input type="text"  name="city" value="<?php echo htmlspecialchars($property["city"]); ?>" required>

            <label> Property Type </label>
            <select name="property_type">
                <option <?php if ($property["property_type"]=="Dorm") echo "selected"; ?>>
                    Dorm
                </option>

                <option<?php if ($property["property_type"]=="Room") echo "selected"; ?>>
                    Room
                </option>
                <option<?php if ($property["property_type"]=="Apartment") echo "selected"; ?>>
                    Apartment
                </option>
                <option <?php if ($property["property_type"]=="House") echo "selected"; ?>>
                    House
                </option>
            </select>

            <label>  Monthly Price </label>
            <input  type="number"  name="price"value="<?php echo $property["price"]; ?>"  required>


            <label>  University </label>
            <input  type="text"  name="university" value="<?php echo htmlspecialchars($property["university"]); ?>">

            <label> University Distance </label>
            <input type="text"name="university_distance" value="<?php echo htmlspecialchars($property["university_distance"]); ?>">


            <label> Workplace Distance</label>
            <input type="text" name="workplace_distance" value="<?php echo htmlspecialchars($property["workplace_distance"]); ?>">


            <label> Safety </label>
            <select name="safety">
                <option <?php if ($property["safety"]=="Excellent") echo "selected"; ?>>
                    Excellent
                </option>

                <option <?php if ($property["safety"]=="Good") echo "selected"; ?>>
                    Good
                </option>

                <option <?php if ($property["safety"]=="Average") echo "selected"; ?>>
                    Average
                </option>
                <option <?php if ($property["safety"]=="Needs Attention") echo "selected"; ?>>
                    Needs Attention
                </option>
            </select>

            <label> Number of Rooms</label>

            <input  type="number"name="rooms" value="<?php echo $property["rooms"]; ?>" required>

            <label>  Description</label>
            <textarea name="description" rows="6"><?php echo htmlspecialchars($property["description"]); ?></textarea>

            <label> Current Image </label><img src="<?php echo htmlspecialchars($property["image"]); ?>" style="width:200px;height:130px;object-fit:cover;border-radius:10px;margin:10px 0;">

            <label> Change Image </label>
            <input type="file" name="image" accept=".jpg,.jpeg,.png,.webp">
            <button type="submit" class="primary-btn">
                Save Changes
            </button>
        </form>
    </div>
</section>
<?php
include "includes/footer.php";
?>
