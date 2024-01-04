<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Despesa;
use App\Models\Categoria;
use App\Models\Subcategoria;
use Illuminate\Support\Facades\DB;

class DespesaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $all_despesas = Despesa::all();
        $all_categorias = Categoria::all();
        $all_subcategorias = Subcategoria::all();

        $resultados = Despesa::select('categoria_id', 'subcategoria_id', DB::raw('SUM(valor) as total'))
                    ->groupBy('categoria_id', 'subcategoria_id')
                    ->get();

        $resultados2 = Despesa::select('categoria_id', DB::raw('SUM(valor) as total'))
                    ->groupBy('categoria_id')
                    ->get();

        return view('despesas.index', compact('all_despesas', 'all_categorias', 'all_subcategorias', 'resultados', 'resultados2'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            // Validação dos dados do formulário
            $request->validate([
                'categoria_id' => 'required',             
                'subcategoria_id' => 'required',
                'descricao' => 'required',
                'valor' => 'required',
                'data' => 'required',
                // Adicione outras regras de validação conforme necessário
            ]);

            Despesa::create([
                'categoria_id' => $request->input('categoria_id'),
                'subcategoria_id' => $request->input('subcategoria_id'),
                'descricao' => $request->input('descricao'),
                'valor' => $request->input('valor'),
                'data' => $request->input('data'),
                // Adicione outros campos conforme necessário
            ]);

            // Exibir toastr de sucesso
            return redirect()->back()->with('toastr', [
                'type'    => 'success',
                'message' => 'Despesa criada com sucesso!',
                'title'   => 'Sucesso',
            ]);
        } catch (\Exception $e) {
            // Exibir toastr de Erro
            return redirect()->back()->with('toastr', [
                'type'    => 'error',
                'message' => 'Ocorreu um erro ao criar a Despesa: <br>'. $e->getMessage(),
                'title'   => 'Erro',
            ]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        try {
            $despesa = Despesa::findOrFail($id);

            return response()->json($despesa);
        } catch (\Exception $e) {
            // Exibir uma mensagem de erro ou redirecionar para uma página de erro
            return redirect()->back()->with('toastr', [
                'type'    => 'error',
                'message' => 'Ocorreu um erro ao exibir os detalhes da Despesa: <br>'. $e->getMessage(),
                'title'   => 'Erro',
            ]);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Despesa $despesa)
    {
        try {
            // Validação dos dados do formulário
            $request->validate([
                'categoria_id' => 'required',             
                'subcategoria_id' => 'required',
                'descricao' => 'required',
                'valor' => 'required',
                'data' => 'required',
                // Adicione outras regras de validação conforme necessário
            ]);

            $despesa->update([
                'categoria_id' => $request->input('categoria_id'),
                'subcategoria_id' => $request->input('subcategoria_id'),
                'descricao' => $request->input('descricao'),
                'valor' => $request->input('valor'),
                'data' => $request->input('data'),
                // Adicione outros campos conforme necessário
            ]);

            // Exibir toastr de sucesso
            return redirect()->back()->with('toastr', [
                'type'    => 'success',
                'message' => 'Despesa atualizado com sucesso!',
                'title'   => 'Sucesso',
            ]);
        } catch (\Exception $e) {
            // Exibir toastr de Erro
            return redirect()->back()->with('toastr', [
                'type'    => 'error',
                'message' => 'Ocorreu um erro ao atualizar a Despesa: <br>'. $e->getMessage(),
                'title'   => 'Erro',
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Despesa $despesa)
    {
        try {
            // Excluir o Shipper do banco de dados
            $despesa->delete();

            // Redirecionar após a exclusão bem-sucedida
            return redirect()->back()->with('toastr', [
                'type'    => 'success',
                'message' => 'Despesa excluída com sucesso!',
                'title'   => 'Sucesso',
            ]);
        } catch (\Exception $e) {
            // Exibir toastr de erro se ocorrer uma exceção
            return redirect()->back()->with('toastr', [
                'type'    => 'error',
                'message' => 'Ocorreu um erro ao excluir a Despesa: <br>'. $e->getMessage(),
                'title'   => 'Erro',
            ]);
        }
    }

}
