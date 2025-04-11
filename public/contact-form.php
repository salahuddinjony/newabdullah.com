<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = htmlspecialchars($_POST["name"]);
    $email = filter_var($_POST["email"], FILTER_SANITIZE_EMAIL);
    $message = htmlspecialchars($_POST["message"]);

    $to = "your-email@example.com";  // Replace with your email
    $subject = "New contact form submission";
    $headers = "From: $email\r\nReply-To: $email\r\nContent-Type: text/plain\r\n";

    $body = "Name: $name\nEmail: $email\n\nMessage:\n$message";

    if (mail($to, $subject, $body, $headers)) {
        echo "Thank you! Your message has been sent.";
    } else {
        echo "Sorry, something went wrong. Try again.";
    }
} else {
    echo "Invalid request.";
}
?>