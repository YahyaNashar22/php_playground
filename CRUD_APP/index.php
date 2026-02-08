<?php include("db.php") ?>
<?php include("header.php") ?>


<button onclick="openModal()">Add Student</button>

<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Age</th>
            <th>update</th>
            <th>delete</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $query = "SELECT * FROM students;";

        $result = mysqli_query($connection, $query);

        if (!$result) {
            die("Query Failed" . mysqli_error($connection));
        } else {
            while ($row = mysqli_fetch_assoc($result)) {
        ?>
                <tr>
                    <td><?php echo $row['id']; ?></td>
                    <td><?php echo $row['first_name']; ?></td>
                    <td><?php echo $row['last_name']; ?></td>
                    <td><?php echo $row['age']; ?></td>
                    <td>
                        <a href="update.php?id=<?php echo $row['id']; ?>">✏️</a>
                    </td>
                    <td>
                        <a href="delete.php?id=<?php echo $row['id']; ?>">🗑️</a>
                    </td>
                </tr>
        <?php
            }
        }
        ?>
    </tbody>
</table>

<?php
if (isset($_GET['message'])) {
    echo "<h6 class='error'>" . htmlspecialchars($_GET['message']) . "</h6>";
}
?>

<?php

if (isset($_GET['insert_msg'])) {
    echo "<h6 class='success'>" . htmlspecialchars($_GET['insert_msg']) . "</h6>";
} ?>

<?php
if (isset($_GET['update_msg'])) {
    echo "<h6 class='success'>" . htmlspecialchars($_GET['update_msg']) . "</h6>";
}
?>

<?php
if (isset($_GET['delete_msg'])) {
    echo "<h6 class='success'>" . htmlspecialchars($_GET['delete_msg']) . "</h6>";
}
?>

<div class="modal-overlay">
    <div class="modal">
        <h2>Add New Student</h2>
        <form action="insert.php" method="POST">
            <input type="text" name="first_name" placeholder="first name" />
            <input type="text" name="last_name" placeholder="last name" />
            <input type="number" name="age" placeholder="age" />
            <button type="button" onclick="closeModal()">Cancel</button>
            <input type="submit" name="add" value="ADD" />
        </form>
    </div>
</div>


<?php include("footer.php") ?>