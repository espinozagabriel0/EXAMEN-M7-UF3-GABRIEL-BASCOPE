<?php

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrate</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>

<body>
    <form action="" method="POST" class="d-flex flex-column" enctype="multipart/form-data">
        <div class="d-flex flex-column">
            <label for="name">Nombre: </label>
            <input type="text" id="name" name="name" required><br><br>
        </div>

        <div class="d-flex flex-column">
            <label for="email">Email: </label>
            <input type="email" id="email" name="email" required><br><br>
        </div>

        <div class="d-flex flex-column">
            <label for="password">Contraseña: </label>
            <input type="password" id="password" name="password" required><br><br>
        </div>

        <div class="d-flex flex-column">
            <label for="picture">Picture: </label>
            <input type="file" id="picture" name="picture" placeholder="URL de la imagen" accept="image/*"><br><br>
        </div>

        <input type="submit" value="Registrarse" class="btn btn-primary">
        <a href="login.php" class="text-center">o inicia sesión</a>
    </form>
</body>

</html>