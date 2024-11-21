<?php
//La sesión esta inicializada en utilidades, no es necesario iniciarla de nuevo
require __DIR__ . '/../utilidades/utilidades.php'; //Requerimos utilidades
require __DIR__ . '/../utilidades/conexion.php'; //Requerimos conexion
//1: Recoger los campos
if (isset($_POST['nombre'])) {
    $nombre = sanearCampos($_POST['nombre']);
    $descripcion = sanearCampos($_POST['descripcion']);
    $tipo = sanearCampos($_POST['tipo']);
    //2a. Comprobamos que en tipo, no hayan dejado puesto el valor "Seleccione un tipo...
    $errores = false;
    if ($tipo == 'NoValido') {
        $errores = true;
        $_SESSION['errortipo'] = '**Seleccione un tipo de producto valido';
    }
    //2b. Comprobamos que el nombre tenga entre 5 y 60 carácteres y que en la base de datos no exista otro producto con el mismo nombre
    if (!comprobarTexto(5, 60, $nombre, 'nombre')) {
        $errores = true;
    } else {
        if (existeProducto($nombre, $llave)) {
            $errores = true;
        }
    }
    //2c. Comprobamos que la descripción tenga entre 5 y 255 caracteres
    if (!comprobarTexto(5, 255, $descripcion, 'descripcion')) {
        $errores = true;
    }
    //3. Si hay errores, volvemos a nuevo.
    if ($errores) {
        header("Location:nuevo.php");
        exit();
    }
    //4a. Si no hay errores, inicializamos una consulta MySQL que inserte los valores.
    $q = 'insert into productos(nombre, descripcion, tipo) values (?,?,?)';
    $stmt = mysqli_stmt_init($llave); //Inicializamos una sesión de MySQL
    mysqli_stmt_prepare($stmt, $q);
    mysqli_stmt_bind_param($stmt, 'sss', $nombre, $descripcion, $tipo);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    mysqli_close($llave);
    //4b. Si estamos aquí, la insercción se habrá realizado correctamente, nos redirigimos a productos
    header('Location:productos.php');
}
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

<body>
    <section class="bg-white dark:bg-gray-900">
        <div class="py-8 px-4 mx-auto max-w-2xl lg:py-16">
            <h2 class="mb-4 text-xl font-bold text-gray-900 dark:text-white">Crear un nuevo producto</h2>
            <form action="nuevo.php" method='POST'>
                <div class="grid gap-4 sm:grid-cols-2 sm:gap-6">
                    <div class="sm:col-span-2">
                        <label for="nombre" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nombre del producto</label>
                        <input type="text" name="nombre" id="nombre" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Escriba un nombre para el producto...">
                        <?php
                        showError('nombre');
                        ?>
                    </div>
                    <div class="w-full">
                        <label for="descripcion" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Descripción</label>
                        <input type="text" name="descripcion" id="descripcion" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Escriba una descripción para el producto...">
                        <?php
                        showError('descripcion');
                        ?>
                    </div>
                    <div>
                        <label for="tipo" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Tipo</label>
                        <select id="tipo" name="tipo" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                            <option value="NoValido">Selecciona un tipo de producto...</option>
                            <option value="Bazar">Bazar</option>
                            <option value="Alimentación">Alimentación</option>
                            <option value="Limpieza">Limpieza</option>
                        </select>
                        <?php
                        showError('tipo');
                        ?>
                    </div>
                </div>
                <br />
                <button type="submit" class="font-small text-blue-600 dark:text-blue-500 hover:underline">
                    Crear producto!
                </button> 
                &nbsp;&nbsp;
                <a href="productos.php" class="font-small text-red-600 dark:text-red-500 hover:underline">
                    Volver a productos...
                </a>
            </form>
            <br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br />
        </div>
    </section>
</body>

</html>