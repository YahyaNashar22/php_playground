<?php

$uploadDir = 'uploads/';
$contactsFile = "contacts.json";

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $name = filter_input(INPUT_POST, "name", FILTER_SANITIZE_SPECIAL_CHARS);
    $email = filter_input(INPUT_POST, "email", FILTER_VALIDATE_EMAIL);
    $phone = filter_input(INPUT_POST, "phone", FILTER_SANITIZE_NUMBER_INT);

    if ($name && $email && $phone && isset($_FILES['image'])) {


        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }

        $imageName = time() . "_" . basename($_FILES['image']['name']);
        $imagePath = $uploadDir . $imageName;

        if (move_uploaded_file($_FILES["image"]["tmp_name"], $imagePath)) {
            $contacts = file_exists($contactsFile) ?
                json_decode(file_get_contents($contactsFile)) : [];

            $contacts[] = [
                'name' => $name,
                'email' => $email,
                'phone' => $phone,
                'image' => $imagePath
            ];

            file_put_contents($contactsFile, json_encode($contacts, JSON_PRETTY_PRINT));

            echo "Contact added: $name ($email, $phone)";
        } else {
            echo "Image upload failed";
        }
    } else {
        echo "Invalid Input";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <form
        style="display: flex; flex-direction: column;gap:12px;"
        action="" method="POST" enctype="multipart/form-data">
        <label>
            name:
            <input type="text" name="name" />
        </label>
        <label>
            email:
            <input type="email" name="email" />
        </label>
        <label>
            phone:
            <input type="text" name="phone" />
        </label>
        <label>
            Contact Image:
            <input type="file" name="image" accept="image/*" />
        </label>
        <button type="submit">Add Contact</button>
    </form>

    <ul>
        <?php
        $contactsFile = 'contacts.json';
        $contacts = file_exists($contactsFile) ? json_decode(file_get_contents($contactsFile), true) : [];
        foreach ($contacts as $contact): ?>
            <li>
                <img src="<?php echo $contact['image']; ?>" height="50" />
                <?php
                echo "{$contact['name']} - {$contact['email']} - {$contact['phone']}";
                ?>
                <a href="delete.php?name=<?php
                                            echo $contact['name']
                                            ?>">Delete</a>
            </li>
        <?php endforeach; ?>
    </ul>

</body>

</html>