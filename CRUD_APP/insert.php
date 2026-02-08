<?php
include("db.php");

if (isset($_POST['add'])) {

    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $age = $_POST['age'];

    // Check if any field is empty after removing accidental spaces
    if (empty(trim($first_name)) || empty(trim($last_name)) || empty(trim($age))) {
        header("location:index.php?message=" . urlencode("You need to fill in all the fields"));
        exit(); // Always call exit() after a header redirect
    }

    $query = "
    INSERT INTO `students` (`first_name`, `last_name`, `age`)
    VALUES ('$first_name', '$last_name', '$age') 
    ";

    $result = mysqli_query($connection, $query);

    if (!$result) {
        die("Query Failed" . mysqli_error($connection));
    }

    header("location:index.php?insert_msg=Student inserted successfully");
    exit();
}
