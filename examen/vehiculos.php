<?php
session_start();
require_once './config/config.php';

if (!isset($_SESSION["user_id"])) {
    header("Location: index.php");
    exit();
}

$result = $mysqli->query("SELECT * FROM VEHICLES");
$vehicles = $result->fetch_all(MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vehículos</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>

<body class="bg-gray-100">
    <?php include './components/header.php'; ?>

    <div class="container mx-auto px-4 py-8">
        <h1 class="text-3xl font-bold mb-6">Vehículos Disponibles</h1>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <?php foreach ($vehicles as $vehicle) : ?>

                <div class="bg-white rounded-lg shadow-md overflow-hidden">
                    <img src="<?php echo $vehicle['imatge']; ?>" alt="<?php echo $vehicle['model']; ?>" class="w-full h-48 object-cover">
                    <div class="p-4">
                        <h2 class="text-xl font-semibold mb-2"><?php echo $vehicle['model']; ?></h2>
                        <p class="text-gray-600 mb-2">Categoría: <?php echo $vehicle['categoria']; ?></p>
                        <p class="text-green-600 font-bold">Precio por día: €<?php echo $vehicle['preu_dia']; ?></p>

                        <?php if ($_SESSION['user_role'] === 'admin') : ?>
                            <div class="mt-4 flex justify-between">
                                <a href="editar.php?id=<?php echo $vehicle['id']; ?>&table=VEHICLES" class="text-blue-500 hover:text-blue-700">
                                    <i class="fa-solid fa-pen"></i> Editar
                                </a>
                                <a href="eliminar.php?id=<?php echo $vehicle['id']; ?>&table=VEHICLES" class="text-red-500 hover:text-red-700">
                                    <i class="fa-solid fa-trash-can"></i> Eliminar
                                </a>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</body>

</html>