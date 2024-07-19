<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CardMarket FAKE</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background-color: #f4f4f4;
            color: #333;
            margin: 0;
            padding: 0;
        }

        h1, h2 {
            color: #007bff;
        }

        h1 {
            text-align: center;
            margin-top: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
            background-color: #ffffff;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        th, td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #007bff;
            color: #ffffff;
            font-weight: 700;
        }

        tr:hover {
            background-color: #f1f1f1;
        }

        form {
            text-align: center;
            margin: 20px 0;
        }

        button {
            background-color: #007bff;
            color: #ffffff;
            border: none;
            padding: 10px 20px;
            font-size: 16px;
            cursor: pointer;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }

        button:hover {
            background-color: #0056b3;
        }

        .navbar {
            background-color: #007bff;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 60px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .navbar-container {
            display: flex;
            align-items: center;
            max-width: 1200px;
            width: 100%;
            padding: 0 20px;
        }

        .navbar a {
            color: #ffffff;
            text-align: center;
            padding: 14px 20px;
            text-decoration: none;
            font-weight: 500;
            transition: background-color 0.3s ease, color 0.3s ease;
        }

        .navbar a:hover {
            background-color: #0056b3;
            color: #ffffff;
        }

        .right {
            margin-left: auto;
        }

        .login-container, .register-container {
            max-width: 500px;
            margin: 0 auto;
            padding: 20px;
            background-color: #ffffff;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }

        .login-container h2, .register-container h2 {
            margin-bottom: 20px;
            font-size: 24px;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-group label {
            display: block;
            margin-bottom: 5px;
            font-weight: 600;
        }

        .form-group input {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            box-sizing: border-box;
        }

        .form-group input:focus {
            border-color: #007bff;
            outline: none;
        }

        .error-message {
            color: #dc3545;
            margin-bottom: 20px;
            text-align: center;
        }
    </style>

</head>
<body>
    <h1>CardMarket FAKE</h1>

    <?php if (isset($_SESSION['email'])): ?>

    <div class="navbar">
        <div class="navbar-container">
            <a href="./index.php">Home</a>
            <a href="./index.php?model=utente&action=profile">Profilo</a>
            <a href="./index.php?model=gioco&action=menu">Giochi</a>
            <a href="./index.php?model=logout" class="right">Logout</a>
        </div>
    </div>

    <?php endif; ?>

    <div class="container">
        <?php
            // Includi il file della vista qui
            include($view_name);
        ?>
    </div>
</body>
</html>


