<?php
    session_start();
    require_once './config/config.php';

    $error = false;

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        
        $email = $_POST["email"];
        $password = $_POST["password"];

        //3. Ejecutar la consulta
        $result = $mysqli->query("SELECT * FROM USUARIS WHERE email = '$email' LIMIT 1");

        // 4. Comprobar si hay resultados
        if ($result && $result->num_rows > 0) {
            $user = $result->fetch_assoc();

            // 5. Comprobar si la contraseña es correcta. Desencriptar y comparar. con el metodo password_verify
            if (password_verify($password, $user['contrasenya'])) {
                // 6. Iniciar sesión
                $_SESSION['user_id']  = $user['ID'];
                $_SESSION['user_name']  = $user['nom'];
                $_SESSION['user_email']  = $user['email'];
                $_SESSION['user_role']  = $user['rol'];
                $_SESSION['user_picture']  = $user['imatge_perfil'];

                header('Location: index.php');
                exit();
            } else {
                $error = "Contraseña incorrecta";
            }

            // header('Location: index.php');
        } else {
            $error = "Usuario no encontrado";
        }
    }
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>

<body class="min-h-screen flex justify-center items-center">
    <div class="w-full max-w-xs">
        <form class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4" method="POST">
            <?php if (($error)): ?>
                <span class="text-red-500 text-center"><?php echo $error; ?></span>
            <?php endif; ?>
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="email">
                    Email:
                </label>
                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="email" type="email" placeholder="Email" name="email" required>
            </div>
            <div class="mb-6">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="password">
                    Contraseña
                </label>
                <input class="shadow appearance-none border border-red-500 rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline" id="password" type="password" placeholder="******************" name="password" required>
                <p class="text-red-500 text-xs italic">Introduce tu contraseña</p>
            </div>
            <div class="flex items-center justify-between">
                <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit">
                    Iniciar Sesión
                </button>
                <a class="inline-block align-baseline font-bold text-sm text-blue-500 hover:text-blue-800" href="register.php">
                    o regístrate
                </a>
            </div>
        </form>
    </div>

</body>

</html>