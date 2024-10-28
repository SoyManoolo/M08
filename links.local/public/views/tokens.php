<?php

// La variable $token la creamos en index.php 
$linkController = new LinkController();

$emoji = "";

if ($linkController->exist($token)) {
    $linkController->addUsage($token);
    $usages = $linkController->numberOfUsages($token);

    switch ($usages) {
        case 1: 
            $emoji = "👍";
            break;
        case 2:
            $emoji = "👍";
            break;
        case 3:
            $emoji = "👍";
            break;
        case 4:
            $emoji = "🖕";
            break;
        default:
            $emoji = "⛔";
    }
} else {
    header("Location: http://www.links.local/not-found");
    die();
}

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, 
                                        initial-scale=1.0" />
        <title>Token</title>
        <link href="../assets/twbs/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">

        <style>
            body,
            html {
                height: 100%;
            }
        </style>
    </head>

    <body class="d-flex justify-content-center align-items-center">
        <div class="col-md-12 text-center">
            <h1 class="fs-1"><?php echo $emoji ?></h1>
        </div>
    </body>
</html>