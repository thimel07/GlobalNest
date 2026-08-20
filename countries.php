<?php

include "includes/db.php";

include "includes/header.php";

?>


<section class="section">


    <div class="section-title">

        <p>
            CHOOSE YOUR DESTINATION
        </p>

        <h2>
            Explore Countries
        </h2>

        <p>
            Choose where you want to study,
            work or live.
        </p>

    </div>


    <div class="country-grid">


        <?php

        $result =
        mysqli_query(
            $conn,
            "SELECT * FROM countries"
        );


        while (
            $country =
            mysqli_fetch_assoc($result)
        ):

        ?>


        <div class="country-card">


            <img
            src="<?php echo $country["image"]; ?>"
            alt="">


            <div>

                <h3>

                    <?php
                    echo $country["name"];
                    ?>

                </h3>


                <p>

                    <?php
                    echo $country["description"];
                    ?>

                </p>


                <a
                href="universities.php?country=<?php echo $country["id"]; ?>">

                    View Universities →

                </a>

            </div>


        </div>


        <?php endwhile; ?>


    </div>


</section>


<?php include "includes/footer.php"; ?>