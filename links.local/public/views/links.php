<!DOCTYPE html>
<html lang="en" class="h-100" data-bs-theme="auto">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Página de generación de links únicos">
    <meta name="author" content="Mark Otto, Jacob Thornton, y colaboradores de Bootstrap">
    <meta name="generator" content="Hugo 0.122.0">
    <title>Links</title>
    
    <!-- Bootstrap CSS desde CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- CSS personalizado -->
    <link rel="stylesheet" href="../assets/css/cover.css">
</head>
<body class="d-flex h-100 text-center text-bg-dark">
    <div class="d-flex w-100 h-100 p-3 mx-auto flex-column">
        <header class="mb-auto"> </header>

        <main class="px-3">
            <!-- Formulario para enviar la solicitud -->
            <form method="post">
                <input class="btn btn-lg btn-primary fw-bold" type="submit" value="Generar Link!">
            </form>
            <br>

            <?php
              require_once '/var/www/links.local/src/controller/LinkController.php';
              require_once '/var/www/links.local/vendor/autoload.php';
              require_once '/var/www/links.local/src/controller/DatabaseController.php';

              // Mostrar errores PHP (para desarrollo, quitar en producción)
              ini_set('display_errors', 1);
              ini_set('display_startup_errors', 1);
              error_reporting(E_ALL);

              // Verificar si el formulario fue enviado
              if ($_SERVER["REQUEST_METHOD"] == "POST") {
                  // Generar el link una sola vez y almacenarlo en una variable
                  $link = LinkController::createLink();
                  echo '<h1><a href="http://www.links.local/token/'.$link.'">http://www.links.local/token/'.$link.'</a></h1>';
              }
            ?>
        </main>

        <footer class="mt-auto text-white-50"> </footer>
    </div>
    
    <!-- Bootstrap JavaScript desde CDN -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
