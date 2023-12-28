@extends('layouts.admin_master')
@section('titulo', 'Cargas | PowerTrade.Py')

@section('admin')
<div class="page-content">
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">Carga</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Admin</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('cargas.index'); }}">Cargas</a></li>
                            <li class="breadcrumb-item active">Carga Enviada em {{ \Carbon\Carbon::parse($carga->data_enviada)->format('d/m/Y') }}</li>
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
                        <!-- <h4 class="card-title mb-4">Detalhes</h4> -->

                        <form class="form-horizontal mt-3" method="POST" action="{{ route('cargas.update', ['carga' => $carga->id]) }}" id="formWarehouse">
                            @csrf
                            @method('PUT') <!-- Método HTTP para update -->
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label for="data_enviada">Data Enviada</label>
                                        <input class="form-control" type="date" value="{{  $carga->data_enviada; }}" id="data_enviada" name="data_enviada">
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label for="data_recebida">Data Recebida</label>
                                        <input class="form-control" type="date" value="{{  $carga->data_recebida; }}" id="data_recebida" name="data_recebida">
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label for="peso_guia">Peso Guia</label>
                                        <input class="form-control" type="number" step="0.1" value="{{  $carga->peso_guia; }}" id="peso_guia" name="peso_guia">
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label for="tipo">Tipo</label>
                                        <select class="selectpicker form-control" data-live-search="true" id="despachante_id" name="despachante_id">
                                            @foreach ($tipos as $tipo)
                                                <option value="{{ $tipo }}" {{ $tipo == $carga->tipo ? 'selected' : '' }}> {{ $tipo }} </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="modal-footer">
                                <!-- Botão de Exclusão -->
                                <button type="button" class="btn btn-danger ml-auto" data-bs-toggle="modal" data-bs-target="#confirmDeleteModal">
                                    Excluir
                                </button>
                                {{-- <button type="button" class="btn btn-info ml-auto" data-bs-toggle="modal" data-bs-target="#receberModal">
                                    Receber
                                </button> --}}
                                <a href="{{ route('cargas.index'); }}" class="btn btn-light waves-effect">Voltar</a>
                                <button type="submit" class="btn btn-primary waves-effect waves-light" form="formWarehouse">Salvar</button>
                            </div>
                        </form>
                    </div><!-- end card -->
                </div><!-- end card -->
            </div>
            <!-- end col -->
        </div>
        <!-- end page title -->
        <div class="row">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title mb-4">Invoices</h4>
                        <button type="button" class="btn btn-success waves-effect waves-light mb-2" data-bs-toggle="modal" data-bs-target="#ModalInvoice">
                            <i class="fas fa-plus"></i> Add Invoice
                        </button>
                        <button type="button" class="btn btn-success waves-effect waves-light mb-2" data-bs-toggle="modal" data-bs-target="#ModalPagamento">
                            <i class="fas fa-plus"></i> Add Pagamento
                        </button>
                        <div class="table-responsive">
                            {{-- <table class="table table-centered mb-0 align-middle table-hover table-nowrap"> --}}
                            <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead class="table-light">
                                    <tr>
                                        <th>Cliente</th>
                                        <th>Peso Real</th>
                                        <th>Peso Cobrado</th>
                                        <th>Valor Cobrado</th>
                                        <th>Valor Pendente</th>
                                    </tr>
                                </thead><!-- end thead -->
                                <tbody>
                                    @foreach ($carga->invoices as $invoice)
                                    <tr>
                                        <td>{{ '('.$invoice->cliente->codigo.') '.$invoice->cliente->apelido }}</td>
                                        <td>{{ $invoice->peso_real }}</td>
                                        <td>{{  $invoice->peso_real }}</td>
                                        <td>{{  $invoice->valor_cobrado }}</td>
                                        <td>{{  'Aguardando' }}</td>
                                    </tr>
                                    @endforeach
                                     <!-- end -->
                                </tbody><!-- end tbody -->
                            </table> <!-- end table -->
                        </div>
                        {{-- <div class="row text-center">
                            <div class="col">
                                <p><h6 class="mb-0">Total Recebido: {{ $totais->total_real ?? '0'}} kgs</h6></p>
                            </div>
                            <div class="col">
                                <p><h6 class="mb-0">Quantidade Total: {{$totais->total_pacotes ?? '0'}} cxs</h6></p>
                            </div>
                            <div class="col">
                                <p><h6 class="mb-0">Total Previsto: {{$totais->total_aproximado ?? '0'}} kgs</h6></p>
                            </div>
                        </div> --}}
                    </div><!-- end card -->
                </div><!-- end card -->
            </div>
            <!-- end col -->
        </div>

        <!-- Modal de Confirmação -->
        <div class="modal fade" id="confirmDeleteModal" tabindex="-1" role="dialog" aria-labelledby="confirmDeleteModal" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="confirmDeleteModalLabel">Confirmação de Exclusão</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p>Tem certeza que deseja excluir esta Carga?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light waves-effect" data-bs-dismiss="modal">Fechar</button>
                        <!-- Adicionar o botão de exclusão no modal -->
                        <form method="post" action="{{ route('cargas.destroy', ['carga' => $carga->id]) }}">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger waves-effect waves-light">Excluir</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade bs-example-modal-lg" tabindex="-1" aria-labelledby="ModalInvoice" aria-hidden="true" style="display: none;" id="ModalInvoice">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="myLargeModalLabel">Nova Invoice</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form class="form-horizontal mt-3" method="POST" action="{{ route('invoices.store' )}}" id="formNewInvoice">
                        @csrf
                        <div class="modal-body">
                            <input type="hidden" name="carga_id" value="{{ $carga->id }}">
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label for="cliente_id">Cliente</label>
                                        <select class="selectpicker form-control" data-live-search="true" id="cliente_id" name="cliente_id" required>
                                            @foreach ($all_clientes as $cliente)
                                                <option value="{{ $cliente->id }}"> ({{ $cliente->codigo }}) {{ $cliente->apelido }} </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label for="peso_real">Peso Real</label>
                                        <input class="form-control" type="number" step="0.1" value="0.0" id="peso_real" name="peso_real">
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label for="peso_cobrado">Peso Cobrado</label>
                                        <input class="form-control" type="number" step="0.1" value="0.0" id="peso_cobrado" name="peso_cobrado">
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label for="valor_cobrado">Valor Cobrado</label>
                                        <input class="form-control" type="number" step="0.10" value="0.00" id="valor_cobrado" name="valor_cobrado">
                                    </div>
                                </div>                                
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-light waves-effect" data-bs-dismiss="modal">Fechar</button>
                            <button type="submit" class="btn btn-primary waves-effect waves-light" form="formNewInvoice">Adicionar</button>
                        </div>
                    </form>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div>

    </div>
</div>

<script>

</script>
<!-- End Page-content -->
@endsection
