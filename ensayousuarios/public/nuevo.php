<?php
//1. Llamaremos a los directorios correspondientes.
require __DIR__ . "/../utilidades/conexion.php";
require __DIR__ . "/../utilidades/utilidades.php";
//exit($_POST['email']);
//2. Si el campo email esta presente, limpiaremos los campos.
if (isset($_POST['email'])) {
    $email = sanearCampo($_POST['email']);
    $pass = sanearCampo($_POST['password']);
    //Hasheamos la password
    $password=password_hash($pass,PASSWORD_BCRYPT);
    $name = (string)sanearCampo($_POST['name']);
    $rol = sanearCampo($_POST['rol']);
    //3. Comenzaremos con las validaciones de los campos
    $errores = false;
    //El campo email debe de ser un email valido
    if (validarEmail($email)) {
        $errores = true;
    }
    //El campo password tendrá como minimo 6 caracteres y como maximo 255
    if (validarCampo(6, 255, $password, 'Password')) {
        $errores = true;
    }
    //El campo nombre tendrá como mínimo 2 caracteres y como maximo 50
    if (validarCampo(2, 50, $name, 'Name')) {
        $errores = true;
    }
    //El rol tendrá que ser un rol valido.
    if ($rol == 'NOVALID') {
        $_SESSION['errRol'] = "Vaya, nos hemos perdido en el rol. Revíselo e intentelo de nuevo";
        $errores = true;
    }
    //Comprobaremos por úlitmo si el email ya existe, si es así, error
    $q='select * from usuarios where email LIKE ?';
    $stmt=mysqli_stmt_init($llave);
    mysqli_stmt_prepare($stmt, $q);
    mysqli_stmt_bind_param($stmt, 's', $email);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_store_result($stmt);
    $filas=mysqli_stmt_num_rows($stmt);
    mysqli_stmt_close($stmt);
    if($filas>0){
        $_SESSION['errEmail'] = "Vaya, nos hemos perdido al crearte. Revíselo e intentelo de nuevo";
        $errores = true;
    }
    //Ahora, si hay algún error, no procesaremos el nuevo usuario
    if ($errores) {
        header('Location:nuevo.php');
        die();
    }
    //Si estamos aquí, procesaremos el insertado
    $q = "insert into usuarios(email, password, nombre, rol) values (?,?,?,?)";
    $stmt = mysqli_stmt_init($llave);
    mysqli_stmt_prepare($stmt, $q);
    mysqli_stmt_bind_param($stmt, 'ssss', $email, $password, $name, $rol);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    mysqli_close($llave);
    //Si se crea exitosamente, volveremos a usuarios.php
    header('Location:usuarios.php');
    exit();
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

<body class="bg-gray-50 dark:bg-gray-900">

    <div class='py-4 px-4'>
        <h2 class="text-4xl font-bold dark:text-white py-4 px-4 text-center">Nuevo usuario...</h2>
        <form class="max-w-sm mx-auto" method='post' action='nuevo.php'>
            <div class="mb-5">
                <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Correo electronico</label>
                <input name='email' type="email" id="email" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="name@flowbite.com" />
                <?php
                showError('Email');
                ?>
            </div>
            <div class="mb-5">
                <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Contraseña</label>
                <input name='password' type="password" id="password" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" />
                <?php
                showError('Password');
                ?>
            </div>
            <div class="mb-5">
                <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nombre</label>
                <input name='name' type="name" id="name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Felipe" />
                <?php
                showError('Name');
                ?>
            </div>

            <label for="rol" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Seleciona un rol</label>
            <select id="rol" name='rol' class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                <option value='NOVALID' selected>Selecicone su rol...</option>
                <option value="Admin">Admin</option>
                <option value="Editor">Editor</option>
                <option value="Usuario">Usuario</option>
            </select>
            <?php
            showError('Rol');
            ?>
            <br />
            <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Submit</button>
            <a href="usuarios.php" class="focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900">Volver</a>
        </form>

</body>

</html>