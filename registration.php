<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Registrazione</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .register-container {
            width: 300px;
            margin: 0 auto;
            margin-top: 100px;
            border: 1px solid #ccc;
            padding: 20px;
            border-radius: 5px;
            background-color: #f9f9f9;
        }
        .form-group {
            margin-bottom: 10px;
        }
        .form-group label {
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
        }
        .form-group input {
            width: 100%;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 3px;
        }
        .form-group button {
            padding: 8px 15px;
            background-color: #007bff;
            border: none;
            color: #fff;
            cursor: pointer;
            border-radius: 3px;
        }
    </style>
</head>
<body>
    <div class="register-container">
        <h2>Registrazione</h2>
        <form action="registration_process.php" method="POST">
            <div class="form-group">
                <label>Email</label>
                <input type="email" name="email" required>
            </div>
            <div class="form-group">
                <label>Nome</label>
                <input type="text" name="nome" required>
            </div>
            <div class="form-group">
                <label>Cognome</label>
                <input type="text" name="cognome" required>
            </div>
            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" required>
            </div>
            <div class="form-group">
                <label>Stato</label>
                <input type="text" name="stato" required>
            </div>
            <div class="form-group">
                <label>CAP</label>
                <input type="text" name="cap" required>
            </div>
            <div class="form-group">
                <label>Provincia</label>
                <input type="text" name="provincia" required>
            </div>
            <div class="form-group">
                <label>Via</label>
                <input type="text" name="via" required>
            </div>
            <div class="form-group">
                <label>Civico</label>
                <input type="text" name="civico" required>
            </div>
            <div class="form-group">
                <button type="submit">Registrati</button>
            </div>
        </form>
    </div>
</body>
</html>
