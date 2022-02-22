<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body style="text-transform: capitalize;">
    <h1>Hello {{$user->name}}</h1>
    <p>To verify your email, click the link below</p>
    <a href="{{url('user/verify' , $user->verifyUser->token)}}">Verify your email</a>
    
</body>
</html>