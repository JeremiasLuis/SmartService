<?php

namespace App\Http\Controllers\systemControllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Orcamento;
use Illuminate\Support\Facades\DB;
class OrcamentoController extends Controller
{
    public function index()
    {
        $user_status = auth()->user()->tipo;
        $orcamentos = 0;
        if($user_status == 'Cliente') {
            $orcamentos = DB::table('orcamentos')
            ->join('users', 'users.id', '=', 'orcamentos.id_cliente')
            ->join('servicos', 'orcamentos.id_servico', '=', 'servicos.id')
            ->leftJoin('taxas_registradas', 'servicos.id', '=', 'taxas_registradas.id_servicos') 
            ->leftJoin('taxas', 'taxas_registradas.id_taxa', '=', 'taxas.id')
            ->leftJoin('pagamentos', 'pagamentos.id_orcamento', '=', 'orcamentos.id') 
            ->select(
                'orcamentos.*',
                'orcamentos.id as id_orcamento',
                'orcamentos.total as total_orcamento',
                'pagamentos.metodo',
                'pagamentos.id as id_pagamento',
                'pagamentos.parcelar',
                'pagamentos.valor as valor_pago',
                'pagamentos.status as estado_pagamento',
                'pagamentos.observacao',
                'users.*',
                'users.status as estado_perfil',
                'orcamentos.status as estado_orcamento',
                'servicos.nome as servico_nome',
                'servicos.preco as servico_preco',
                DB::raw('COALESCE(JSON_ARRAYAGG(JSON_OBJECT("nome", taxas.nome, "total", taxas.total)), JSON_ARRAY()) as taxes')
            )
            ->where('orcamentos.id_cliente','=',auth()->user()->id)
            ->groupBy('orcamentos.id', 'servicos.id', 'users.id', 'pagamentos.id') 
            ->orderBy('orcamentos.id', 'desc') 
            ->get();
        }else{
            $orcamentos = DB::table('orcamentos')
            ->join('users', 'users.id', '=', 'orcamentos.id_cliente')
            ->join('servicos', 'orcamentos.id_servico', '=', 'servicos.id')
            ->leftJoin('taxas_registradas', 'servicos.id', '=', 'taxas_registradas.id_servicos') 
            ->leftJoin('taxas', 'taxas_registradas.id_taxa', '=', 'taxas.id')
            ->leftJoin('pagamentos', 'pagamentos.id_orcamento', '=', 'orcamentos.id') 
            ->select(
                'orcamentos.*',
                'orcamentos.id as id_orcamento',
                'orcamentos.total as total_orcamento',
                'pagamentos.metodo',
                'pagamentos.id as id_pagamento',
                'pagamentos.parcelar',
                'pagamentos.valor as valor_pago',
                'pagamentos.status as estado_pagamento',
                'pagamentos.observacao',
                'users.*',
                'users.status as estado_perfil',
                'orcamentos.status as estado_orcamento',
                'servicos.nome as servico_nome',
                'servicos.preco as servico_preco',
                DB::raw('COALESCE(JSON_ARRAYAGG(JSON_OBJECT("nome", taxas.nome, "total", taxas.total)), JSON_ARRAY()) as taxes')
            )
            ->groupBy('orcamentos.id', 'servicos.id', 'users.id', 'pagamentos.id') 
            ->orderBy('orcamentos.id', 'desc') 
            ->get();
        }
       

    

        return view('dash_pages.orcamento', compact('orcamentos'));
    }

    public function create()
    {
        return view('orcamentos.create');
    }

    public function store(Request $request)
    {
        
        $request->validate([
            'total' => 'required|numeric',
            'id_servico' => 'required|exists:servicos,id',
            'id_cliente' => 'required|exists:users,id',
        ]);

        try {
            Orcamento::create($request->all());
            return redirect('/orcamentos')->with('success', 'Orçamento criado com sucesso.');
        } catch (\Throwable $th) {
            return back()->with('error', 'Ops! Algo deu errado: ' . $th->getMessage());
        }
    }

    public function show(string $id)
    {
        $orcamento = Orcamento::findOrFail($id);
        return view('orcamentos.show', compact('orcamento'));
    }

    public function edit(string $id)
    {
        $orcamento = Orcamento::findOrFail($id);
        return view('orcamentos.edit', compact('orcamento'));
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'total' => 'required|numeric',
            'id_servico' => 'required|exists:servicos,id',
            'id_cliente' => 'required|exists:users,id',
        ]);

        try {
            $orcamento = Orcamento::findOrFail($id);
            $orcamento->update($request->all());
            return redirect()->with('success', 'Orçamento atualizado com sucesso.');
        } catch (\Throwable $th) {
            return back()->with('error', 'Ops! Algo deu errado: ' . $th->getMessage());
        }
    }

    public function destroy(string $id)
    {
        try {
            $orcamento = Orcamento::findOrFail($id);
            $orcamento->delete();
            return redirect()->route('orcamentos.index')->with('success', 'Orçamento deletado com sucesso.');
        } catch (\Throwable $th) {
            return back()->with('error', 'Ops! Algo deu errado: ' . $th->getMessage());
        }
    }
}
