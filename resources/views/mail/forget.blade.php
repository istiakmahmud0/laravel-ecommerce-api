<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Password Reset</title>
</head>

<body>
    <p>You requested to reset your password. Click the link below to proceed:</p>
    <p>{{ $token }}</p>
    <a href="{{ url('/forget-password/' . $token) }}">Reset Password</a>
</body>

</html>
