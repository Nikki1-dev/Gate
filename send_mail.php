<?php
if (isset($_GET['email'])) {
    $to = $_GET['email'];
    $subject = "Service Report Pending";
    $message = "Dear User,\n\nYour service report is still pending. Please take action.\n\nBest Regards,\nService Team";
    $headers = "From: your_email@example.com\r\n";
    $headers .= "Reply-To: your_email@example.com\r\n";
    $headers .= "Content-Type: text/plain; charset=UTF-8\r\n";

    // Send Email
    if (mail($to, $subject, $message, $headers)) {
        echo "Mail sent successfully to $to";
    } else {
        echo "Failed to send mail";
    }
} else {
    echo "Email address not provided.";
}
?>
