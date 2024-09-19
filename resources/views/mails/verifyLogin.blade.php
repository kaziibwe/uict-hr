<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OTP Verification</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 600px;
            margin: 50px auto;
            background-color: #ffffff;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
            border-radius: 8px;
            overflow: hidden;
        }
        .header {
            background-color: #2550af;
            color: #ffffff;
            padding: 20px;
            text-align: center;
        }
        .content {
            padding: 20px;
            text-align: center;
        }
        .otp-code {
            display: inline-block;
            font-size: 24px;
            letter-spacing: 8px;
            background-color: #f0f0f0;
            padding: 10px 20px;
            border-radius: 4px;
            margin: 20px 0;
        }
        .footer {
            background-color: #f4f4f4;
            color: #888888;
            text-align: center;
            padding: 10px;
            font-size: 12px;
        }
        .footer a {
            color: #4CAF50;
            text-decoration: none;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>OTP Verification from Uict Hr System</h1>
        </div>
        <div class="content">
            <p>Dear User,</p>
            <p>Please use the following OTP to complete your verification process:</p>
            <div class="otp-code">{{ $data['velification_code'] }}</div>
            <p>This OTP is valid for 20 minutes. Do not share it with anyone.</p>
            <p>Thank you for verifying the login!</p>
        </div>
        <div class="footer">
            <p>If you didn't request this, please ignore this email or contact support.</p>
            <p>© 2024 Your Company. All rights reserved.</p>
            <p><a href="mailto:support@uict.com">support@uict.com</a></p>
        </div>
    </div>
</body>
</html>
