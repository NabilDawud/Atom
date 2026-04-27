<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Email</title>
</head>

<body>
    <div
        style="max-width: 600px; margin: 0 auto; padding: 20px; font-family: Arial, sans-serif; background-color: #f9f9f9; border: 1px solid #ddd;">
        <h2 style="color: #333;">New Contact Message</h2>
        <p style="color: #555;"><strong>Name:</strong> {{ $data['name'] }}</p>
        <p style="color: #555;"><strong>Email:</strong> {{ $data['email'] }}</p>
        <p style="color: #555;"><strong>Message:</strong></p>
        <p style="color: #555; white-space: pre-wrap;">{{ $data['message'] }}</p>

    </div>
</body>

</html>
