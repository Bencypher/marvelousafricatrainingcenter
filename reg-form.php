<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Collect form data safely
    $name      = htmlspecialchars($_POST['name']);
    $email     = htmlspecialchars($_POST['email']);
    $phone     = htmlspecialchars($_POST['phone']);
    $status    = htmlspecialchars($_POST['status']);
    $address   = htmlspecialchars($_POST['address']);
    $gender    = htmlspecialchars($_POST['gender']);
    $dob       = htmlspecialchars($_POST['dob']);
    $education = htmlspecialchars($_POST['education']);
    $course    = htmlspecialchars($_POST['course']);
    $attested  = isset($_POST['attestation']) ? 'Yes' : 'No';

    // Handle signature file upload
    $signatureName = '';
    if (isset($_FILES['signature']) && $_FILES['signature']['error'] == 0) {
        $uploadDir = "uploads/signatures/";
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0755, true);
        }
        $signatureName = time() . "_" . basename($_FILES['signature']['name']);
        move_uploaded_file($_FILES['signature']['tmp_name'], $uploadDir . $signatureName);
    }

    // Your receiving email
    $to = "admissions@marvelousafrica.com";

    // Email subject
    $subject = "New Application: $name - $course";

    // Email body
    $body = "You have received a new application from your website:\n\n";
    $body .= "-----------------------------\n";
    $body .= "SECTION A: PERSONAL INFORMATION\n";
    $body .= "-----------------------------\n";
    $body .= "Full Name: $name\n";
    $body .= "Email: $email\n";
    $body .= "Phone: $phone\n";
    $body .= "Marital Status: $status\n";
    $body .= "Address: $address\n";
    $body .= "Gender: $gender\n";
    $body .= "Date of Birth: $dob\n";
    $body .= "Educational Level: $education\n\n";
    $body .= "-----------------------------\n";
    $body .= "SECTION B: PROGRAM SELECTION\n";
    $body .= "-----------------------------\n";
    $body .= "Preferred Course: $course\n";
    $body .= "Attestation Confirmed: $attested\n";
    $body .= "Signature File: $signatureName\n";

    // IMPORTANT headers (improves deliverability)
    $headers = "From: admissions@marvelousafrica.com\r\n";
    $headers .= "Reply-To: $email\r\n";
    $headers .= "X-Mailer: PHP/" . phpversion();

    // Send email
    if (mail($to, $subject, $body, $headers)) {
        // Redirect to success page (recommended)
        header("Location: thankyou.html");
        exit();
    } else {
        echo "❌ Application failed to send. Please try again.";
    }
}
?>