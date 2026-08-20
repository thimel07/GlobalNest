<?php

session_start();

if (!isset($_SESSION["user_id"])) {

    header("Location: login.php");

    exit();

}

include "includes/db.php";

include "includes/header.php";

?>


<section class="section">


    <div class="section-title">

        <p>
            MY DASHBOARD
        </p>

        <h2>

            Welcome,
            <?php
            echo $_SESSION["user_name"];
            ?>

        </h2>

        <p>
            Manage your GlobalNest journey.
        </p>

    </div>


    <div class="feature-grid">


        <div class="feature-card">

            <h3>
                Find a Home
            </h3>

            <p>
                Search properties.
            </p>

            <br>

            <a href="explore.php"
               class="primary-btn">

                Explore

            </a>

        </div>


        <div class="feature-card">

            <h3>
                Roommates
            </h3>

            <p>
                Find a compatible roommate.
            </p>

            <br>

            <a href="roommates.php"
               class="primary-btn">

                Find Match

            </a>

        </div>


        <div class="feature-card">

            <h3>
                Add Property
            </h3>

            <p>
                List accommodation.
            </p>

            <br>

            <a href="add-property.php"
               class="primary-btn">

                Add Property

            </a>

        </div>


        <div class="feature-card">

            <h3>
                Travel
            </h3>

            <p>
                Explore destinations.
            </p>

            <br>

            <a href="travel.php"
               class="primary-btn">

                Explore

            </a>

        </div>


    </div>


</section>


<?php include "includes/footer.php"; ?>