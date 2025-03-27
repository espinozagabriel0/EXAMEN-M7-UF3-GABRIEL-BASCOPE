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
    <title>Vehiculos Admin</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>
    <?php include './components/header.php' ?>
    <div class="flex items-center justify-center gap-5">
        <h2 class="text-2xl text-center">Vehiculos</h2>
        <a class="text-green-500 text-4xl" href="añadir.php?table=VEHICLES">
            <i class="fa-solid fa-square-plus"></i>
        </a>

    </div>
    <div class="max-w-[90rem] mx-auto mt-5">
        <div class="relative overflow-x-auto">
            <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            #
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Modelo
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Categoria
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Precio Dia
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Imagen
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Disponible
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Acciones
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($vehicles as $vehiculo) {
                        echo " <tr class='bg-white border-b dark:bg-gray-800 dark:border-gray-700 border-gray-200'>
                        <th scope='row' class='px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white'>
                            {$vehiculo['id']}
                        </th>
                        <td class='px-6 py-4'>
                            {$vehiculo['model']}
                        </td>
                        <td class='px-6 py-4'>
                            {$vehiculo['categoria']}
                        </td>
                        <td class='px-6 py-4'>
                            {$vehiculo['preu_dia']}
                        </td>
                        <td class='px-6 py-4'>
                            {$vehiculo['imatge']}
                        </td>
                        <td class='px-6 py-4'>
                            {$vehiculo['disponible']}
                        </td>
                        <td class='pl-5'>
                            <a class='mr-4' href='editar.php?id={$vehiculo['id']}&table=VEHICLES'>
                                <i class='fa-solid fa-pen'></i>
                            </a>
                            <a href='eliminar.php?id=' . {$vehiculo['id']} . '&table=VEHICLES'>
                                <i class='fa-solid fa-trash-can'></i>
                            </a>
                        </td>
                    </tr>";
                    } ?>
                </tbody>
            </table>
        </div>

    </div>
</body>

</html>