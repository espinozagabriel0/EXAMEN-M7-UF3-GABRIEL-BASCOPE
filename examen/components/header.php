<?php
    session_start();

?>

<nav class="bg-white border-gray-200 dark:bg-gray-900">
    <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">
        <span class="self-center text-2xl font-semibold whitespace-nowrap dark:text-white">EcoDrive</span>
        <div class="flex items-center justify-center md:order-2 space-x-3 md:space-x-0 rtl:space-x-reverse gap-3">

            <?php if (isset($_SESSION['user_id'])) : ?>
                <img src="<?= $_SESSION['user_picture'] ?>" class="" style="width: 50px; height: 50px; object-fit: cover;" alt="User Avatar">
                <p class="mt-3"><?= $_SESSION['user_name'] ?></p>
                <a href="logout.php" class="border p-1 rounded">Cerrar Sesión</a>

                <!-- Si el usuario es admin -->
                <?php if ($_SESSION['user_role'] === 'admin') : ?>
                    <a href="admin.php" class="btn btn-light btn-sm">
                        <img src="./assets/admin.png" class="rounded-circle img-fluid" style="width: 30px; height: 30px; object-fit: cover;" alt="Admin Icon">
                    </a>
                <?php endif; ?>
            <?php endif; ?>

        </div>
        <div class="items-center justify-between hidden w-full md:flex md:w-auto md:order-1" id="navbar-user">
            <ul class="flex flex-col font-medium p-4 md:p-0 mt-4 border border-gray-100 rounded-lg bg-gray-50 md:space-x-8 rtl:space-x-reverse md:flex-row md:mt-0 md:border-0 md:bg-white dark:bg-gray-800 md:dark:bg-gray-900 dark:border-gray-700">
                <li>
                    <a href="index.php" class="block py-2 px-3 text-white bg-blue-700 rounded-sm md:bg-transparent md:text-blue-700 md:p-0 md:dark:text-blue-500" aria-current="page">Home</a>
                </li>
                <li>
                    <a href="vehiculos.php" class="block py-2 px-3 text-gray-900 rounded-sm hover:bg-gray-100 md:hover:bg-transparent md:hover:text-blue-700 md:p-0 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent dark:border-gray-700">Vehiculos Disponibles</a>
                </li>
                <li>
                    <a href="reservar.php" class="block py-2 px-3 text-gray-900 rounded-sm hover:bg-gray-100 md:hover:bg-transparent md:hover:text-blue-700 md:p-0 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent dark:border-gray-700">Reservar</a>
                </li>
                <!-- <li>
                    <a href="#" class="block py-2 px-3 text-gray-900 rounded-sm hover:bg-gray-100 md:hover:bg-transparent md:hover:text-blue-700 md:p-0 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent dark:border-gray-700"></a>
                </li> -->
            </ul>
        </div>
    </div>
</nav>