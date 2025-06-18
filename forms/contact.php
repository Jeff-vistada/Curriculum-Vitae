<?php
// Set the recipient email address.
$to = 'jeffersonvistada@gmail.com';

// Get the form fields and remove whitespace.
$name = strip_tags(trim($_POST["name"]));
$email = filter_var(trim($_POST["email"]), FILTER_SANITIZE_EMAIL);
$subject = strip_tags(trim($_POST["subject"]));
$message = trim($_POST["message"]);

// Validate the input.
if (empty($name) || empty($message) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
    http_response_code(400);
    echo "Please complete the form correctly.";
    exit;
}

// Build the email content.
$email_content = "You have received a new message from your website contact form:\n\n";
$email_content .= "Name: $name\n";
$email_content .= "Email: $email\n\n";
$email_content .= "Subject: $subject\n\n";
$email_content .= "Message:\n$message\n";

// Build the email headers.
$email_headers = "From: $name <$email>";

// Send the email.
if (mail($to, $subject, $email_content, $email_headers)) {
    http_response_code(200);
    echo "Thank you! Your message has been sent.";
} else {
    http_response_code(500);
    echo "Oops! Something went wrong and we couldn't send your message.";
}
?>
