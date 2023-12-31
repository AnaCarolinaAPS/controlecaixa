<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cliente;

class ClienteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $all_clientes = Cliente::all();
        return view('cliente.index', compact('all_clientes'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // try {
        //     // Validação dos dados do formulário
        //     $request->validate([
        //         'name' => 'required|string|max:255|unique:shippers',
        //         // Adicione outras regras de validação conforme necessário
        //     ]);

        //     // Criação de um novo Shipper no banco de dados
        //     Shipper::create([
        //         'name' => $request->input('name'),
        //         // Adicione outros campos conforme necessário
        //     ]);

        //     // Exibir toastr de sucesso
        //     return redirect()->route('shippers.index')->with('toastr', [
        //         'type'    => 'success',
        //         'message' => 'Shipper criado com sucesso!',
        //         'title'   => 'Sucesso',
        //     ]);
        // } catch (\Exception $e) {
        //     // Exibir toastr de Erro
        //     return redirect()->route('shippers.index')->with('toastr', [
        //         'type'    => 'error',
        //         'message' => 'Ocorreu um erro ao criar o Shipper: <br>'. $e->getMessage(),
        //         'title'   => 'Erro',
        //     ]);
        // }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        // try {
        //     // Buscar o shipper pelo ID
        //     $shipper = Shipper::findOrFail($id);

        //     // Retornar a view com os detalhes do shipper
        //     return view('admin.shipper.show', compact('shipper'));
        // } catch (\Exception $e) {
        //     // Exibir uma mensagem de erro ou redirecionar para uma página de erro
        //     return redirect()->route('shippers.index')->with('toastr', [
        //         'type'    => 'error',
        //         'message' => 'Ocorreu um erro ao exibir os detalhes do Shipper: <br>'. $e->getMessage(),
        //         'title'   => 'Erro',
        //     ]);
        // }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Cliente $cliente)
    {
        // try {
        //     // Validação dos dados do formulário
        //     $request->validate([
        //         'name' => 'required|string|max:255|unique:shippers',
        //         // Adicione outras regras de validação conforme necessário
        //     ]);

        //     // Atualizar os dados do Shipper
        //     $shipper->update([
        //         'name' => $request->input('name'),
        //         // Adicione outros campos conforme necessário
        //     ]);

        //     // Exibir toastr de sucesso
        //     return redirect()->route('shippers.show', ['shipper' => $shipper->id])->with('toastr', [
        //         'type'    => 'success',
        //         'message' => 'Shipper atualizado com sucesso!',
        //         'title'   => 'Sucesso',
        //     ]);
        // } catch (\Exception $e) {
        //     // Exibir toastr de Erro
        //     return redirect()->route('shippers.show', ['shipper' => $shipper->id])->with('toastr', [
        //         'type'    => 'error',
        //         'message' => 'Ocorreu um erro ao atualizar o Shipper: <br>'. $e->getMessage(),
        //         'title'   => 'Erro',
        //     ]);
        // }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Cliente $cliente)
    {
        // // Verificar se o Shipper possui Warehouses
        // if ($shipper->warehouses()->exists()) {
        //     return redirect()->back()->with('toastr', [
        //         'type'    => 'error',
        //         'message' => 'Não é possível excluir o Shipper, pois ele possui Warehouses associadas.',
        //         'title'   => 'Erro',
        //     ]);
        // }

        // try {
        //     // Excluir o Shipper do banco de dados
        //     $shipper->delete();

        //     // Redirecionar após a exclusão bem-sucedida
        //     return redirect()->route('shippers.index')->with('toastr', [
        //         'type'    => 'success',
        //         'message' => 'Shipper excluído com sucesso!',
        //         'title'   => 'Sucesso',
        //     ]);
        // } catch (\Exception $e) {
        //     // Exibir toastr de erro se ocorrer uma exceção
        //     return redirect()->back()->with('toastr', [
        //         'type'    => 'error',
        //         'message' => 'Ocorreu um erro ao excluir o Shipper: <br>'. $e->getMessage(),
        //         'title'   => 'Erro',
        //     ]);
        // }
    }
}
