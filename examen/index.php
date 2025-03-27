<?php
    session_start();
    require_once './config/config.php';

    if (!isset($_SESSION["user_id"])) {
        header("Location: index.php");
        exit();
    }

    $id = $_SESSION["user_id"];
    $result = $mysqli->query("SELECT * FROM RESERVES WHERE id_usuari = $id");

    $reservas = $result->fetch_all(MYSQLI_ASSOC);

    // print_r($reservas);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EcoDrive</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>
<body>
    <?php include './components/header.php'; ?> 
    <div class="container mx-auto py-5">
        <h1 class="text-4xl text-center">EcoDrive</h1>
        
        <h2 class="text-3xl">Tus Reservas: </h2>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3">
            <!-- Cards reservas -->
        </div>
    </div>
</body>
</html>