<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OTP Code</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
            color: #333;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }
        .header {
            text-align: center;
            border-bottom: 2px solid #007bff;
            padding-bottom: 10px;
            margin-bottom: 20px;
        }
        .header h1 {
            font-size: 24px;
            color: #007bff;
            margin: 0;
        }
        .content {
            font-size: 16px;
            line-height: 1.5;
        }
        .otp-code {
            display: inline-block;
            font-size: 24px;
            font-weight: bold;
            color: #007bff;
            padding: 10px;
            border-radius: 4px;
            background: #e9f5ff;
            border: 1px solid #007bff;
        }
        .footer {
            margin-top: 20px;
            text-align: center;
            font-size: 14px;
            color: #777;
        }
        .footer p {
            margin: 0;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>OTP Verification Code</h1>
        </div>
        <div class="content">
            <p>Hello,</p>
            <p>Your OTP code is:</p>
            <p class="otp-code">{{ $otp }}</p>
            <p>This code will expire in 10 minutes.</p>
            <p>If you did not request this code, please ignore this email.</p>
        </div>
        <div class="footer">
            <p>Thank you for using our service.</p>
            <p>&copy; {{ date('Y') }} Your Company Name. All rights reserved.</p>
        </div>
    </div>
</body>
</html>
