<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name = $_POST["name"];
    $email = $_POST["email"];
    $message = $_POST["message"];

    // Validate form data
    $errors = [];

    if (empty($name)) {
        $errors[] = "Name is required";
    }

    if (empty($email)) {
        $errors[] = "Email is required";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Invalid email format";
    }

    if (empty($message)) {
        $errors[] = "Message is required";
    }

    // If there are errors, display them to the user
    if (!empty($errors)) {
        echo "<h2>Error:</h2>";
        echo "<ul>";
        foreach ($errors as $error) {
            echo "<li>$error</li>";
        }
        echo "</ul>";
        exit;
    }

    // Process the form submission
    // Example: Send an email
    $to = "youremail@example.com";
    $subject = "New Contact Form Submission";
    $message = "Name: $name\nEmail: $email\nMessage: $message";
    $headers = "From: $email";

    if (mail($to, $subject, $message, $headers)) {
        // Success! Redirect to a thank you page
        header("Location: thank-you.html");
        exit;
    } else {
        // Error occurred while sending email
        echo "An error occurred while sending your message. Please try again later.";
        exit;
    }
}
?>
