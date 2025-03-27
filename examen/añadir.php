<?php
    session_start();
    require './config/config.php';

    if (!isset($_SESSION["user_id"]) || !isset($_GET['table'])) {
        header("Location: index.php");
        exit();
    }

    $table = $_GET['table'];
    $uploadDir = 'uploads/' . strtolower($table) . '/';

    $campos = [
        'USUARIOS' => ['nom', 'email', 'contrasenya', 'rol', 'imatge_perfil'],
        'VEHICLES' => ['model', 'categoria', 'preu_dia', 'imatge', 'disponible'],
        'RESERVES' => ['data_inici', 'data_fi', 'estat', 'preu_total', 'id_usuari', 'id_vehicle'],
    ];

    if($_SERVER["REQUEST_METHOD"] == "POST"){
        if ($table == "VEHICLES") {
            $model = $_POST['model'];
            $categoria = $_POST['categoria'];
            $preu_dia = $_POST['preu_dia'];
            $disponible = isset($_POST['disponible']) ? 1 : 0;
        } else if($table == "USUARIOS"){
            $nom = $_POST['nom'];
            $email = $_POST['email'];
            $contrasenya = password_hash($_POST['contrasenya'], PASSWORD_DEFAULT);
        } else if($table == "RESERVES"){
            $data_inici = $_POST['data_inici'];
            $data_fi = $_POST['data_fi'];
            $estat = $_POST['estat'];
            $preu_total = $_POST['preu_total'];
            $id_usuari = $_POST['id_usuari'];
            $id_vehicle = $_POST['id_vehicle'];
        }

        // $imgs = $table == "VEHICLES" ? "imatge" : $table == "USUARIOS" ? "imatge_perfil" : "";
        // var_dump($imgs);

        if (isset($_FILES['imatge']) && $_FILES['imatge']['error'] === UPLOAD_ERR_OK) {
            $fileTmpPath = $_FILES[$imgs]['tmp_name'];
            $fileName = $_FILES[$imgs]['name'];
    
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
    
        $cols = implode(", ", $campos[$table]);
        $stmt; 
        $values = [];
        $types = "";

        if ($table == "VEHICLES") {
            $stmt = $mysqli->prepare("INSERT INTO $table ($cols) VALUES (?, ?, ?, ?, ?)");
            $values = [$model, $categoria, $preu_dia, $newFileName, $disponible];
            $types = "ssdsi";
        } else if($table == "USUARIOS"){
            $stmt = $mysqli->prepare("INSERT INTO $table ($cols) VALUES (?, ?, ?, 'user', ?)");
            $values = [$nom, $email, $contrasenya, $newFileName];
            $types = "ssss";
        } else if($table == "RESERVES"){
            $stmt = $mysqli->prepare("INSERT INTO $table ($cols) VALUES (?, ?, ?, ?, ?, ?)");
            $values = [$data_inici, $data_fi, $estat, $preu_total, $id_usuari, $id_vehicle];
            $types = "sssdii";
        }

        $stmt->bind_param($types, ...$values);
        $stmt->execute();

        // Redirigir a panel
        header("Location: admin.php");
        exit();
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Añadir</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>

<body class="min-h-screen flex justify-center items-center">
    <div class="w-full max-w-xl">
        <form class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4" method="POST" enctype="multipart/form-data">
            <?php if ($table == "VEHICLES") : ?>
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="model">
                        Modelo:
                    </label>
                    <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="model" type="text" placeholder="modelo" name="model" required>
                </div>
                <div class="mb-6">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="categoria">
                        Categoria
                    </label>
                    <input class="shadow appearance-none border  rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline" id="categoria" type="text" name="categoria" required>
                </div>
                <div class="mb-6">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="preu_dia">
                        Precio Dia
                    </label>
                    <input class="shadow appearance-none border  rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline" id="preu_dia" type="number" name="preu_dia" required>
                </div>
                <div class="mb-6">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="imatge">
                        Imagen
                    </label>
                    <input type="file" class="shadow appearance-none border  rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline" id="imatge" name="imatge" accept="image/*" required>
                </div>
                <div class="mb-6">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="disponible">
                        Disponible
                    </label>
                    <input type="checkbox" id="disponible" name="disponible" value="1">
                </div>
                <div class="flex items-center justify-between">
                    <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline w-full" type="submit">
                        Añadir
                    </button>
                </div>
            <?php endif; ?>

            <?php if ($table == "USUARIOS") : ?>
            <?php endif; ?>
            <?php if ($table == "RESERVES") : ?>
            <?php endif; ?>
        </form>
    </div>
</body>

</html>
