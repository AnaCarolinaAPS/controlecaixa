<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Invoice;


class InvoiceController extends Controller
{
    public function index()
    {
        // Retorna uma lista de todas as invoices
        // $invoices = Invoice::all();
        // return view('invoices.index', compact('invoices'));
    }

    public function show($id)
    {
        $invoice = Invoice::find($id);
        return response()->json($invoice);
    }

    public function store(Request $request)
    {
        try {
            // Validação dos dados do formulário
            $request->validate([
                'carga_id' => 'required',
                'cliente_id' => 'required',
                'peso_real' => 'required',
                'peso_cobrado' => 'required',
                'valor_cobrado' => 'required',
                // Adicione outras regras de validação conforme necessário
            ]);

            // Criação de um novo Shipper no banco de dados
            $carga = Invoice::create([
                'carga_id' => $request->input('carga_id'),
                'cliente_id' => $request->input('cliente_id'),
                'peso_real' => $request->input('peso_real'),
                'peso_cobrado' => $request->input('peso_cobrado'),
                'valor_cobrado' => $request->input('valor_cobrado'),
                // Adicione outros campos conforme necessário
            ]);

            // Exibir toastr de sucesso
            return redirect()->back()->with('toastr', [
                'type'    => 'success',
                'message' => 'Carga criada com sucesso!',
                'title'   => 'Sucesso',
            ]);
        } catch (\Exception $e) {
            // Exibir toastr de Erro
            return redirect()->route('cargas.index')->with('toastr', [
                'type'    => 'error',
                'message' => 'Ocorreu um erro ao criar a Carga: <br>'. $e->getMessage(),
                'title'   => 'Erro',
            ]);
        }
    }

    public function update(Request $request, $id)
    {
        // // Atualiza os detalhes de uma invoice no banco de dados
        // $invoice = Invoice::findOrFail($id);
        // // Defina aqui a lógica para atualizar os valores dos campos do modelo Invoice
        // $invoice->save();

        // // Redireciona para a página de exibição da invoice atualizada
        // return redirect()->route('invoices.show', $invoice->id);
    }

    public function destroy($id)
    {
        // // Deleta uma invoice do banco de dados
        // $invoice = Invoice::findOrFail($id);
        // $invoice->delete();

        // // Redireciona de volta para a lista de invoices
        // return redirect()->route('invoices.index');
    }
}
