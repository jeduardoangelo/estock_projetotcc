<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listagem de Produtos | estock</title>
    <link rel="stylesheet" href="\plugins\flex-modal\flex-modal.css">
    <script src="\plugins\flex-modal\flex-modal.js"></script>
    <script src="\script.js"></script>
    <link rel="stylesheet" href=<?php echo asset('css\style_productlist.css') ?>>
</head>

<body>
    <header class="header">
        <div class="logo">
            <img src="\images\img-marca.png" alt="logo">
        </div>

        <nav class="menu">
            <a href="#">Dashboard</a>
            <a href="#">Cadastro de Produtos</a>
            <a href="#">Controle de Estoque</a>
            <a href="#">Cadastro de Fornecedor</a>
            <a href="#">Configurações</a>
        </nav>
        <div class="empty"></div>
        <div class="user">
            <img src="\images\pic-profile.jpg" alt="pic-profile">
            <span>
                Eduardo
            </span>
        </div>

    </header>

    <div class="all">

        <div class="top ">
            <div class="title">
                <h1>Cadastro de Produtos</h1>
            </div>
            <div class="btn-top">
            <button class="btn-product" onclick="showModalCreate()">Adicionar Produtos</button>
            <button class="btn-ncm" onclick="showModalCreate()">Nota Fiscal</button>
            </div>
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
                        <option value="un">Unidade</option>
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
                        <div onclick="showModalUpdate(this)" class="btn">Alterar
                            <div style="display: none;">
                                <form class="form-update" action="/product/update">
                                    <input type="hidden" name="id" value="{{ $p->id }}">
                                    <div class="form-group input-info">
                                        <label for="name">Nome do Produto:</label>
                                        <input type="text" name="name" id="name" value="{{ $p->name }}"><br>
                                        <label for="ncm">NCM:</label>
                                        <input type="text" name="ncm" id="ncm" value="{{ $p->ncm }}"><br>
                                        <label for="metric">Unidade Métrica:</label>
                                        <select name="metric" data-value="{{ $p->metric }}">
                                            <option value=""></option>
                                            <option value="m">Metro</option>
                                            <option value="kg">Quilo</option>
                                            <option value="lt">Litro</option>
                                        </select>
                                    </div>
                                    <input type="submit" value="Alterar">
                                </form>
                            </div>
                        </div>
                        <a href="/product/delete?id={{$p->id}}">Excluir</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

    </div>

    <script>
        function showModalCreate() {
            FlexModal.show({
                title: "Cadastro de Produtos",
                target: "#form-create",
            });
        }

        function showModalUpdate(btn) {
            FlexModal.show({
                title: "Alteração",
                target: btn.querySelector(".form-update"),
            });
        }
    </script>


</body>

</html>