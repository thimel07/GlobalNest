<?php

session_start();

include "includes/db.php";


if (!isset($_SESSION["user_id"])) {

    header("Location: login.php");

    exit();

}


$id =
isset($_GET["id"])
? intval($_GET["id"])
: 0;


$user_id =
$_SESSION["user_id"];


$query =
"DELETE FROM properties

WHERE id=$id

AND user_id=$user_id";


if (mysqli_query($conn, $query)) {

    header(
        "Location: dashboard.php"
    );

    exit();

} else {

    echo "Unable to delete property.";

}

?>