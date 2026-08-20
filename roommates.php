<?php

session_start();

include "includes/db.php";

include "includes/header.php";


// Make sure user is logged in

if (!isset($_SESSION["user_id"])) {

    ?>

    <section class="section">

        <div class="section-title">

            <p>ROOMMATE MATCHING</p>

            <h2>Find Your Perfect Roommate</h2>

            <p>
                Please login first to create your roommate profile.
            </p>

            <br>

            <a href="login.php" class="primary-btn">
                Login
            </a>

        </div>

    </section>

    <?php

    include "includes/footer.php";

    exit();
}


$user_id = $_SESSION["user_id"];

$message = "";


// Save roommate profile

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $age =
    intval($_POST["age"]);

    $country =
    mysqli_real_escape_string(
        $conn,
        $_POST["country"]
    );

    $budget =
    floatval($_POST["budget"]);

    $cleanliness =
    mysqli_real_escape_string(
        $conn,
        $_POST["cleanliness"]
    );

    $smoking =
    mysqli_real_escape_string(
        $conn,
        $_POST["smoking"]
    );

    $study_style =
    mysqli_real_escape_string(
        $conn,
        $_POST["study_style"]
    );

    $description =
    mysqli_real_escape_string(
        $conn,
        $_POST["description"]
    );


    // Check if profile already exists

    $check =
    mysqli_query(
        $conn,
        "SELECT id FROM roommates
         WHERE user_id=$user_id"
    );


    if (mysqli_num_rows($check) > 0) {

        $query =
        "UPDATE roommates SET

        age='$age',
        country='$country',
        budget='$budget',
        cleanliness='$cleanliness',
        smoking='$smoking',
        study_style='$study_style',
        description='$description'

        WHERE user_id=$user_id";


    } else {

        $query =
        "INSERT INTO roommates

        (user_id, age, country, budget,
        cleanliness, smoking, study_style,
        description)

        VALUES

        ('$user_id',
        '$age',
        '$country',
        '$budget',
        '$cleanliness',
        '$smoking',
        '$study_style',
        '$description')";

    }


    if (mysqli_query($conn, $query)) {

        $message =
        "Your roommate profile has been saved!";

    } else {

        $message =
        "Something went wrong.";

    }

}

?>


<section class="section">


    <div class="section-title">

        <p>
            ROOMMATE MATCHING
        </p>

        <h2>
            Find Your Perfect Roommate
        </h2>

        <p>
            Tell us about your lifestyle and
            find students with similar preferences.
        </p>

    </div>


    <?php if ($message): ?>

        <div class="feature-card"
             style="margin-bottom:30px;">

            <p style="color:#6b4f7b;">

                <?php
                echo $message;
                ?>

            </p>

        </div>

    <?php endif; ?>


    <!-- ROOMMATE FORM -->


    <div class="form-box"
         style="width:100%;max-width:700px;margin-bottom:70px;">


        <h2>
            My Roommate Preferences
        </h2>


        <form method="POST">


            <label>
                Age
            </label>

            <input
            type="number"
            name="age"
            min="16"
            max="100"
            required>


            <label>
                Preferred Country
            </label>

            <select name="country" required>

                <option>
                    United Kingdom
                </option>

                <option>
                    Canada
                </option>

                <option>
                    Australia
                </option>

                <option>
                    Germany
                </option>

                <option>
                    United States
                </option>

            </select>


            <label>
                Monthly Budget
            </label>

            <input
            type="number"
            name="budget"
            placeholder="Example: 700"
            required>


            <label>
                Cleanliness
            </label>

            <select name="cleanliness">

                <option>
                    Very Clean
                </option>

                <option>
                    Clean
                </option>

                <option>
                    Average
                </option>

                <option>
                    Relaxed
                </option>

            </select>


            <label>
                Smoking
            </label>

            <select name="smoking">

                <option>
                    Non-Smoker
                </option>

                <option>
                    Smoker
                </option>

                <option>
                    Doesn't Matter
                </option>

            </select>


            <label>
                Study Style
            </label>

            <select name="study_style">

                <option>
                    Quiet
                </option>

                <option>
                    Social
                </option>

                <option>
                    Balanced
                </option>

            </select>


            <label>
                About Me
            </label>

            <textarea
            name="description"
            rows="5"
            placeholder="Tell potential roommates about yourself..."></textarea>


            <button
            type="submit"
            class="primary-btn">

                Save My Preferences

            </button>


        </form>


    </div>



    <!-- MATCHES -->


    <div class="section-title">

        <p>
            DISCOVER
        </p>

        <h2>
            Potential Roommates
        </h2>

    </div>


    <div class="country-grid">


        <?php


        $query =
        "SELECT

        roommates.*,

        users.name,
        users.email

        FROM roommates

        JOIN users
        ON roommates.user_id = users.id

        WHERE roommates.user_id != $user_id

        ORDER BY roommates.id DESC";


        $result =
        mysqli_query($conn, $query);


        while (
            $roommate =
            mysqli_fetch_assoc($result)
        ):


        ?>


        <div class="feature-card">


            <div class="feature-icon">
                <?php
                echo strtoupper(
                    substr(
                        $roommate["name"],
                        0,
                        1
                    )
                );
                ?>
            </div>


            <h3>

                <?php
                echo htmlspecialchars(
                    $roommate["name"]
                );
                ?>

            </h3>


            <p>

                Age:
                <?php
                echo $roommate["age"];
                ?>

            </p>


            <p>

                Country:
                <?php
                echo htmlspecialchars(
                    $roommate["country"]
                );
                ?>

            </p>


            <p>

                Budget:
                $<?php
                echo $roommate["budget"];
                ?>

                / month

            </p>


            <p>

                Cleanliness:
                <?php
                echo htmlspecialchars(
                    $roommate["cleanliness"]
                );
                ?>

            </p>


            <p>

                Smoking:
                <?php
                echo htmlspecialchars(
                    $roommate["smoking"]
                );
                ?>

            </p>


            <p>

                Study Style:
                <?php
                echo htmlspecialchars(
                    $roommate["study_style"]
                );
                ?>

            </p>


            <p>

                <?php
                echo htmlspecialchars(
                    $roommate["description"]
                );
                ?>

            </p>


            <br>


            <button
            class="primary-btn match-button"
            onclick="showMatchMessage('<?php echo htmlspecialchars($roommate["name"], ENT_QUOTES); ?>')">

                ❤️ Interested

            </button>


        </div>


        <?php endwhile; ?>


    </div>


</section>


<?php

include "includes/footer.php";

?>