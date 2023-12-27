<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Clientes') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="table-responsive">
                        {{-- <table class="table table-centered mb-0 align-middle table-hover table-nowrap"> --}}
                        <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead class="table-light">
                                <tr>
                                    <th>ID</th>
                                    <th>Nome</th>
                                    <th>Apelido</th>
                                </tr>
                            </thead><!-- end thead -->
                            <tbody>
                                @foreach ($all_clientes as $cliente)
                                <tr>
                                {{-- <tr data-href="{{ route('shippers.show', ['shipper' => $shipper->id]) }}"> --}}
                                    <td><h6 class="mb-0">{{ $cliente->id }}</h6></td>
                                    <td>{{ $cliente->nome }}</td>
                                    <td>{{ $cliente->apelido }}</td>
                                    {{-- <td>{{ \Carbon\Carbon::parse($shipper->created_at)->format('d/m/Y H:i') }}</td> --}}
                                </tr>
                                @endforeach
                                 <!-- end -->
                            </tbody><!-- end tbody -->
                        </table> <!-- end table -->
                    </div>
                    {{-- <a href="{{ route('clientes.index') }}">Clientes</a> --}}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
