<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categoria;

class CategoriaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $all_categorias = Categoria::all();
        return view('categoria.index', compact('all_categorias'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            // Validação dos dados do formulário
            $request->validate([
                'nome' => 'required|string|max:255|unique:categorias',
                // Adicione outras regras de validação conforme necessário
            ]);

            Categoria::create([
                'nome' => $request->input('nome'),
                // Adicione outros campos conforme necessário
            ]);

            // Exibir toastr de sucesso
            return redirect()->route('categorias.index')->with('toastr', [
                'type'    => 'success',
                'message' => 'Categoria criada com sucesso!',
                'title'   => 'Sucesso',
            ]);
        } catch (\Exception $e) {
            // Exibir toastr de Erro
            return redirect()->route('categorias.index')->with('toastr', [
                'type'    => 'error',
                'message' => 'Ocorreu um erro ao criar a Categoria: <br>'. $e->getMessage(),
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
            $categoria = Categoria::findOrFail($id);

            return view('categoria.show', compact('categoria'));
        } catch (\Exception $e) {
            // Exibir uma mensagem de erro ou redirecionar para uma página de erro
            return redirect()->route('categorias.index')->with('toastr', [
                'type'    => 'error',
                'message' => 'Ocorreu um erro ao exibir os detalhes da Cateogira: <br>'. $e->getMessage(),
                'title'   => 'Erro',
            ]);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Categoria $categoria)
    {
        try {
            // Validação dos dados do formulário
            $request->validate([
                'nome' => 'required|string|max:255|unique:categorias',
                // Adicione outras regras de validação conforme necessário
            ]);

            $categoria->update([
                'nome' => $request->input('nome'),
                // Adicione outros campos conforme necessário
            ]);

            // Exibir toastr de sucesso
            return redirect()->route('categorias.show', ['categoria' => $categoria->id])->with('toastr', [
                'type'    => 'success',
                'message' => 'Categoria atualizado com sucesso!',
                'title'   => 'Sucesso',
            ]);
        } catch (\Exception $e) {
            // Exibir toastr de Erro
            return redirect()->route('categorias.show', ['categoria' => $categoria->id])->with('toastr', [
                'type'    => 'error',
                'message' => 'Ocorreu um erro ao atualizar a Categoria: <br>'. $e->getMessage(),
                'title'   => 'Erro',
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Categoria $categoria)
    {
        try {
            $categoria->delete();

            // Redirecionar após a exclusão bem-sucedida
            return redirect()->route('categorias.index')->with('toastr', [
                'type'    => 'success',
                'message' => 'Categoria excluída com sucesso!',
                'title'   => 'Sucesso',
            ]);
        } catch (\Exception $e) {
            // Exibir toastr de erro se ocorrer uma exceção
            return redirect()->back()->with('toastr', [
                'type'    => 'error',
                'message' => 'Ocorreu um erro ao excluir a Categoria: <br>'. $e->getMessage(),
                'title'   => 'Erro',
            ]);
        }
    }
}
