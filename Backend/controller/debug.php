<?php
$path = __DIR__ . '/../dao/ServicoDAO.php';

echo "Caminho procurado: <b>$path</b><br>";

echo "Existe? ";
var_dump(file_exists($path));
