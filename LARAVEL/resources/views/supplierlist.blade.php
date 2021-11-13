@extends("layout")

@section("content")

<div class="top ">
    <div class="title">
        <h1>Lista de Fornecedores</h1>
    </div>
</div>

<div>
    <form id="add-supplier" action="/supplier/create">
        <div class="form-group form-row">
            <div class="form-column-sup">
                <label for="name">Nome do fornecedor:&nbsp;</label>
                <input type="text" name="name" id="name" required><br>
            </div>
            <div class="form-column-sup">
                <label for="cnpj">CNPJ:&nbsp;</label>
                <input type="text" name="cnpj" id="cnpj" required>
            </div>
        </div>
        <div>
            <input class="btn-supplier" type="submit" value="Cadastrar">
        </div>
    </form>
</div>

<div class="body-info">
    <form action="#">
        <input type="text" name="search" id="search" placeholder="&#x1F50E;Pesquisar por ID, nome ou NCM">
        <div class="empty"></div>
        <span>Organizar por &nbsp;</span>
        <select name="organize" id="organize">
            <option value="cadastro">data de cadastro</option>
            <option value="alfabeto">nome</option>
        </select>
    </form>

    <table class="info-products">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>CNPJ</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach($suppliers as $s)
            <tr>
                <td>{{ $s->id }}</td>
                <td>{{ $s->name }}</td>
                <td>{{ $s->cnpj }}</td>
                <td class="icons">
                    <div onclick="showModalUpdate(this)" class="btn">
                        <span class="material-icons-outlined" id="edit">
                            edit
                        </span>
                        <div style="display: none;">
                            <form class="form-update" action="/supplier/update">
                                <input type="hidden" name="id" value="{{ $s->id }}">
                                <div class="form-row">
                                    <div class="form-column">
                                        <!-- <div class="form-group input-info"> -->
                                        <label for="name">Nome:</label>
                                        <input type="text" name="name" id="name" value="{{ $s->name }}">
                                    </div>
                                    <div class="form-column">
                                        <label for="cnpj">CNPJ:</label>
                                        <input type="text" name="cnpj" id="cnpj" value="{{ $s->cnpj }}">
                                    </div>
                                    <div class="form-column button-modal">
                                        <input class="btn-okay" type="submit" value="Alterar">
                                    </div>
                                    <div class="form-column button-modal">
                                        <input class="btn-cancel" type="button" value="Cancelar" onclick="FlexModal.selfClose(event)">
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <a href="/supplier/delete?id={{$s->id}}">
                        <span class="material-icons-outlined" id="delete">
                            backspace
                        </span>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <div class="exibition">
        <span>Exibindo&nbsp;</span>
        <select name="" id="">
            <option value="">1-10 de 89 </option>
        </select>
    </div>
</div>

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
@endsection