<?php
session_start();
require_once '../App/configuracao.php';
require_once '../App/autoload.php';
require_once '../App/Libraries/Rota.php';

$db = new Database;

include "../App/Views/header.php";
$rota = new Rota();
include "../App/Views/footer.php";
?>