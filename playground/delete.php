<?php

if (isset($_GET['name'])) {
    $contactsFile = 'contacts.json';
    $contacts = file_exists($contactsFile) ? json_decode(file_get_contents($contactsFile), true) : [];


    // 1. Find the specific contact to get the image path
    $nameToDelete = $_GET['name'];
    $targetContact = null;

    foreach ($contacts as $contact) {
        if ($contact['name'] === $nameToDelete) {
            $targetContact = $contact;
            break;
        }
    }

    // 2. Delete the image if it exists
    if ($targetContact && isset($targetContact['image']) && file_exists($targetContact['image'])) {
        if (unlink($targetContact['image'])) {
            echo "Image Deleted successfully. ";
        } else {
            echo "Error: The image could not be deleted. ";
        }
    }

    $contacts = array_filter($contacts, fn($c) => $c["name"] !== $_GET["name"]);

    file_put_contents($contactsFile, json_encode($contacts, JSON_PRETTY_PRINT));

    echo "Contact Deleted";
}
