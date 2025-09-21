<?php
// talent_submit.php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect form fields
    $country      = htmlspecialchars($_POST['country'] ?? '');
    $fname        = htmlspecialchars($_POST['fname'] ?? '');
    $lname        = htmlspecialchars($_POST['lname'] ?? '');
    $email        = htmlspecialchars($_POST['email'] ?? '');
    $phoneType    = htmlspecialchars($_POST['phoneType'] ?? '');
    $countryCode  = htmlspecialchars($_POST['countryCode'] ?? '');
    $phoneNumber  = htmlspecialchars($_POST['phoneNumber'] ?? '');

    // Handle file upload
    $uploadDir = "uploads/";
    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0777, true);
    }

    $resumeName = basename($_FILES["resume"]["name"]);
    $targetFile = $uploadDir . time() . "_" . preg_replace("/[^a-zA-Z0-9._-]/", "_", $resumeName);

    $uploadOk = 1;
    $fileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

    // Allow certain file formats
    $allowedTypes = ["pdf", "doc", "docx"];
    if (!in_array($fileType, $allowedTypes)) {
        echo "Sorry, only PDF, DOC & DOCX files are allowed.";
        $uploadOk = 0;
    }

    if ($uploadOk && move_uploaded_file($_FILES["resume"]["tmp_name"], $targetFile)) {
        // Prepare email
        $to = "taiwoomosehin6@gmail.com";  // Change this to your HR email
        $subject = "New Talent Community Submission from $fname $lname";

        $message = "
        A new candidate has joined the Talent Community:
        
        Country: $country
        Name: $fname $lname
        Email: $email
        Phone: $countryCode $phoneNumber ($phoneType)
        
        Resume: $targetFile
        ";

        $headers = "From: no-reply@yourdomain.com";

        mail($to, $subject, $message, $headers);

        echo "Thank you, $fname! Your information has been submitted successfully.";
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
} else {
    echo "Invalid request.";
}
?>
