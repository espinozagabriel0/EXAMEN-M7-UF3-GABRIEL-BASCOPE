<?php
session_start();
require_once './config/config.php';

if (!isset($_GET['id']) || !isset($_GET['table'])) {
    header('Location: index.php');
    exit();
}

$id = $_GET['id'];
$table = $_GET['table'];

$result = $mysqli->query("SELECT * FROM VEHICLES WHERE id = $id LIMIT 1");
$vehicle = $result->fetch_all(MYSQLI_ASSOC);

// print_r($vehicle)
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar</title>
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
                    <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="model" type="text" placeholder="modelo" name="model" value="<?php echo $vehicle[0]['model']; ?>" required>
                </div>
                <div class="mb-6">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="categoria">
                        Categoria
                    </label>
                    <input class="shadow appearance-none border  rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline" id="categoria" type="text" name="categoria" value="<?php echo $vehicle[0]['categoria']; ?>" required>
                </div>
                <div class="mb-6">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="preu_dia">
                        Precio Dia
                    </label>
                    <input class="shadow appearance-none border  rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline" id="preu_dia" type="number" name="preu_dia" value="<?php echo $vehicle[0]['preu_dia']; ?>" required>
                </div>
                <div class="mb-6">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="imatge">
                        Imagen
                    </label>
                    <input type="file" class="shadow appearance-none border  rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline" id="imatge" name="imatge" accept="image/*">
                    <?php if (!empty($vehicle[0]['imatge'])): ?>
                        <p class="text-sm text-gray-600">Imagen actual <?php echo $vehicle[0]['imatge']; ?></p>
                    <?php endif; ?>
                </div>
                <div class="mb-6">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="disponible">
                        Disponible
                    </label>
                    <input type="checkbox" id="disponible" name="disponible" value="1" <?php echo $vehicle[0]['disponible'] ? 'checked' : ''; ?>>
                </div>
                <div class="flex items-center justify-between">
                    <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline w-full" type="submit">
                        Actualizar
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