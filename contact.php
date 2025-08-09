<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $first_name = htmlspecialchars(trim($_POST["first_name"]));
  $last_name = htmlspecialchars(trim($_POST["last_name"]));
  $email = htmlspecialchars(trim($_POST["email"]));
  $subject = htmlspecialchars(trim($_POST["subject"]));
  $message = htmlspecialchars(trim($_POST["message"]));

  // Optional validation
  if ($first_name && $last_name && $email && $subject && $message) {
    $to = "brandprotection@purefinestinc.com"; // ✅ Replace with your email
    $subject_line = "New Contact Message: $subject";
    $headers = "From: $email\r\nReply-To: $email\r\nContent-Type: text/plain; charset=UTF-8";

    $body = "Name: $first_name $last_name\n";
    $body .= "Email: $email\n";
    $body .= "Subject: $subject\n\n";
    $body .= "Message:\n$message";

    if (mail($to, $subject_line, $body, $headers)) {
      header("Location: thank-you.html");
      exit();
    } else {
      echo "Failed to send message.";
    }
  } else {
    echo "All fields are required.";
  }
} else {
  echo "Invalid request.";
}
?>
