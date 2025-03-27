<?php
session_start();

if (!isset($_SESSION["user_id"])) {
    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>

<body>
    <?php include './components/header.php'; ?>
    <h2 class="text-center text-3xl">Admin Panel</h2>
    <div class="container mx-auto grid grid-cols-1 md:grid-cols-3 gap-3 mt-5">
        <a href="vehiculosAdmin.php" class="border rounded shadow py-5 flex items-center justify-center">Vehiculos</a>
        <a href="reservasAdmin.php" class="border rounded shadow py-5 flex items-center justify-center">Reservas</a>
        <a href="usuariosAdmin.php" class="border rounded shadow py-5 flex items-center justify-center">Usuarios</a>
    </div>
</body>

</html>