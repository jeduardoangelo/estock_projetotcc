<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>estock</title>
    <link rel="stylesheet" href="\plugins\flex-modal\flex-modal.css">
    <script src="\plugins\flex-modal\flex-modal.js"></script>
    <script src="\script.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Material+Icons+Outlined" rel="stylesheet">
    <link rel="stylesheet" href=<?php echo asset('css\style.css') ?>>
</head>

<body>
    <header class="header">
        <div class="logo">
            <img src="\images\img-marca.png" alt="logo">
        </div>

        <nav class="menu">
            <a href="#">Dashboard</a>
            <a href="/product/">Cadastro de Produtos</a>
            <a href="/movement/">Controle de Estoque</a>
            <a href="/supplier/">Cadastro de Fornecedor</a>
        </nav>
        <div class="empty"></div>
        <nav class="menu">
            <a href="#">Configurações</a>
            <a href="#">Ajuda</a>
        </nav>
        <div class="user">
            <img src="\images\pic-profile.jpg" alt="pic-profile">
            <span>
                Eduardo
            </span>
        </div>

    </header>

    <div class="all">
        @yield("content")
    </div>

</body>

</html>