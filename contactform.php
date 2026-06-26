<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Collect form data safely
    $name     = htmlspecialchars($_POST['name']);
    $email    = htmlspecialchars($_POST['email']);
    $location = htmlspecialchars($_POST['location']);
    $phone    = htmlspecialchars($_POST['phone']);
    $subject  = htmlspecialchars($_POST['subject']);
    $message  = htmlspecialchars($_POST['message']);

    // Your receiving email
    $to = "info@marvelousafrica.com";

    // Email subject
    $emailSubject = "New Contact Message: $subject";

    // Email body
    $body = "You have received a new message from your website:\n\n";
    $body .= "-----------------------------\n";
    $body .= "Name: $name\n";
    $body .= "Email: $email\n";
    $body .= "Location: $location\n";
    $body .= "Phone: $phone\n";
    $body .= "Subject: $subject\n";
    $body .= "-----------------------------\n\n";
    $body .= "Message:\n$message\n";

    // IMPORTANT headers (improves deliverability)
    $headers = "From: info@marvelousafrica.com\r\n";
    $headers .= "Reply-To: $email\r\n";
    $headers .= "X-Mailer: PHP/" . phpversion();

    // Send email
    if (mail($to, $emailSubject, $body, $headers)) {
        // Redirect to success page (recommended)
        header("Location: thankyou.html");
        exit();
    } else {
        echo "❌ Message failed to send. Please try again.";
    }
}
?>