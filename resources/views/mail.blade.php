<!DOCTYPE html>
<html>
<head>
    <title>Contact Form Submission</title>
    <style>
        body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; }
        .container { max-width: 600px; margin: 0 auto; padding: 20px; }
        h3 { color: #2c3e50; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { padding: 12px; text-align: left; border: 1px solid #ddd; }
        th { background-color: #f2f2f2; width: 30%; }
    </style>
</head>
<body>
    <div class="container">
        <h3>New Contact Form Submission</h3>
        <p>You have received a new message from your hotel website contact form:</p>
        <table>
            <tr>
                <th>Full Name</th>
                <td>{{$full_name}}</td>
            </tr>
            <tr>
                <th>Email</th>
                <td>{{$email}}</td>
            </tr>
            <tr>
                <th>Subject</th>
                <td>{{$subject}}</td>
            </tr>
            <tr>
                <th>Message</th>
                <td>{{$msg}}</td>
            </tr>
        </table>
    </div>
</body>
</html>