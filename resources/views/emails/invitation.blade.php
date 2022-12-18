<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Welcome on {{ config('app.name') }}</title>
</head>
<body>
<h2>Welcome {{ $user['first_name'] }}</h2>
<br/>
Your registered email is {{ $user['email'] }} , Please click on the below link to verify your email account
<br/>
<a href="{{ url('register', $token) }}">Verify Email</a>
</body>
</html>
