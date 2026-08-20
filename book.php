<?php

session_start();

include "includes/db.php";


if (!isset($_SESSION["user_id"])) {

    header("Location: login.php");

    exit();

}


$user_id =
$_SESSION["user_id"];


$property_id =
isset($_GET["id"])
? intval($_GET["id"])
: 0;


$result =
mysqli_query(
    $conn,

    "SELECT * FROM properties
     WHERE id=$property_id"
);


$property =
mysqli_fetch_assoc($result);


if (!$property) {

    die("Property not found.");

}


$message = "";


if ($_SERVER["REQUEST_METHOD"] == "POST") {


    $date =
    $_POST["booking_date"];


    $booking_message =
    mysqli_real_escape_string(
        $conn,
        $_POST["message"]
    );


    $query =
    "INSERT INTO bookings

    (
        user_id,
        property_id,
        booking_date,
        message
    )

    VALUES

    (
        '$user_id',
        '$property_id',
        '$date',
        '$booking_message'
    )";


    if (mysqli_query($conn, $query)) {

        $message =
        "Your booking request has been sent!";

    } else {

        $message =
        "Booking could not be completed.";

    }

}


include "includes/header.php";

?>


<section class="section">


    <div class="section-title">

        <p>
            BOOKING REQUEST
        </p>

        <h2>
            Request This Property
        </h2>

        <p>

            <?php
            echo htmlspecialchars(
                $property["title"]
            );
            ?>

        </p>

    </div>


    <?php if ($message): ?>

        <div class="feature-card">

            <h3>

                <?php
                echo $message;
                ?>

            </h3>

            <br>

            <a
            href="explore.php"
            class="primary-btn">

                Back to Properties

            </a>

        </div>


    <?php else: ?>


        <div class="form-box"
             style="width:100%;max-width:700px;">


            <h2>

                <?php
                echo htmlspecialchars(
                    $property["title"]
                );
                ?>

            </h2>


            <p>

                <?php
                echo htmlspecialchars(
                    $property["city"]
                );
                ?>,

                <?php
                echo htmlspecialchars(
                    $property["country"]
                );
                ?>

            </p>


            <h3 style="margin-top:15px;">

                $<?php
                echo $property["price"];
                ?>

                / month

            </h3>


            <form method="POST">


                <label>
                    Preferred Move-in Date
                </label>

                <input
                type="date"
                name="booking_date"
                required>


                <label>
                    Message
                </label>

                <textarea
                name="message"
                rows="6"
                placeholder="Tell the property owner about yourself..."></textarea>


                <button
                type="submit"
                class="primary-btn">

                    Send Booking Request

                </button>


            </form>


        </div>


    <?php endif; ?>


</section>


<?php

include "includes/footer.php";

?>