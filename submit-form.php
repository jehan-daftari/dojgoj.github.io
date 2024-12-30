<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect and sanitize input data
    $name = htmlspecialchars(trim($_POST['name']));
    $email = htmlspecialchars(trim($_POST['email']));
    $message = htmlspecialchars(trim($_POST['message']));

    // Validate input (basic validation)
    if (!empty($name) && !empty($email) && !empty($message) && filter_var($email, FILTER_VALIDATE_EMAIL)) {
        // Prepare the email
        $to = "daftari.jehan@gmail.com"; // Replace with your email address
        $subject = "New Contact Form Submission for DOJ/GOJ";
        $body = "Name: $name\nEmail: $email\nMessage:\n$message";
        $headers = "From: $email";

        // Send the email
        if (mail($to, $subject, $body, $headers)) {
            echo json_encode(["status" => "success", "message" => "Thank you for your message! We will get back to you soon."]);
        } else {
            echo json_encode(["status" => "error", "message" => "There was an error sending your message. Please try again later."]);
        }
    } else {
        echo json_encode(["status" => "error", "message" => "Please fill in all fields correctly."]);
    }
} else {
    echo json_encode(["status" => "error", "message" => "Invalid request method."]);
}
?>