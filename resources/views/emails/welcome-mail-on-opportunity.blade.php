<!DOCTYPE html>
<html>

<head>
  <title>Welcome to {{ $vertical }}</title>
  <style>
    /* Responsive Design */
    @media screen and (max-width: 600px) {
      .container {
        width: 100% !important;
      }
    }

    .container {
      max-width: 600px;
      margin: 0 auto;
      font-family: Arial, sans-serif;
      background-color: #f9f9f9;
      padding: 20px;
      border-radius: 10px;
      box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    }

    .header {
      text-align: center;
      font-size: 24px;
      font-weight: bold;
      color: #333;
    }

    .content {
      font-size: 16px;
      color: #555;
      line-height: 1.6;
    }

    .login-button {
      display: inline-block;
      background-color: #007BFF;
      color: white;
      padding: 12px 20px;
      text-decoration: none;
      font-size: 16px;
      font-weight: bold;
      border-radius: 5px;
      margin-top: 15px;
      text-align: center;
    }

    .login-button:hover {
      background-color: #0056b3;
    }

    .footer {
      margin-top: 20px;
      font-size: 14px;
      color: #777;
      text-align: center;
    }
  </style>
</head>

<body>

  <div class="container">
    <div class="header">Welcome to {{ $vertical }}</div>

    <p>Hi <strong>{{ $name }}</strong>,</p>

    <p class="content">
      Welcome onboard to <strong>{{ $vertical }}</strong> in the program <strong>{{ $program }}</strong>.
    </p>

    <p class="content">Please find below your LMS login credentials:</p>

    <p><strong>Username:</strong> {{ $student_id }}</p>
    <p><strong>Password:</strong> Password will be the same as your username</p>

    <!-- Login Button -->
    <p style="text-align: center;">
      <a href="{{ $login_url }}" class="login-button">
        Click here to login
      </a>
    </p>

    <p class="footer">
      Best Regards, <br>Swayam Vidya
    </p>
  </div>

</body>

</html>
