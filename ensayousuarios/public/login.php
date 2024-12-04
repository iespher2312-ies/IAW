<?php
require __DIR__ . "/../utilidades/utilidades.php";
require __DIR__ . "/../utilidades/conexion.php";
//Si email está presente en POST, realizaremos...
if (isset($_POST['email'])) {
    //Saneamos los campos
    $email = sanearCampo($_POST['email']);
    $password = sanearCampo($_POST['password']);
    //Comprobamos si los mismos tienen errores
    $errores = false;
    if (validarEmail($email)) {
        $errores = true;
    }
    if (validarCampo(6, 255, $password, "Password")) {
        $errores = true;
    }
    //Comenzaremos a verificar el correspondiente login
    //Realizaremos una consulta, solicitando email y password, donde email sea el introducido
    $q = "select email, password, rol from usuarios where email=?";
    $stmt = mysqli_stmt_init($llave);
    mysqli_stmt_prepare($stmt, $q);
    mysqli_stmt_bind_param($stmt, 's', $email);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $emailD, $passD, $rolD);
    $filas = mysqli_stmt_num_rows($stmt);
    mysqli_stmt_fetch($stmt);
    mysqli_stmt_close($stmt);
    if ($filas = 0) {
        $errores = true;
        $_SESSION['errEmail'] = "Vaya, nos hemos perdido en tu email. Intentalo de nuevo";
    } else {
        if ($email == $emailD) {
            if (password_verify($password, $passD)) {
                $_SESSION['login'] = $email;
                $_SESSION['loginRole'] = $rolD;
            } else {
                $errores = true;
                $_SESSION['errPassword'] = "Vaya, nos hemos perdido en tu password. Intentalo de nuevo";
            }
        } else {
            $errores = true;
            $_SESSION['errEmail'] = "Vaya, nos hemos perdido en tu email. Intentalo de nuevo";
        }
    }
    //Si hay errores, volvemos al login
    if ($errores) {
        header("Location:login.php");
        exit();
    }
    //Entonces, si el login es correcto, nos iremos a usuarios con la sesión iniciada
    if (isset($_SESSION['login']) && isset($_SESSION['loginRole'])) {
        header("Location:usuarios.php");
        exit();
    }
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
    <section class="bg-gray-50 dark:bg-gray-900">
        <div class="flex flex-col items-center justify-center px-6 py-8 mx-auto md:h-screen lg:py-0">
            <a href="usuarios.php" class="flex items-center mb-6 text-2xl font-semibold text-gray-900 dark:text-white">
                <img class="w-8 h-8 mr-2" src="https://flowbite.s3.amazonaws.com/blocks/marketing-ui/logo.svg" alt="logo">
                Panel de usuarios
            </a>
            <div class="w-full bg-white rounded-lg shadow dark:border md:mt-0 sm:max-w-md xl:p-0 dark:bg-gray-800 dark:border-gray-700">
                <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
                    <h1 class="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl dark:text-white">
                        Inicia sesión en tu cuenta
                    </h1>
                    <form class="space-y-4 md:space-y-6" action="login.php" method="POST">
                        <div>
                            <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Your email</label>
                            <input type="email" name="email" id="email" class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="name@company.com" required="">
                            <?= showError("Email") ?>
                        </div>
                        <div>
                            <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Password</label>
                            <input type="password" name="password" id="password" placeholder="••••••••" class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required="">
                            <?= showError("Password") ?>
                        </div>
                        <div class="flex items-center justify-between">
                            <button type="submit" class="w-full text-white bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Inicia sesión</button>
                    </form>
                </div>
            </div>
        </div>
    </section>
</body>

</html>