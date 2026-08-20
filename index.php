<?php

include "includes/db.php";

include "includes/header.php";

?>


<section class="hero">


    <div class="hero-content">

        <p class="small-title">
            YOUR HOME BEYOND BORDERS
        </p>


        <h1>

            Find your perfect
            <span>place in the world.</span>

        </h1>


        <p>

            Discover student accommodation,
            safe neighborhoods, universities,
            roommates and travel experiences
            in one place.

        </p>


        <div class="hero-buttons">

            <a href="countries.php"
               class="primary-btn">

                Explore Countries

            </a>


            <a href="roommates.php"
               class="secondary-btn">

                Find a Roommate

            </a>

        </div>

    </div>


    <div class="hero-image">

        <img
        src="https://images.unsplash.com/photo-1523240795612-9a054b0db644?auto=format&fit=crop&w=900&q=80"
        alt="International students">

    </div>


</section>



<section class="search-section">

    <h2>
        Find your next home
    </h2>


    <form action="explore.php"
          method="GET"
          class="search-box">


        <select name="country">

            <option value="">
                Choose Country
            </option>

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


        <select name="type">

            <option value="">
                Property Type
            </option>

            <option>
                Dorm
            </option>

            <option>
                Room
            </option>

            <option>
                Apartment
            </option>

            <option>
                House
            </option>

        </select>


        <button type="submit">
            Search
        </button>

    </form>

</section>



<section class="section">


    <div class="section-title">

        <p>
            WHY GLOBALNEST
        </p>

        <h2>
            Everything you need before
            moving to a new country.
        </h2>

    </div>


    <div class="feature-grid">


        <div class="feature-card">

            <div class="feature-icon">
                01
            </div>

            <h3>
                Find Your Home
            </h3>

            <p>
                Search dorms, rooms,
                apartments and houses.
            </p>

        </div>


        <div class="feature-card">

            <div class="feature-icon">
                02
            </div>

            <h3>
                Know Your Area
            </h3>

            <p>
                See safety information,
                distance and nearby facilities.
            </p>

        </div>


        <div class="feature-card">

            <div class="feature-icon">
                03
            </div>

            <h3>
                Find Your Roommate
            </h3>

            <p>
                Match with people
                based on lifestyle.
            </p>

        </div>


        <div class="feature-card">

            <div class="feature-icon">
                04
            </div>

            <h3>
                Explore
            </h3>

            <p>
                Discover universities,
                hotels and tourist destinations.
            </p>

        </div>


    </div>

</section>



<section class="section light-section">


    <div class="section-title">

        <p>
            POPULAR DESTINATIONS
        </p>

        <h2>
            Explore the world
        </h2>

    </div>


    <div class="country-grid">


        <?php

        $query =
        "SELECT * FROM countries LIMIT 4";

        $result =
        mysqli_query($conn, $query);


        while ($country =
        mysqli_fetch_assoc($result)):

        ?>


        <div class="country-card">


            <img
            src="<?php echo $country['image']; ?>"
            alt="<?php echo $country['name']; ?>">


            <div>

                <h3>

                    <?php
                    echo $country['name'];
                    ?>

                </h3>


                <p>

                    <?php
                    echo $country['description'];
                    ?>

                </p>


                <a href="countries.php">

                    Explore →

                </a>

            </div>


        </div>


        <?php endwhile; ?>


    </div>

</section>


<?php

include "includes/footer.php";

?>