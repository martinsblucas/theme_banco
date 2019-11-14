<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Banco de Obras</title>
    <?php wp_head(); ?>
</head>
<body>
<header id="header" class="container-fluid sticky-top">
    <div class="container">
        <nav class="navbar navbar-expand-lg navbar-banco">
            <div class="navbar navbar-header">
                <div class="navbar-brand">
                    <a href="index.html">
                        <h1>Banco de Obras</h1>
                        <h2>Semana de Cinema</h2>
                    </a>
                </div>
                <button class="navbar-toggler collapsed" data-toggle="collapse" data-target="#Menu">
                    <span class="navbar-toggler-icon d-flex align-items-center justify-content-center">
                        <span></span>
                    </span>
                </button>
            </div>
            <div class="navbar-body">
                <div class="collapse navbar-collapse menu" id="Menu">
                    <div class="menu-primary" id="MenuPrimary">
                        <ul class="navbar-nav">
                            <li class="nav-item">
                                <a href="" class="nav-link inicio d-block d-md-none">Início</a>
                            </li>
                            <li class="nav-item">
                                <a href="" class="nav-link envie-seu-filme">Envie seu filme</a>
                            </li>
                            <li class="nav-item">
                                <a href="" class="nav-link seja-um-exibidor">Seja um exibidor</a>
                            </li>
                            <li class="nav-item">
                                <a href="" class="nav-link exibidores-parceiros">Exibidores parceiros</a>
                            </li>
                            <li class="nav-item">
                                <a href="" class="nav-link contato">Contato</a>
                            </li>
                            <li class="nav-item dropdown">
                                <a href="" class="nav-link dropdown-toggle ed-anteriores"
                                   data-toggle="dropdown">Semana</a>
                                <div class="dropdown-menu">
                                    <a href="" class="dropdown-item">2018</a>
                                    <a href="" class="dropdown-item ">2017</a>
                                    <a href="" class="dropdown-item disabled">...</a>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <div class="d-flex menu-administrador" id="MenuAdministrador">
                        <ul class="navbar-nav">
                            <li class="nav-item">
                                <a href="" class="nav-link filmes">Filmes</a>
                            </li>
                            <li class="nav-item">
                                <a href="" class="nav-link admin">Administrar</a>
                            </li>
                            <li class="nav-item">
                                <a href="" class="nav-link perfil">Perfil</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </nav>
    </div>
</header>