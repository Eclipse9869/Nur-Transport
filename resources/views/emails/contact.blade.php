<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>New Contact Message</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            padding: 30px;
        }
        .container {
            max-width: 650px;
            margin: auto;
            background: #ffffff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        }
        h2 {
            color: #333;
            border-bottom: 2px solid #f39c12;
            padding-bottom: 10px;
        }
        p {
            line-height: 1.6;
            font-size: 14px;
            color: #555;
        }
        .label {
            font-weight: bold;
            color: #222;
        }
        .footer {
            margin-top: 30px;
            font-size: 12px;
            color: #999;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>📩 New Contact Message</h2>

        <p><span class="label">Name:</span> {{ $data['name'] }}</p>
        <p><span class="label">Email:</span> {{ $data['email'] }}</p>
        <p><span class="label">Phone:</span> {{ $data['phone'] ?? '-' }}</p>

        @if(!empty($data['subject']))
            <p><span class="label">Subject:</span> {{ $data['subject'] }}</p>
        @endif

        <p><span class="label">Message:</span></p>
        <p style="background: #f9f9f9; padding: 15px; border-radius: 5px; border-left: 4px solid #f39c12;">
            {{ $data['message'] }}
        </p>

        <div class="footer">
            This email was sent from the "Contact Us" form on your website.<br>
            &copy; {{ date('Y') }} Nur Trans. All rights reserved.
        </div>
    </div>
</body>
</html>
