<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="\plugins\flex-modal\flex-modal.css">
    <script src="\plugins\flex-modal\flex-modal.js"></script>
    <script src="\script.js"></script>
</head>

<body>
    <h1>Listagem de Fornecedores</h1>

    <div>
        <button onclick="showModalCreate()">Adicionar Fornecedor</button>
    </div>

    <div style="display: none">
        <form id="form-create" action="/supplier/create">
            <div class="form-group input-info">
                <label for="name">Nome:</label>
                <input type="text" name="name" id="name"><br>
                <label for="cnpj">CNPJ:</label>
                <input type="text" name="cnpj" id="cnpj">
            </div>
            <input type="submit" value="Cadastrar">
        </form>
    </div>

    <table>
        <thead>
            <tr>
                <th>Nome</th>
                <th>CNPJ</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach($suppliers as $s)
            <tr>
                <td>{{ $s->name }}</td>
                <td>{{ $s->cnpj }}</td>
                <td>
                <div onclick="showModalUpdate(this)" class="btn">Alterar
                        <div style="display: none;">
                            <form class="form-update" action="/supplier/update">
                                <input type="hidden" name="id" value="{{ $s->id }}">
                                <div class="form-group input-info">
                                    <label for="name">Nome:</label>
                                    <input type="text" name="name" id="name" value="{{ $s->name }}"><br>
                                    <label for="cnpj">CNPJ:</label>
                                    <input type="text" name="cnpj" id="cnpj" value="{{ $s->cnpj }}">
                                </div>
                                <input type="submit" value="Alterar">
                            </form>
                        </div>
                    </div>
                    <a href="/supplier/delete?id={{$s->id}}">Excluir</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <script>
        function showModalCreate() {
            FlexModal.show({
                title: "Cadastro de Fonecedores",
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