<?php
//La sesión esta inicializada en utilidades, no es necesario iniciarla de nuevo
require __DIR__ . '/../utilidades/utilidades.php'; //Requerimos utilidades
require __DIR__ . '/../utilidades/conexion.php'; //Requerimos conexion
//1a: Obtenemos el id, y si no lo tenemos, de vuelta a productos.
if (!isset($_GET['id'])) {
    header('Location:productos.php');
    exit;
}
$id = (int) $_GET['id'];
if ($id <= 0) {
    header('Location:productos.php');
    exit;
}
//1b: Obtenemos los datos actuales mediante una consulta
$q = 'select nombre, descripcion, tipo from productos where id = ?'; //Declaramos la consulta
$stmt = mysqli_stmt_init($llave); //Iniciamos sesión
mysqli_stmt_prepare($stmt, $q); //Preparamos la consulta 
mysqli_stmt_bind_param($stmt, 'i', $id); //Desparametrizamos la entrada
mysqli_stmt_execute($stmt); //Ejecutamos la consulta
mysqli_stmt_bind_result($stmt, $nombreDev, $descripcionDev, $tipoDev); //Desparametrizamos la salida
mysqli_stmt_fetch($stmt); //Guardamos la desparametrización de la salida
mysqli_stmt_close($stmt); //Cerramos la conexión
//1c: Si la consulta no obtiene nada volvemos a producros
if (empty($nombreDev)) {
    mysqli_close($llave); //Cerramos la conexión
    header("Location:productos.php"); //Redirigimos a la página principal
    die(); //Finalizamos la ejecución
}
//2: Recoger los campos a modificar
if (isset($_POST['nombre'])) {
    $nombre = (string)sanearCampos($_POST['nombre']);
    $descripcion = (string)sanearCampos($_POST['descripcion']);
    $tipo = (string)sanearCampos($_POST['tipo']);
    //3a. Comprobamos que en tipo, no hayan dejado puesto el valor "Seleccione un tipo...
    $errores = false;
    if ($tipo == 'NoValido') {
        $errores = true;
        $_SESSION['errortipo'] = '**Seleccione un tipo de producto valido';
    }
    //3b. Comprobamos que el nombre tenga entre 5 y 60 carácteres
    if (!comprobarTexto(5, 60, $nombre, 'nombre')) {
        $errores = true;
    }
    //3c. Comprobamos que la descripción tenga entre 5 y 255 caracteres
    if (!comprobarTexto(5, 255, $descripcion, 'descripcion')) {
        $errores = true;
    }
    //4. Si hay errores, volvemos a update.
    if ($errores) {
        header("Location:update.php?id=$id");
        exit();
    }
    //5a. Si no hay errores, inicializamos una consulta MySQL que actualice los valores.
    $q = 'update productos set nombre=?, descripcion=?, tipo=? where id=?';
    $stmt = mysqli_stmt_init($llave); //Inicializamos una sesión de MySQL
    mysqli_stmt_prepare($stmt, $q);
    mysqli_stmt_bind_param($stmt, 'sssi', $nombre, $descripcion, $tipo, $id);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    mysqli_close($llave);
    //5b. Si estamos aquí, la actualización se habrá realizado correctamente, nos redirigimos a productos
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
            <h2 class="mb-4 text-xl font-bold text-gray-900 dark:text-white">Editar un producto</h2>
            <form action='update.php?id=<?= $id ?>' method="POST">
                <div class="grid gap-4 sm:grid-cols-2 sm:gap-6">
                    <div class="sm:col-span-2">
                        <label for="nombre" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nombre del producto</label>
                        <input type="text" name="nombre" id="nombre" value='<?= $nombreDev ?>' class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Escriba un nombre para el producto...">
                        <?php
                        showError('nombre');
                        ?>
                    </div>
                    <div class="w-full">
                        <label for="descripcion" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Descripción</label>
                        <input type="text" name="descripcion" id="descripcion" value='<?= $descripcionDev ?>' class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Escriba una descripción para el producto...">
                        <?php
                        showError('descripcion');
                        ?>
                    </div>
                    <div>
                        <label for="tipo" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Tipo</label>
                        <select id="tipo" name="tipo" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                            <?php
                            if ($tipoDev == 'Bazar') {
                                echo <<< TXT
                                <option value="NoValido">Selecciona un tipo de producto...</option>
                                <option value="Bazar" selected>Bazar</option>
                                <option value="Alimentación">Alimentación</option>
                                <option value="Limpieza">Limpieza</option>
                                TXT;
                            } elseif ($tipoDev == 'Alimentación') {
                                echo <<< TXT
                                <option value="NoValido">Selecciona un tipo de producto...</option>
                                <option value="Bazar">Bazar</option>
                                <option value="Alimentación" selected>Alimentación</option>
                                <option value="Limpieza">Limpieza</option>
                                TXT;
                            } elseif ($tipoDev == 'Limpieza') {
                                echo <<< TXT
                                <option value="NoValido">Selecciona un tipo de producto...</option>
                                <option value="Bazar">Bazar</option>
                                <option value="Alimentación">Alimentación</option>
                                <option value="Limpieza" selected>Limpieza</option>
                                TXT;
                            } else {
                                header('Location=:productos.php');
                                exit();
                            }
                            ?>
                        </select>
                        <?php
                        showError('tipo');
                        ?>
                    </div>
                </div>
                <br />
                <button type="submit" class="font-small text-blue-600 dark:text-blue-500 hover:underline">
                    Editar producto!
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