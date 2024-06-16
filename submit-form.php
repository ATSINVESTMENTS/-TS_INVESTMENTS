<?php
// Check if the form is submitted using POST method
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate and sanitize form inputs
    $name = trim($_POST['name']);
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $message = trim($_POST['message']);

    // Validate inputs
    if (empty($name) || empty($email) || empty($message)) {
        // Handle empty fields
        echo '<p>Please fill in all fields.</p>';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        // Handle invalid email format
        echo '<p>Please enter a valid email address.</p>';
    } else {
        // All inputs are valid, proceed to send email
        $to = 'atanmay256@gmail.com'; // Replace with your email address
        $subject = 'New Contact Form Submission';
        $body = "Name: $name\nEmail: $email\n\nMessage:\n$message";
        $headers = "From: $email";

        // Send email
        if (mail($to, $subject, $body, $headers)) {
            // Email sent successfully
            echo '<p>Thank you for your message. We will contact you shortly.</p>';
        } else {
            // Email not sent
            echo '<p>Sorry, there was an error sending your message. Please try again later.</p>';
        }
    }
} else {
    // Redirect back to the contact form if accessed directly without submitting the form
    header('Location: contact.html');
    exit;
}
?>
