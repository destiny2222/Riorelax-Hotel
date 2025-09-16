<!DOCTYPE html>
<html>
<head>
    <title>Booking Confirmation</title>
</head>
<body>
    <h1>Booking Confirmation</h1>
    <p>Dear {{ $booking->user->name }},</p>
    <p>Your booking has been confirmed. Please find your booking details below:</p>
    <ul>
        <li>Booking ID: {{ $booking->id }}</li>
        <li>Room: {{ $booking->roomListing->room_title }}</li>
        <li>Check-in: {{ $booking->check_in }}</li>
        <li>Check-out: {{ $booking->check_out }}</li>
        <li>Adults: {{ $booking->adults }}</li>
        <li>Children: {{ $booking->children }}</li>
    </ul>
    <p>Please present the QR code below upon check-in:</p>
    <img src="{{ $qrCodeUrl }}" alt="QR Code">
</body>
</html>
