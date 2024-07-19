<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CardMarket FAKE</title>
    <style>
    .navbar {
        background-color: #333;
        display: flex;
        justify-content: center;
        align-items: center;
        height: 60px; /* Puoi regolare l'altezza come desideri */
    }
    .navbar-container {
        display: flex;
        align-items: center;
    }
    .navbar a {
        color: #f2f2f2;
        text-align: center;
        padding: 14px 16px;
        text-decoration: none;
    }
    .navbar a:hover {
        background-color: #ddd;
        color: black;
    }
    .right {
        margin-left: auto;
        display: flex;
        align-items: center;
    }
</style>
</head>
<body>
    <h1>CardMarket FAKE</h1>

    <?php if (isset($_SESSION['email'])): ?>

    <div class="navbar">
        <a href="./index.php">Home</a>
        <a href="./index.php?model=utente&action=profilo">Profilo</a>
        <a href="./index.php?model=gioco&action=menu">Giochi</a>
        <a href="./index.php?model=logout" class="right">Logout</a>
    </div>

    <?php endif; ?>


    <?php
        // Includi il file della vista qui 
        include($view_name);
    ?>
</body>
</html>

