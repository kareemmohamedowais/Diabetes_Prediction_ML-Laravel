<!DOCTYPE html>
<html>
<head>
    <title>Contact Form Submission</title>
</head>
<body>
    <h1>{{ $details['name'] }} has sent you a message!</h1>
    <p>Email: {{ $details['email'] }}</p>
    <p>Message:</p>
    <p>{{ $details['message'] }}</p>
</body>
</html>

