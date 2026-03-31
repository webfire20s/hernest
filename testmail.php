<?php

require 'includes/mail.php'; // file where sendMail() exists

$result = sendMail(
    'sarthakagrwal10@gmail.com', // use Gmail for testing
    'Test Mail',
    '<b>This is a test email</b>'
);

if ($result) {
    echo "✅ Mail Sent";
} else {
    echo "❌ Mail Failed";
}