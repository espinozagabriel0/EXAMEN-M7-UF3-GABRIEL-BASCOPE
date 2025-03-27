<?php
// session_start();
require_once('./config/config.php');

$uploadDir = 'uploads/avatares/';

$mensaje = false;
if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    if (isset($_FILES['avatar']) && $_FILES['avatar']['error'] === UPLOAD_ERR_OK) {
        $fileTmpPath = $_FILES['avatar']['tmp_name'];
        $fileName = $_FILES['avatar']['name'];

        $fileNameCmps = explode(".", $fileName);
        $fileExtension = strtolower(end($fileNameCmps));


        $allowedExtension = ['jpg', 'jpeg', 'png', 'gif'];
        if (in_array($fileExtension, $allowedExtension)) {
            $newFileName = md5(time() . $fileName) . '.' . $fileExtension;

            $dest_path = $uploadDir . $newFileName;


            if (!move_uploaded_file($fileTmpPath, $dest_path)) {
                die('Error: No se pudo mover el archivo a la carpeta de destino.');
            }
        } else {
            die('Error: Solo se permiten archivos de imagen (jpg, jpeg, png, gif)');
        }
    } else {
        die('Error: La foto no se subió correctamente.');
    }


    // 1. password cifrada
    $passwordHashed = password_hash($password, PASSWORD_DEFAULT);

    // 2. preparar consulta antes de insertar para evitar sql injection
    $stmt = $mysqli->prepare(
        "INSERT INTO USUARIS (nom, email, contrasenya, rol, imatge_perfil) VALUES (?, ?, ?, 'user', ?)"
    );

    // 3. Comprobar que la preparación tuvo exito
    if (!$stmt) {
        die('Error en la preparación ' . $mysqli->error);
    }

    // 4. Bindear parametros (o setear)
    $stmt->bind_param('ssss', $name, $email, $passwordHashed, $dest_path);


    // 5. Ejecutar consulta
    if ($stmt->execute()) {
        $mensaje  = 'success';
    } else {
        $mensaje = 'error';
        $stmt->close();
        $mysqli->close();
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrate</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>

<body class="min-h-screen flex justify-center items-center">
    <div class="w-full max-w-xs">
        <form class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4" method="POST" enctype="multipart/form-data">
            <?php if ($mensaje == "error"): ?>
                <span class="text-center text-red-500"><?php echo "Error al registrar el usuario"; ?></span>
            <?php elseif ($mensaje == "success"): ?>
                <span class="text-center text-green-500"><?php echo "Usuario registrado correctamente"; ?></span>
            <?php endif; ?>

            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="name">
                    Nombre:
                </label>
                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="name" type="text" placeholder="Tu nombre" name="name" required>
            </div>
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
                <p class="text-red-500 text-xs italic">Elige una contraseña.</p>
            </div>
            <div class="mb-6">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="avatar">
                    Avatar
                </label>
                <input type="file" class="shadow appearance-none border border-red-500 rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline" id="avatar" name="avatar" accept="image/*" required>
                <p class="text-red-500 text-xs italic">Elige un avatar</p>
            </div>
            <div class="flex items-center justify-between">
                <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit">
                    Registrarse
                </button>
                <a class="inline-block align-baseline font-bold text-sm text-blue-500 hover:text-blue-800" href="login.php">
                    o inicia sesión
                </a>
            </div>
        </form>
    </div>
</body>

</html>