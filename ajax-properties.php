<?php

include "includes/db.php";


$search =
isset($_GET["search"])
? mysqli_real_escape_string(
    $conn,
    $_GET["search"]
)
: "";


$query =
"SELECT * FROM properties

WHERE

title LIKE '%$search%'

OR city LIKE '%$search%'

OR country LIKE '%$search%'

OR property_type LIKE '%$search%'

ORDER BY id DESC";


$result =
mysqli_query($conn, $query);


if (mysqli_num_rows($result) == 0) {

    echo "<p>No properties found.</p>";

    exit();

}


while (
    $property =
    mysqli_fetch_assoc($result)
) {


    echo "

    <div class='country-card'>

        <img
        src='" .
        htmlspecialchars(
            $property["image"]
        )
        . "'
        alt='Property'>


        <div>

            <h3>" .
            htmlspecialchars(
                $property["title"]
            )
            . "</h3>


            <p>" .
            htmlspecialchars(
                $property["city"]
            )
            . ", " .
            htmlspecialchars(
                $property["country"]
            )
            . "</p>


            <p>

                $" .
                $property["price"]
                .
                " / month

            </p>


            <p>

                Safety: " .
                htmlspecialchars(
                    $property["safety"]
                )
                .

            "</p>


            <a
            href='property.php?id=" .
            $property["id"]
            . "'
            class='primary-btn'>

                View Property

            </a>

        </div>

    </div>

    ";

}

?>