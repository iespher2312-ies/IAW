<?php
require __DIR__ . '/../utilidades/conexion.php'; //Llamamos al archivo conexión
$q = 'select * from productos'; //Declaramos la consulta
$stmt = mysqli_stmt_init($llave); //Inicializamos una sesión de MySQL
$productos = mysqli_query($llave, $q); //Guardamos el resultado de la consulta en una variable
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

<body class="bg-gray-50 dark:bg-gray-900 py-4 px-4">


    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <caption class="p-5 text-lg font-semibold text-left rtl:text-right text-gray-900 bg-white dark:text-white dark:bg-gray-800">
                Nuestros productos!
                <p class="mt-1 text-sm font-normal text-gray-500 dark:text-gray-400">A continuación, tiene una lista con todos nuestros productos.
                </p>
                <div>
                    <a type=submit href="nuevo.php" class="text-right font-small text-blue-600 dark:text-blue-500 hover:underline">Clique aquí para añadir un nuevo producto...</a>
                </div>
                </p>
            </caption>

    </div>
    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
        <tr>
            <th scope="col" class="px-6 py-3">
                ID del producto
            </th>
            <th scope="col" class="px-6 py-3">
                Nombre
            </th>
            <th scope="col" class="px-6 py-3">
                Descripción
            </th>
            <th scope="col" class="px-6 py-3">
                Tipo
            </th>
            <th scope="col" class="px-6 py-3">
                <span class="sr-only">Edit</span>
            </th>
            <th scope="col" class="px-6 py-3 text-red-600">
                <span class="sr-only">Delete</span>
            </th>
        </tr>
    </thead>
    <tbody>
        <?php
        foreach ($productos as $producto) {
            if ($producto['tipo'] == 'Bazar') {
                $color = 'text-green-600';
            } elseif ($producto['tipo'] == 'Limpieza') {
                $color = 'text-orange-600';
            } else {
                $color = 'text-blue-600';
            };
            echo <<< TXT
            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                    {$producto['id']}
                </th>
                <td class="px-6 py-4">
                    {$producto['nombre']}
                </td>
                <td class="px-6 py-4">
                    {$producto['descripcion']}
                </td>
                <td class="px-6 py-4 $color">
                    {$producto['tipo']}
                </td>
                <td class="px-6 py-4 text-right">
                <form action='update.php?id' method='GET'>
                    <input type='hidden' name='id' value="{$producto['id']}" />
                    <button type=submit href="update.php" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Editar</button>
                </form>
                    </td>
                <td class="px-6 py-4 text-right">
                     <form action='delete.php?id' method='GET'>
                    <input type='hidden' name='id' value="{$producto['id']}" />
                    <button type=submit href="delete.php" class="font-medium text-red-600 dark:text-red-500 hover:underline" onclick="return confirm('Confirme la operación: Eliminar articulo {$producto['id']}')">Eliminar</button>
                </form>
                </td>
            </tr>
            TXT;
        }
        ?>
    </tbody>
    </table>
    </div>

</html>