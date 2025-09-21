<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $country      = htmlspecialchars($_POST['country'] ?? '');
    $fname        = htmlspecialchars($_POST['fname'] ?? '');
    $lname        = htmlspecialchars($_POST['lname'] ?? '');
    $email        = htmlspecialchars($_POST['email'] ?? '');
    $phoneType    = htmlspecialchars($_POST['phoneType'] ?? '');
    $countryCode  = htmlspecialchars($_POST['countryCode'] ?? '');
    $phone        = htmlspecialchars($_POST['phone'] ?? '');

    $to = "hr@purefinestinc.com"; // <-- change this
    $subject = "New Talent Form Submission";

    $message = "
    New talent submission received:

    Country: $country
    Given Name: $fname
    Family Name: $lname
    Email: $email
    Phone Type: $phoneType
    Country Code: $countryCode
    Phone Number: $phone
    ";

    $headers = "From: hr@purefinestinc.com\r\n";
    if (!empty($email)) {
        $headers .= "Reply-To: $email\r\n";
    }

    if (mail($to, $subject, $message, $headers)) {
        // Redirect to success page
        header("Location: success.html");
        exit();
    } else {
        // Redirect to error page
        header("Location: error.html");
        exit();
    }
} else {
    echo "Invalid request.";
}
?>
