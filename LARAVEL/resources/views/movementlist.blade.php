@extends("layout")

@section("content")

<div class="top ">
    <div class="title">
        <h1>Controle de Estoque</h1>
    </div>
</div>

<div style="display: none;">
    <form id="form-create" action="/movement/create">
        <div class="">

            <!-- <select name="type">
                <option value=""></option>
                <option value="1">Entrada</option>
                <option value="0">Saída</option>
            </select> -->
            <input type="hidden" name="type" value="1">

            <div class="">
                <label for="id_product">Selecione o produto:</label>
                <select name="id_product" id="">
                    <option value=""></option>
                    @foreach($products as $p)
                    <option value="{{ $p->id }}">
                        {{ $p->name }}
                    </option>
                    @endforeach
                </select>
            </div>
            <div class="">
                <div class="">
                    <label for="date">Data da movimentação</label>
                    <input type="date" name="date" required>
                </div>
                <div class="">
                    <label for="id_supplier">Selecione o fornecedor:</label>
                    <select name="id_supplier" id="">
                        <option value=""></option>
                        @foreach($suppliers as $s)
                        <option value="{{ $s->id }}">
                            {{ $s->name }}
                        </option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="">
                <div class="">
                    <label for="amount">Quantidade:</label>
                    <input type="number" name="amount" id="amount" required>
                </div>
                <div class="">
                    <label for="value">Valor da compra:</label>
                    <input type="number" name="value" id="value" required>
                </div>
            </div>
            <div class="">
                <div class="button-modal">
                    <input class="btn-okay" type="submit" value="Cadastrar">
                </div>
                <div class="button-modal">
                    <input class="btn-cancel" type="button" value="Cancelar" onclick="FlexModal.selfClose(event)">
                </div>
            </div>
        </div>
    </form>
</div>

<div class="form-row-mov">
    <div class="form-column-mov">
        <h2>Entrada de produtos</h2>
        <button class="btn-mov" onclick="showModalCreate()">Adicionar entrada de produtos</button>
    </div>
    <div class="form-column-mov">
        <h2>Saída de produtos</h2>
        <button class="btn-mov" onclick="showModalCreate()">Adicionar saída de produtos</button>
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
                <th>Tipo Movimentação</th>
                <th>Nome do Produto</th>
                <th>Data da Movimentação</th>
                <th>Fornecedor</th>
                <th>Quantidade</th>
                <th>Valor</th>
            </tr>
        </thead>
        <tbody>
            @foreach($movements as $m)
            <tr>
                <td>{{ $m->type == 1? "Entrada" : "Saída" }}</td>
                <td>{{ $m->name_p }}</td>
                <td>{{ date_format(date_create($m->date), "d/m/Y") }}</td>
                <td>{{ $m->name_s }}</td>
                <td>{{ $m->amount }}</td>
                <td>R${{ number_format($m->value, 2, ",", ".") }}</td>
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
            title: "Entrada de Produtos",
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