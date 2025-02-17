<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?=APP_NOME?></title>
    <link rel="stylesheet" href="<?=URL?>/Public\css\header.css">
    <link rel="stylesheet" href="<?=URL?>/Public\css\footer.css">
    <link rel="stylesheet" type="text/css" href="<?=URL?>/Public/bootstrap/css/bootstrap.css"/>
    <link rel="shortcut icon" href="<?=URL?>/Public/img/Nappa_favicon.png" type="image/x-icon">
</head>
<body>
    <header>
        <div class="container">
            <nav class="navbar navbar-expand-sm position-fixed-top">
                <a class="navbar-brand" href="<?=URL?>"><img src="<?=URL?>/Public/img/logo.png" alt="Nappa Logo"></a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Menu alinhado à esquerda -->
                    <ul class="nav nav-underline">
                        <li class="nav-item">
                            <a class="nav-link" href="<?=URL?>/paginas/creatina" data-tooltip="tooltip" title="Creatina">Creatina</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?=URL?>/paginas/pretreino" data-tooltip="tooltip" title="Pré-treino">Pré-treino</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?=URL?>/paginas/whey" data-tooltip="tooltip" title="Whey">Whey</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?=URL?>/paginas/barraproteica" data-tooltip="tooltip" title="Sobre nós">Barra Protéica</a>
                        </li>
                    </ul>
                </div>

                <?php if(isset($_SESSION['usuario_id'])): ?>
                    <span class="navbar-text">
                        <p>Olá, <?= $_SESSION['usuario_nome'] ?>, seja bem-vindo(a)!</p>
                        <a class="btn btn-sm btn-danger" href="<?=URL?>/usuarios/sair" data-tooltip="tooltip" title="Sair do sistema">Sair</a>
                    </span>
                    <?php else: ?>

                <!-- Botões alinhados à direita da tela -->
                <div class="position-absolute" style="right: 0;">
                    <a class="btn btn-info mr-3" 
                    href="<?=URL?>/usuarios/cadastrar" data-tooltip="tooltip" title="Não tem uma conta? Cadastre-se">Cadastre-se</a>
                    <a class="btn btn-info" href="<?=URL?>/usuarios/login" data-tooltip="tooltip" title="Tem uma conta? Faça login">Entrar</a>
                </div>
                <?php endif; ?>
            </nav>
        </div>
    </header>