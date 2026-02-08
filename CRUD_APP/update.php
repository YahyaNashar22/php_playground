<?php
include("db.php");
include("header.php");
?>

<?php

if (isset($_GET["id"])) {

    $id = $_GET['id'];
    $query = "SELECT * FROM students WHERE id=$id;";

    $result = mysqli_query($connection, $query);

    if (!$result) {
        die("query failed" . mysqli_error($connection));
    }

    $row = mysqli_fetch_assoc($result);
}

?>

<?php

if (isset($_POST['edit'])) {
    $first_name = $_POST["first_name"];
    $last_name = $_POST["last_name"];
    $age = $_POST["age"];

    if (isset($_GET["id_new"])) {

        $id_new = $_GET["id_new"];
    } else {
        die("Error: No ID found for update.");
    }

    $query = "UPDATE `students` 
    SET `first_name` = '$first_name', `last_name` = '$last_name', `age` = '$age'
    WHERE `id`='$id_new'";

    $result = mysqli_query($connection, $query);

    if (!$result) {
        die("query failed" . mysqli_error($connection));
    }

    header("location:index.php?update_msg=You have successfully updated the data");
    exit();
}

?>

<form action="update.php?id_new=<?php echo $id; ?>" method="POST">
    <input type="text" name="first_name" placeholder="first name" value="<?php echo $row["first_name"]  ?>" />
    <input type="text" name="last_name" placeholder="last name" value="<?php echo $row["last_name"]  ?>" />
    <input type="number" name="age" placeholder="age" value="<?php echo $row["age"]  ?>" />
    <button type="button"><a href="index.php">back</a></button>
    <input type="submit" name="edit" value="EDIT" />
</form>

<?php include("footer.php"); ?>