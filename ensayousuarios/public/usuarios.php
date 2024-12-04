<?php
session_start();
require __DIR__ . '/../utilidades/conexion.php';
$q = "select * from usuarios";
$usuarios = mysqli_query($llave, $q);
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://cdn.tailwindcss.com"></script> <!-- CDN TailWind Css -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" /><!--CDN FontAwesome-->
</head>

<body class="bg-gray-50 dark:bg-gray-900">

    <h2 class="text-4xl font-bold dark:text-white py-2 px-2 text-center">Usuarios</h2>
    <br />
    <center>
        <?php
        if (isset($_SESSION['login'])) {
            echo '<a href="nuevo.php" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Nuevo usuario</a>';
            echo '<a href="cerrarsesion.php" class="text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 focus:outline-none dark:focus:ring-red-800">Cerrar sesión</a>';
            echo '<br/><br/>';
            echo '<h4 class="font-bold dark:text-white py-2 px-2 text-center">Now, you are login as ' . $_SESSION["login"] . ', and your role is ' . $_SESSION["loginRole"] . ' </h4> ';
        } else {
            echo '<a href="login.php" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Iniciar sesión</a>';
        }
        ?>
    </center>
    <div class="relative overflow-x-auto py-5 px-5">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        ID
                    </th>
                    <th scope="col" class="px-6 py-3">
                        NOMBRE
                    </th>
                    <th scope="col" class="px-6 py-3">
                        EMAIL
                    </th>
                    <th scope="col" class="px-6 py-3">
                        ROL
                    </th>
                    <th scope="col" class="px-6 py-3">
                        ACCIONES
                    </th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($usuarios as $usuario) {
                    echo <<< TXT
                                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        {$usuario['id']}
                    </th>
                    <td class="px-6 py-4">
                        {$usuario['nombre']}
                    </td>
                    <td class="px-6 py-4">
                        {$usuario['email']}
                    </td>
                    <td class="px-6 py-4">
                        {$usuario['rol']}
                    </td>
 
                    TXT;
                    if (isset($_SESSION['loginRole'])) {
                        if ($_SESSION['loginRole'] == 'Admin') {
                            echo <<< TXT
                <td class="px-6 py-4">
                <a href="update.php?id={$usuario['id']}" class="focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-900">Actualizar</a>
                    <a href="delete.php?id={$usuario['id']}" class="focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900"  onclick="return confirm('¿Desea eliminar al usuario?')">Eliminar</a>
                </td>
                TXT;
                        } else {
                            echo '<td class="px-6 py-4">';
                            echo "NO DISPONIBLE";
                            echo '</td>';
                        }
                    } else {
                        echo '<td class="px-6 py-4">';
                        echo "NO DISPONIBLE";
                        echo '</td>';
                    }
                }
                ?>
            </tbody>
        </table>
    </div>

</body>

</html>