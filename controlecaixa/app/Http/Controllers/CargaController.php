<?php

namespace App\Http\Controllers;

use App\Models\Carga;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CargaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $all_cargas = Carga::all();
        return view('carga.index', compact('all_cargas'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            // Validação dos dados do formulário
            $request->validate([
                'data_enviada' => 'required|date',
                'data_recebida' => 'required|date',
                'tipo' => 'required',
                'peso_guia' => 'required',
                'embarcador' => 'required',
                'despachante' => 'required',
                // Adicione outras regras de validação conforme necessário
            ]);

            // Criação de um novo Shipper no banco de dados
            $carga = Carga::create([
                'data_enviada' => $request->input('data_enviada'),
                'embarcador' => $request->input('embarcador'),
                'despachante' => $request->input('despachante'),
                'data_recebida' => $request->input('data_recebida'),
                'tipo' => $request->input('tipo'),
                'peso_guia' => $request->input('peso_guia'),
                // Adicione outros campos conforme necessário
            ]);

            // Exibir toastr de sucesso
            return redirect()->route('cargas.show', ['carga' => $carga->id])->with('toastr', [
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

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        try {
            // Buscar o shipper pelo ID
            $carga = Carga::findOrFail($id);

            $tipos = ['Aereo', 'Maritimo'];

            // Retornar a view com os detalhes do shipper
            return view('carga.show', compact('carga', 'tipos'));
        } catch (\Exception $e) {
            // Exibir uma mensagem de erro ou redirecionar para uma página de erro
            return redirect()->route('cargas.index')->with('toastr', [
                'type'    => 'error',
                'message' => 'Ocorreu um erro ao exibir os detalhes da Carga: <br>'. $e->getMessage(),
                'title'   => 'Erro',
            ]);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Carga $carga)
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
    public function destroy(Carga $carga)
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

    public static function getEnumValues($column)
    {
        $type = DB::select(DB::raw("SHOW COLUMNS FROM cargas WHERE Field = '{$column}'"))[0]->Type;
        preg_match('/^enum\((.*)\)$/', $type, $matches);
        $enum = array();
        foreach (explode(',', $matches[1]) as $value) {
            $v = trim($value, "'");
            $enum[] = $v;
        }
        return $enum;
    }
}
