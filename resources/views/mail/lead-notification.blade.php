<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your One-Time Password (OTP)</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #e2e2e2;
            margin: 30px 10px;
            padding: 0;
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
        }
        .container {
            max-width: 800px;
            margin: 0;
            background-color: #ffffff;
            padding: 40px 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }
        .header {
            text-align: left;
            padding: 10px 0;
        }
        .header img {
            width: 120px;
        }
        .content {
            margin: 20px 0;
            text-align: left;
        }
        .otp {
            font-size: 20px;
            font-weight: bold;
            margin: 20px 0;
        }
        .footer {
            text-align: left;
            font-size: 12px;
            color: #888888;
            margin: 20px 0;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <img src="https://swayamvidya.edtechinnovate.com/assets/img/website/logo/logo.png" alt="Swayamvidya Logo">
        </div>
        <div class="content">
            <h2>We recieved a lead</h2>
            <table class="table">      
                <tr>
                    <th>Name</th>
                    <td>{{$leadData['name']}}</td>
                </tr>
                <tr>
                    <th>Phone</th>
                    <td>{{$leadData['phone']}}</td>
                </tr>
                <tr>
                    <th>Vertical</th>
                    <td>{{$leadData['vertical']}}</td>
                </tr>
                <tr>
                    <th>Program</th>
                    <td>{{$leadData['program']}}</td>
                </tr>
            </table>
            <p></p>
        </div>
        <div class="footer">
            <p>&copy; {{ date('Y') }} All Rights Reserved by Swayam Vidya.</p>
        </div>
    </div>
</body>
</html>