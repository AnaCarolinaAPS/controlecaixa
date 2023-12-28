
@extends('layouts.admin_master')
@section('titulo', 'Cargas | PowerTrade.Py')

@section('admin')
<div class="page-content">
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">Cargas</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Admin</a></li>
                            <li class="breadcrumb-item active">Cargas</li>
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
                        <h4 class="card-title mb-4">Carga</h4>
                        <button type="button" class="btn btn-success waves-effect waves-light mb-2" data-bs-toggle="modal" data-bs-target=".bs-example-modal-lg">
                            <i class="fas fa-plus"></i> Novo
                        </button>
                        <div class="table-responsive">
                            {{-- <table class="table table-centered mb-0 align-middle table-hover table-nowrap"> --}}
                            <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead class="table-light">
                                    <tr>
                                        {{-- <th>ID</th> --}}
                                        <th>Data Enviado</th>
                                        <th>Data Recebida</th>
                                        <th>Embarcador</th>
                                        <th>Despachante</th>
                                        <th>Peso Guia</th>
                                    </tr>
                                </thead><!-- end thead -->
                                <tbody>
                                    @foreach ($all_cargas as $carga)
                                    <tr data-href="{{ route('cargas.show', ['carga' => $carga->id]) }}">
                                        {{-- <td><h6 class="mb-0">{{ $carga->id }}</h6></td> --}}
                                        <td>{{ \Carbon\Carbon::parse($carga->data_enviada)->format('d/m/Y') }}</td>
                                        <td>{{ \Carbon\Carbon::parse($carga->data_recebida)->format('d/m/Y') }}</td>
                                        <td>{{ $carga->embarcador }}</td>
                                        <td>{{ $carga->despachante }}</td>
                                        <td>{{ $carga->peso_guia }}</td>
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
    </div>
    <div class="modal fade bs-example-modal-lg" tabindex="-1" aria-labelledby="ModalShipper" aria-hidden="true" style="display: none;">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="myLargeModalLabel">Novo Cargas</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form class="form-horizontal mt-3" method="POST" action="{{ route('cargas.store') }}">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="data">Data Envio</label>
                                    <input class="form-control" type="date" value="{{ \Carbon\Carbon::today()->format('Y-m-d') ; }}" id="data_enviada" name="data_enviada">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="data">Data Recebida</label>
                                    <input class="form-control" type="date" value="{{ \Carbon\Carbon::today()->format('Y-m-d') ; }}" id="data_recebida" name="data_recebida">
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label for="peso_aprox">Peso Guia</label>
                                    <input class="form-control" type="number" value="0.0" step="0.1" id="peso_guia" name="peso_guia">
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label for="embarcador_id">Tipo</label>
                                    <select class="selectpicker form-control" data-live-search="true" id="tipo" name="tipo">
                                        <option value="Aereo"> Aereo </option>
                                        <option value="Maritimo"> Maritimo </option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col">
                                <div class="form-group">
                                    <label for="embarcador_id">Embarcador</label>
                                    <select class="selectpicker form-control" data-live-search="true" id="embarcador" name="embarcador">
                                        <option value="Peniel"> Peniel </option>
                                        <option value="Transway"> Transway </option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md">
                                <div class="form-group">
                                    <label for="despachante_id">Despachante</label>
                                    <select class="selectpicker form-control" data-live-search="true" id="despachante" name="despachante">
                                        <option value="Heriberto"> Heriberto </option>
                                        <option value="Adrian"> Adrian </option>
                                    </select>
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

</div>
<!-- End Page-content -->

<script>
    document.addEventListener("DOMContentLoaded", function() {
        var tableRows = document.querySelectorAll('tbody tr[data-href]');

        tableRows.forEach(function(row) {
            row.addEventListener('click', function() {
                window.location.href = this.dataset.href;
            });
        });
    });
</script>
@endsection
