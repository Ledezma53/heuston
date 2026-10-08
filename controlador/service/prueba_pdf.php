<?php

require_once "../../vendor/autoload.php";

use Dompdf\Dompdf;

$dompdf = new Dompdf();

$html = '
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">

    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 40px;
        }

        h1 {
            text-align: center;
        }

        .mensaje {
            text-align: center;
            margin-top: 30px;
            font-size: 18px;
        }
    </style>
</head>

<body>

    <h1>PRUEBA DE PDF</h1>

    <div class="mensaje">
        Dompdf está funcionando correctamente.
    </div>

</body>
</html>
';

$dompdf->loadHtml($html);

$dompdf->setPaper('A4', 'portrait');

$dompdf->render();

$dompdf->stream("prueba.pdf", [
    "Attachment" => false
]);

?>