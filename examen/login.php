<?php
require_once './config/config.php';
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>

<body>

    <div class="mx-auto container">

        <form action="" method="POST" class="">
            <div class="flex flex-col">
                <label for="email">Email: </label>
                <input type="email" id="email" name="email" required>
            </div>

            <div class="d-flex flex-column mb-3">
                <label for="password">Contraseña: </label>
                <input type="password" id="password" name="password" required>
            </div>

            <input type="submit" value="Iniciar Sesión" class="btn btn-primary">
            <a href="register.php" class="text-center">o regístrate</a>
        </form>
    </div>
</body>

</html>