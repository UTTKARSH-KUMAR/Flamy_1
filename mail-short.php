<?php
/**
 * Author: Shadow Themes
 * Author URL: http://shadow-themes.com
 */

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    # Replace this email with your email address
    $mail_to = "flamywithus@gmail.com";

    # Message: You can modify that string with your text.
    $message = "Thnkyou for your response";

    # Subject: You can modify that string with your message.
    $subject = "Welcome to Flamy";

	# Collect Data
    $email = filter_var(trim($_POST["subscribe_email"]), FILTER_SANITIZE_EMAIL);

    if ( !filter_var($email, FILTER_VALIDATE_EMAIL) ) {
        # Set a 400 (bad request) response code and exit.
        http_response_code(400);
        echo "Please complete the form and try again.";
        exit;
    }

    # Mail Content
    $content = "Email: $email<br>";
    $content .= "Message:<br>$message<br>";

    # email headers.
    $headers = 	"From: " . $email . "\r\n" .
				"MIME-Version: 1.0" . "\r\n" .
				"Content-type: text/html; charset=utf-8" . "\r\n";

    # Send the email.
    if (mail($mail_to, $subject, $content, $headers)) {
        # Set a 200 (okay) response code.
        http_response_code(200);
        echo "Thank You! Your message has been sent.";
    } else {
        # Set a 500 (internal server error) response code.
        http_response_code(500);
        echo "Oops! Something went wrong, we couldn't send your message.";
    }
} else {
	# Not a POST request, set a 403 (forbidden) response code.
	http_response_code(403);
	echo "There was a problem with your submission, please try again.";
}
