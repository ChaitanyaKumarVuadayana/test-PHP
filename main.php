<?php
    // Initializing inputs
    $name = $_POST['name'];
    $age = $_POST['age'];
    $height = $_POST['height'];
    $email = $_POST['email'];
    $url = $_POST['url'];

    // Sanitizing the inputs
    // $name no need to filter
    $age = filter_var($age, FILTER_SANITIZE_NUMBER_INT);
    $height = filter_var($height, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
    $email = filter_var($email, FILTER_SANITIZE_EMAIL);
    $url = filter_var($url, FILTER_SANITIZE_URL);

    // Validating form
    if (!filter_var($age, FILTER_VALIDATE_INT, array("options" => array("min_range" => 1, "max_range" => 100)))) {
        echo "Invalid age; age should be from 1 to 100";
        exit();
    }

    if (!filter_var($height, FILTER_VALIDATE_FLOAT, array("options" => array("min_range" => 100, "max_range" => 300)))) {
        echo "Invalid height; height should be from 100 to 300";
        exit();
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "Invalid email format";
        exit();
    }

    if (!filter_var($url, FILTER_VALIDATE_URL)) {
        echo "Invalid URL format";
        exit();
    }

    // Sending data to data.txt
    $conn = fopen("data.txt", "a");
    fwrite($conn, "Name: " . $name . "\n");
    fwrite($conn, "Age: " . $age . "\n");
    fwrite($conn, "Height: " . $height . "\n");
    fwrite($conn, "Email: " . $email . "\n");
    fwrite($conn, "URL: " . $url . "\n\n");
    fclose($conn);

    echo "Succefully recored you information!"
?>

