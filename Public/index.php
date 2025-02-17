<?php
session_start();
include "./../App/configuracao.php";
include "./../App/autoload.php";

$db = new Database;
/*
//EXIBE VÁRIOS RESULTADOS
$db->query("SELECT * FROM posts");
foreach($db->resultados() as $post){
    echo $post->titulo. ' | '.$post->texto.'<br>';
}

//EXIBE APENAS UM RESULTADO
$db->query("SELECT * FROM posts ORDER BY id DESC");
$db->resultado();
echo $db->resultado()->titulo;
*/
/*
//deletando linha do banco
$id = 1;
$db->query("DELETE FROM posts WHERE id = :id");
$db->bind(":id",$id);
$db->executa();
echo '<hr>Total atualizado: '.$db->totalResultados();

*/
/*
//atualizando banco
date_default_timezone_set('America/Cuiaba');
$id = 3;
$usuarioId = 8;
$titulo = "Algoritmos";
$texto = "Algoritmos é muito legal";
$criadoEm = date('Y-m-d H:i:s');

$db->query("UPDATE posts SET usuario_id = :usuario_id, titulo = :titulo, texto = :texto, criado_em=:criadoEm WHERE id = :id");

$db->bind(":id",$id);
$db->bind(":usuario_id",$usuarioId);
$db->bind(":titulo",$titulo);
$db->bind(":texto",$texto);
$db->bind(":criadoEm",$criadoEm);

$db->executa();
echo '<hr>Total Resultados: '.$db->totalResultados();
*/

/*
//inserindo dados no banco
$usuario_id = 8;
$titulo = 'Programação';
$texto = 'Programação web';

$db->query("INSERT INTO posts (usuario_id, titulo, texto) VALUES (:usuario_id, :titulo, :texto)");
$db->bind(":usuario_id",$usuario_id);
$db->bind(":titulo",$titulo);
$db->bind(":texto",$texto);

$db->executa();

echo '<hr>Total Resultados: '.$db->totalResultados();
echo '<hr>Ultimo ID inserido'.$db->ultimoIdInserido();
*/

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?=APP_NOME?></title>
    <link rel="stylesheet" type="text/css" href="<?=URL?>/public/css/estilo.css"/>
    <link rel="stylesheet" type="text/css" href="<?=URL?>/public/bootstrap/css/bootstrap.css"/>
    <link rel="shortcut icon" href="Public\img\Nappa_favicon.png" type="image/x-icon">
</head>
<body>
    <?php
    include "../App/Views/header.php";
    $rotas = new Rota();
   // $rotas->url();
    include "../App/Views/footer.php";
    ?>
    <script src="<?=URL?>/public/bootstrap/js/bootstrap.js"></script>
    <script src="<?=URL?>/public/js/query.js"></script>
</body>
</html>