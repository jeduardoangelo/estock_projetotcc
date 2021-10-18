<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listagem de Produtos | estock</title>
    <link rel="stylesheet" href="\plugins\flex-modal\flex-modal.css">
    <script src="\plugins\flex-modal\flex-modal.js"></script>
    <link rel="stylesheet" href=<?php echo asset('css\style_productlist.css') ?>>
</head>

<body>
    <header class="header-bg">
        <div class="head">
            <div>
                <img class="logo" src={{url("images\img-marca.png")}} alt="logo" />
                <!--   <a href="#">estock</a> -->
            </div>
            <nav class="menu-nav">
                <ul>
                    <li><a href="#">Produtos</a></li>
                    <li><a href="#">Fornecedores</a></li>
                    <li><a href="#">Movimentação</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <div class="sub-menu">
        <div class="title">
            <h1>Listagem de Produtos</h1>
        </div>
        <button class="btn-product" onclick="showModalCreate()">Adicionar Produtos</button>
        <button class="btn-ncm" onclick="showModalCreate()">Nota Fiscal</button>
    </div>

    <div style="display: none;">
        <form id="form-create" action="/product/create">
            <div class="form-group input-info">
                <label for="name">Nome do Produto:</label>
                <input type="text" name="name" id="name"><br>
                <label for="ncm">NCM:</label>
                <input type="text" name="ncm" id="ncm"><br>
                <label for="metric">Unidade Métrica:</label>
                <select name="metric">
                    <option value=""></option>
                    <option value="m">Metro</option>
                    <option value="kg">Quilo</option>
                    <option value="lt">Litro</option>
                </select>
            </div>
            <input type="submit" value="Cadastrar">
        </form>

    </div>

    <table class="info-products">
        <thead>
            <tr>
                <th>Nome</th>
                <th>NCM</th>
                <th>Quantidade</th>
                <th>Custo Médio</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach($products as $p)
            <tr>
                <td>{{ $p->name }}</td>
                <td>{{ $p->ncm }}</td>
                <td>{{ $p->amount ?? 0 }} {{ $p->metric }}</td>
                <td>R$ {{ number_format($p->average_cost,2,",",".")}}</td>
                <td>
                    <button>Alterar</button>
                    <a href="/product/delete?id={{$p->id}}">Excluir</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <script>
        function showModalCreate() {
            FlexModal.show({
                title: "Cadastro de Produtos",
                target: "#form-create",
            });
        }
    </script>

</body>

</html>