<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categoria;
use Spatie\Browsershot\Browsershot;
use Spipu\Html2Pdf\Html2Pdf;

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

    public function gerarPDF()
    {
        // Lógica para obter os dados da categoria
        $categorias = Categoria::all() ?? [];


        if (!$categorias) {
            // Lógica para lidar com a categoria não encontrada
            abort(404);
        }

        $html2pdf = new Html2Pdf();
        $html2pdf->writeHTML('<h1>HelloWorld</h1>This is my first test');
        $html2pdf->output();

        // return view('categoria.categoria-pdf', compact('categorias'));

        // Gere o PDF
        // $pdf = PDF::loadView('categoria.categoria-pdf', compact('categorias'));

        // Gere o PDF
        // $pdf = PDF::loadView('categoria.categoria-pdf', compact('categorias'));

        // Crie uma instância do TCPDF
        // $pdf = new TCPDF();
        // // Adicione uma página
        // $pdf->AddPage('L', 'A4');
        // // Renderize a view do Laravel TCPDF
        // $html = view('categoria.categoria-pdf', compact('categorias'))->render();

        // $view = \View::make('categoria.categoria-pdf', ['categorias' => $categorias]);
        // $html = $view->render();

        // $data = [
    	// 	'cliente' => '166LM - Luiz Fabio'
    	// ];


        // $view = \View::make('categoria.categoria-pdf', $data);
        // $html = $view->render();

        // // // Adicione o conteúdo HTML ao PDF
        // // $pdf->writeHTML($html, true, false, true, false, '');

        // // // Salve ou envie o PDF como resposta
        // // // $pdf->Output('caminho/do/pdf/arquivo.pdf', 'F'); // Para salvar o PDF
        // // $pdf->Output('nome-do-pdf-arquivo.pdf', 'I'); // Para exibir o PDF no navegador

        // // $html = '<h1>Hello World</h1>';

        // PDF::SetTitle('Hello World');
        // PDF::AddPage();
        // PDF::writeHTML($html, true, false, true, false, '');

        // PDF::Output('hello_world.pdf');


        // $view = \View::make('categoria.categoria-pdf',compact('categorias'));
        // $html = $view->render();

        // $pdf = new TCPDF();
        // $pdf::SetTitle('Hello World');
        // $pdf::AddPage();
        // $pdf::writeHTML($html, true, false, true, false, '');
        // $pdf::Output('hello_world.pdf');
    }
}
