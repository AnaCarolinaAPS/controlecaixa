<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Subcategoria;

class SubcategoriaController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            // Validação dos dados do formulário
            $request->validate([
                'nome' => 'required|string|max:255|unique:categorias',
                'categoria_id' => 'required',
                // Adicione outras regras de validação conforme necessário
            ]);

            Subcategoria::create([
                'nome' => $request->input('nome'),
                'categoria_id' => $request->input('categoria_id'),
                // Adicione outros campos conforme necessário
            ]);

            // Exibir toastr de sucesso
            return redirect()->back()->with('toastr', [
                'type'    => 'success',
                'message' => 'Subcategoria criada com sucesso!',
                'title'   => 'Sucesso',
            ]);
        } catch (\Exception $e) {
            // Exibir toastr de Erro
            return redirect()->back()->with('toastr', [
                'type'    => 'error',
                'message' => 'Ocorreu um erro ao criar a Subcategoria: <br>'. $e->getMessage(),
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
            $subcategoria = Subcategoria::findOrFail($id);

            return response()->json($subcategoria);
        } catch (\Exception $e) {
            // Exibir uma mensagem de erro ou redirecionar para uma página de erro
            return redirect()->back()->with('toastr', [
                'type'    => 'error',
                'message' => 'Ocorreu um erro ao exibir os detalhes da SubCategoria: <br>'. $e->getMessage(),
                'title'   => 'Erro',
            ]);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Subcategoria $subcategoria)
    {
        try {
            // Validação dos dados do formulário
            $request->validate([
                'nome' => 'required|string|max:255|unique:categorias',
                'categoria_id' => 'required',
                // Adicione outras regras de validação conforme necessário
            ]);

            $categoria->update([
                'nome' => $request->input('nome'),
                'categoria_id' => $request->input('categoria_id'),
                // Adicione outros campos conforme necessário
            ]);

            // Exibir toastr de sucesso
            return redirect()->back()->with('toastr', [
                'type'    => 'success',
                'message' => 'Subcategoria atualizado com sucesso!',
                'title'   => 'Sucesso',
            ]);
        } catch (\Exception $e) {
            // Exibir toastr de Erro
            return redirect()->back()->with('toastr', [
                'type'    => 'error',
                'message' => 'Ocorreu um erro ao atualizar a Subcategoria: <br>'. $e->getMessage(),
                'title'   => 'Erro',
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SubCategoria $subcategoria)
    {
        try {
            $subcategoria->delete();

            // Redirecionar após a exclusão bem-sucedida
            return redirect()->route('subcategorias.index')->with('toastr', [
                'type'    => 'success',
                'message' => 'Subcategoria excluída com sucesso!',
                'title'   => 'Sucesso',
            ]);
        } catch (\Exception $e) {
            // Exibir toastr de erro se ocorrer uma exceção
            return redirect()->back()->with('toastr', [
                'type'    => 'error',
                'message' => 'Ocorreu um erro ao excluir a Subcategoria: <br>'. $e->getMessage(),
                'title'   => 'Erro',
            ]);
        }
    }
}
