@extends('layouts.pdf_master')

@section('view')
    {{-- <img src="{{ asset('images/logo.png') }}" alt="Logo da Empresa"> --}}

    <div class="page-content">
        <div class="container-fluid">
            <!-- start page title -->
            <div class="row">
                <div class="col">
                    <img src="{{ asset('images/logo.png') }}" class="img-fluid" style="max-width: 65%;" alt="Logo da Empresa">
                    <p><b>Cliente:</b> </p>
                </div>
                <div class="col">
                    <div class="row text-center">
                        <h2>Entrega de Carga</h2>
                    </div>

                    <div class="row">
                        <div class="col text-end"><b>Data</b></div>
                        <div class="col text-start">01/08/2024</div>
                    </div>
                    <div class="row">
                        <div class="col text-end"><b>Hora</b></div>
                        <div class="col text-start">16:30</div>
                    </div>
                    <div class="row">
                        <div class="col text-end"><b>Entregado por</b></div>
                        <div class="col text-start">Ana</div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <div class="table-responsive">
                        <table class="table align-middle text-center">
                            <thead>
                                <tr>
                                    <th class="border-left border-right">#</th>
                                    <th>Data</th>
                                    <th>Identificação</th>
                                    <th>Qtd.</th>
                                    <th>Kg.</th>
                                    <!-- Adicione mais colunas conforme necessário -->
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($categorias as $categoria)
                                <tr>
                                    <td class="border-left border-right">{{ $categoria->id }}</td>
                                    <td>01/01/2024</td>
                                    <td class="border-left border-right">{{ $categoria->nome }}</td>
                                    <td>1</td>
                                    <td>10,0</td>
                                    <!-- Adicione mais colunas conforme necessário -->
                                </tr>
                                @endforeach
                                {{-- @if (count($categorias) < 15) --}}
                                    @for ($i =1; $i <= 15; $i++)
                                        <tr class=" h-100">
                                            <td class="border-left border-right">.</td>
                                            <td class="border-left border-right"> </td>
                                            <td class="border-left border-right"> </td>
                                            <td class="border-left border-right"> </td>
                                            <td class="border-left border-right"> </td>
                                            <!-- Adicione mais colunas conforme necessário -->
                                        </tr>
                                        <!-- Adicione mais linhas conforme necessário -->
                                    @endfor
                                {{-- @endif --}}
                            </tbody>
                            <tfoot>
                                <td colspan="3" class="text-center" style="border-bottom: none;border-left: none;">Todos os itens mencionados acima foram entregues a</td>
                                <td>Qtd</td>
                                <td>Kgs</td>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
