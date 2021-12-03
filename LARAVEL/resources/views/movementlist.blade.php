@extends("layout")

@section("content")

<div class="top ">
    <div class="title">
        <h1>Controle de Estoque</h1>
    </div>
</div>

<div style="display: none;">
    <form id="out-create" action="/movement/create">
        <div class="form-column-mov">

            <input type="hidden" name="type" value="2">

            <div class="form-column-mov">
                <label for="id_product">Selecione o Produto:</label>
                <select name="id_product" id="id_product" onchange="getProductData(this)">
                    <option value=""></option>
                    @foreach($products as $p)
                    <option value="{{ $p->id }}">
                        {{ $p->name }}
                    </option>
                    @endforeach
                </select>
            </div>
            <div class="form-row-mov">
                <div class="form-column-mov">
                    <h3>Produtos Restantes: {{ @$productData -> amount }} </h3>
                </div>
            </div>
            <div class="form-row-mov">
                <div class="form-column-mov">
                    <label for="amount">Quantidade:</label>
                    <input type="number" name="amount" id="amount_out" required oninput="priceCalc()">
                </div>
                <div class="form-column-mov">
                    <label for="date">Data da Movimentação:</label>
                    <input type="date" name="date" value="{{ date('Y-m-d') }}" required>
                </div>

            </div>
            <div class="form-row-mov">
                <div class="form-column-mov">
                    <label for="value">Custo Médio:</label>
                    <input type="number" name="value" id="value" required readonly value="{{ @$productData -> average_cost }}">
                </div>
                <div class="form-column-mov">
                    <label for="profit">Porcentagem de Lucro:</label>
                    <input type="number" id="profit" required oninput="priceCalc()">
                </div>
            </div>
            <div class="form-row-mov">
                <div class="form-column-mov">
                    <h3>Valor de Venda: R$ <span id="price">0,00</span></h3>
                </div>
            </div>
            <div class="form-row-mov">
                <div class="form-column-mov button-modal">
                    <input class="btn-okay" type="submit" value="Cadastrar">
                </div>
                <div class="form-column-mov button-modal">
                    <input class="btn-cancel" type="button" value="Cancelar" onclick="FlexModal.selfClose(event)">
                </div>
            </div>
        </div>
    </form>



    <form id="in-create" action="/movement/create">
        <div class="form-column-mov">

            <input type="hidden" name="type" value="1">

            <div class="form-column-mov">
                <label for="id_product">Selecione o Produto:</label>
                <select name="id_product" id="">
                    <option value=""></option>
                    @foreach($products as $p)
                    <option value="{{ $p->id }}">
                        {{ $p->name }}
                    </option>
                    @endforeach
                </select>
            </div>
            <div class="form-row-mov">
                <div class="form-column-mov">
                    <label for="date">Data da Movimentação:</label>
                    <input type="date" name="date" value="{{ date('Y-m-d') }}" required>
                </div>
                <div class="form-column-mov">
                    <label for="id_supplier">Selecione o Fornecedor:</label>
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
            <div class="form-row-mov">
                <div class="form-column-mov">
                    <label for="amount">Quantidade:</label>
                    <input type="number" name="amount" id="amount" required>
                </div>
                <div class="form-column-mov">
                    <label for="value">Valor da Compra:</label>
                    <input type="number" name="value" id="value" required>
                </div>
            </div>
            <div class="form-row-mov">
                <div class="form-column-mov button-modal">
                    <input class="btn-okay" type="submit" value="Cadastrar">
                </div>
                <div class="form-column-mov button-modal">
                    <input class="btn-cancel" type="button" value="Cancelar" onclick="FlexModal.selfClose(event)">
                </div>
            </div>
        </div>
    </form>
</div>

<div class="modal-row-mov">
    <div class="modal-column-mov">
        <h2>Entrada de Produtos</h2>
        <button class="btn-mov" onclick="showModalCreateIn()">Adicionar entrada de produtos</button>
    </div>
    <div class="modal-column-mov">
        <h2>Saída de Produtos</h2>
        <button class="btn-mov" onclick="showModalCreateOut()">Adicionar saída de produtos</button>
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
    function showModalCreateIn() {
        FlexModal.show({
            title: "Entrada de Produtos",
            target: "#in-create",
        });
    }

    function showModalCreateOut() {
        FlexModal.show({
            title: "Saída de Produtos",
            target: "#out-create",
        });
    }
    
    function getProductData(select) {
        var value = select.options[select.selectedIndex].value;
        location.href = "?id_product="+ value;
    }
<?php if (@$productData){?>
    window.onload = function() {
        let params = (new URL(document.location)).searchParams;
        let id_product = params.get("id_product");
        if (id_product) {
            document.querySelector("#id_product").value = <?php echo @$productData -> id ?>;
            showModalCreateOut();
        }
    }
    function priceCalc() {
        var profit_value = document.querySelector("#profit").value;
        var finalPrice = <?php echo @$productData -> average_cost ?> * ((profit_value / 100) + 1);
        finalPrice = finalPrice * document.querySelector("#amount_out").value;
            console.log(finalPrice);
        finalPrice = new Intl.NumberFormat('pt-BR', { maximumFractionDigits: 2, minimumFractionDigits: 2 } ).format(finalPrice)
            document.querySelector("#price").innerHTML = finalPrice;
    }
<?php } ?>
</script>

@endsection