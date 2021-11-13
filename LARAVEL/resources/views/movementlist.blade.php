@extends("layout")

@section("content")

<div class="top ">
    <div class="title">
        <h1>Lista de Movimentações</h1>
    </div>
</div>

<div class="form-row-inout">
    <div class="form-column-mov">
        <h2>Entrada de produtos</h2>
        <button class="btn-inout" onclick="showModalCreate()">Adicionar entrada de produtos</button>
    </div>
    <div class="form-column-mov">
        <h2>Saída de produtos</h2>
        <button class="btn-inout" onclick="showModalCreate()">Adicionar saída de produtos</button>
    </div>
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
                <th>NCM</th>
                <th>Quantidade</th>
                <th>Custo Médio</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach($movements as $p)
            <tr>
                <td>{{ $p->id }}</td>
                <td>{{ $p->name }}</td>
                <td>{{ $p->ncm }}</td>
                <td>{{ $p->amount ?? 0 }} {{ $p->metric }}</td>
                <td>R$ {{ number_format($p->average_cost,2,",",".")}}</td>
                <td class="icons">
                    <div onclick="showModalUpdate(this)" class="btn">
                        <span class="material-icons-outlined" id="edit">
                            edit
                        </span>
                        <div style="display: none;">
                            <form class="form-update" action="/product/update">
                                <input type="hidden" name="id" value="{{ $p->id }}">
                                <div class="form-row">
                                    <div class="form-column">
                                        <label for="name">Nome do Produto:</label>
                                        <input type="text" name="name" id="name" required value="{{ $p->name }}">
                                    </div>
                                    <div class="form-column">
                                        <label for="ncm">NCM:</label>
                                        <input type="text" name="ncm" id="ncm" required value="{{ $p->ncm }}">
                                    </div>
                                    <div class="form-column">
                                        <label for="metric">Unidade Métrica:</label>
                                        <select name="metric" required data-value="{{ $p->metric }}">
                                            <option value=""></option>
                                            <option value="m">Metro</option>
                                            <option value="kg">Quilo</option>
                                            <option value="lt">Litro</option>
                                            <option value="un">Unidade</option>
                                        </select>
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
                    <a href="/product/delete?id={{$p->id}}">
                        <span class="material-icons-outlined" id="delete">
                            backspace
                        </span>
                    </a>
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

@endsection