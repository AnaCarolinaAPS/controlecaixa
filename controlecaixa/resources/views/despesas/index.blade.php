
@extends('layouts.admin_master')
@section('titulo', 'Despesas | PowerTrade.Py')

@section('admin')
<div class="page-content">
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">Despesas</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Admin</a></li>
                            <li class="breadcrumb-item active">Despesas</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <!-- end page title -->
        <div class="row">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title mb-4">Despesas</h4>
                        <button type="button" class="btn btn-success waves-effect waves-light mb-2" data-bs-toggle="modal" data-bs-target=".bs-example-modal-lg">
                            <i class="fas fa-plus"></i> Nova
                        </button>
                        <div class="table-responsive">
                            <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead class="table-light">
                                    <tr>
                                        <th>Data</th>
                                        <th>Categoria</th>
                                        <th>Subcategoria</th>
                                        <th>Descrição</th>
                                        <th>Valor</th>
                                    </tr>
                                </thead><!-- end thead -->
                                <tbody>
                                    @foreach ($all_despesas as $despesa)
                                    <tr class="abrirModal" data-pacote-id="{{ $despesa->id; }}" data-bs-toggle="modal" data-bs-target="#detalhesPacoteModal">
                                        <td>{{ \Carbon\Carbon::parse($despesa->data)->format('d/m/Y') }}</td>
                                        <td>{{ $despesa->categoria->nome }}</td>
                                        <td>{{ $despesa->subcategoria->nome }}</td>
                                        <td>{{ $despesa->descricao }}</td>
                                        <td>{{ $despesa->valor }}</td>
                                    </tr>
                                    @endforeach
                                     <!-- end -->
                                </tbody><!-- end tbody -->
                            </table> <!-- end table -->
                        </div>
                    </div><!-- end card -->
                </div><!-- end card -->
            </div>
            <!-- end col -->
        </div>
        <!-- end row -->

        <div class="row">
            <div class="col-xl-6">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title mb-4">Total das Despesas</h4>
                        <div class="table-responsive">
                            <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead class="table-light">
                                    <tr>
                                        <th>Categoria</th>
                                        <th>Subcategoria</th>
                                        <th>Valor Total</th>
                                    </tr>
                                </thead><!-- end thead -->
                                <tbody>
                                    @foreach ($resultados as $resultado)
                                    <tr>
                                        <td>{{ $resultado->categoria->nome }}</td>
                                        <td>{{ $resultado->subcategoria->nome }}</td>
                                        <td>{{ $resultado->total }}</td>
                                    </tr>
                                    @endforeach
                                     <!-- end -->
                                </tbody><!-- end tbody -->
                            </table> <!-- end table -->
                        </div>
                    </div><!-- end card -->
                </div><!-- end card -->
            </div>
            <!-- end col -->

            <div class="col-xl-6">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title mb-4">Total das Despesas (Categoria)</h4>
                        <div class="table-responsive">
                            <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead class="table-light">
                                    <tr>
                                        <th>Categoria</th>
                                        <th>Valor Total</th>
                                    </tr>
                                </thead><!-- end thead -->
                                <tbody>
                                    @foreach ($resultados2 as $resultado)
                                    <tr>
                                        <td>{{ $resultado->categoria->nome }}</td>
                                        <td>{{ $resultado->total }}</td>
                                    </tr>
                                    @endforeach
                                     <!-- end -->
                                </tbody><!-- end tbody -->
                            </table> <!-- end table -->
                        </div>
                    </div><!-- end card -->
                </div><!-- end card -->
            </div>
            <!-- end col -->
        </div>
        
    </div>
    <div class="modal fade bs-example-modal-lg" tabindex="-1" aria-labelledby="ModalShipper" aria-hidden="true" style="display: none;">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="myLargeModalLabel">Nova Despesa</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form class="form-horizontal mt-3" method="POST" action="{{ route('despesas.store') }}">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="data">Data</label>
                                    <input class="form-control" type="date" value="{{ \Carbon\Carbon::today()->format('Y-m-d') ; }}" id="data" name="data">
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label for="valor">Valor</label>
                                    <input class="form-control" type="number" value="0.00" step="0.10" id="valor" name="valor">
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label for="categoria_id">Categoria</label>
                                    <select class="selectpicker form-control" data-live-search="true" id="categoria_id" name="categoria_id" required>
                                        @foreach ($all_categorias as $categoria)
                                            <option value="{{ $categoria->id }}"> {{ $categoria->nome; }} </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label for="subcategoria_id">SubCategoria</label>
                                    <select class="selectpicker form-control" data-live-search="true" id="subcategoria_id" name="subcategoria_id" required>
                                        @foreach ($all_subcategorias as $subcategoria)
                                            <option value="{{ $subcategoria->id }}"> {{ $subcategoria->nome; }} </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label for="descricao">Descricao</label>
                                    <input type="text" class="form-control" id="descricao" name="descricao" placeholder="Descrição da Despesa" maxlength="255" required>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light waves-effect" data-bs-dismiss="modal">Fechar</button>
                        <button type="submit" class="btn btn-primary waves-effect waves-light">Adicionar</button>
                    </div>
                </form>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div>

    <!-- Detalhes dos Pacotes -->
    <div class="modal fade bs-example-modal-lg" tabindex="-1" aria-labelledby="ModalDetalhePacotes" aria-hidden="true" style="display: none;" id="detalhesPacoteModal">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="tituloModalPacote">Despesa</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form class="form-horizontal" method="POST" id="formAtualizacaoPacote" action="">
                    @csrf
                    @method('PUT') <!-- Método HTTP para update -->
                    <div class="modal-body">
                        <!-- Campo hidden para armazenar o id da Warehouse -->
                        <input type="hidden" name="id" value="" id="dId">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="data">Data</label>
                                    <input class="form-control" type="date" value="{{ \Carbon\Carbon::today()->format('Y-m-d') ; }}" id="ddata" name="data">
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label for="valor">Valor</label>
                                    <input class="form-control" type="number" value="0.00" step="0.10" id="dvalor" name="valor">
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label for="categoria_id">Categoria</label>
                                    <select class="selectpicker form-control" data-live-search="true" id="dcategoria_id" name="categoria_id" required>
                                        @foreach ($all_categorias as $categoria)
                                            <option value="{{ $categoria->id }}"> {{ $categoria->nome; }} </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label for="subcategoria_id">SubCategoria</label>
                                    <select class="selectpicker form-control" data-live-search="true" id="dsubcategoria_id" name="subcategoria_id" required> 
                                        @foreach ($all_subcategorias as $subcategoria)
                                            <option value="{{ $subcategoria->id }}"> {{ $subcategoria->nome; }} </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label for="descricao">Descricao</label>
                                    <input type="text" class="form-control" id="ddescricao" name="descricao" placeholder="Descrição da Despesa" maxlength="255" required>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <!-- Botão de Exclusão -->
                        <button type="button" class="btn btn-danger ml-auto" data-bs-toggle="modal" data-bs-target="#confirmDelPctModal">
                            Excluir
                        </button>
                        <button type="button" class="btn btn-light waves-effect" data-bs-dismiss="modal">Fechar</button>
                        <button type="submit" class="btn btn-primary waves-effect waves-light" form="formAtualizacaoPacote">Atualizar</button>
                    </div>
                </form>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div>
</div>
<script>
    // JavaScript para abrir o modal ao clicar na linha da tabela
    document.querySelectorAll('.abrirModal').forEach(item => {
        item.addEventListener('click', event => {
            const pacoteId = event.currentTarget.dataset.pacoteId;
            const url = "{{ route('despesas.show', ':id') }}".replace(':id', pacoteId);
            fetch(url)
                .then(response => response.json())
                .then(data => {

                    document.getElementById('tituloModalPacote').innerText = data.descricao;
                    document.getElementById('dId').value = data.id;
                    document.getElementById('ddata').value = data.data;
                    document.getElementById('dvalor').value = data.valor;
                    document.getElementById('ddescricao').value = data.descricao;
                    // document.getElementById('dPesoAprox').value = data.peso_aprox;
                    document.getElementById('dcategoria_id').value = data.categoria_id;
                    document.getElementById('dsubcategoria_id').value = data.subcategoria_id;
                    $('.selectpicker').selectpicker('refresh');

                    var form = document.getElementById('formAtualizacaoPacote');
                    var novaAction = "{{ route('despesas.update', ['despesa' => ':id']) }}".replace(':id', data.id);
                    form.setAttribute('action', novaAction);

                    var form2 = document.getElementById('formDeletePctModal');
                    var novaAction2 = "{{ route('despesas.destroy', ['despesa' => ':id']) }}".replace(':id', data.id);
                    form2.setAttribute('action', novaAction2);

                })
                .catch(error => console.error('Erro:', error));
        });
    });
</script>
<!-- End Page-content -->
@endsection
