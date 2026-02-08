<?php

include("db.php");

if (isset($_GET["id"])) {
    $id = $_GET["id"];

    $query = "DELETE FROM `students`
    WHERE `id`='$id'";

    $result = mysqli_query($connection, $query);

    if (!$result) {
        die("Failed to preform operation".mysqli_error($connection));
    }

    header("location:index.php?delete_msg=Deleted Successfully");
    exit();
}

?>