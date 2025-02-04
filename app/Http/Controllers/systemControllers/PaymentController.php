<?php

namespace App\Http\Controllers\systemControllers;

use App\Http\Controllers\Controller;
use App\Models\Pagamento;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Orcamento;
use Illuminate\Support\Facades\DB;

class PaymentController extends Controller
{
    /**
     * Listar todos os pagamentos
     */
    public function index()
    {
        $pagamentos = Pagamento::all();
        return view('payments.index', compact('pagamentos'));
    }

    /**
     * Exibir um pagamento específico
     */
    public function show($id)
    {
        $pagamento = Pagamento::find($id);

        if (!$pagamento) {
            return redirect()->back()->with('error', 'Pagamento não encontrado!');
        }

        return view('payments.show', compact('pagamento'));
    }

    public function store(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'metodo'       => 'required|string|in:Em Mão,TPA',
                'parcelar'     => 'required|string|in:sim,não',
                'valor'        => 'required|numeric|min:1',
                'observacao'   => 'nullable|string|max:255',
                'id_orcamento' => 'required|exists:orcamentos,id',
            ]);
    
            $validatedData['id_funcionario'] = auth()->user()->id;
            $orcamento = Orcamento::findOrFail($validatedData['id_orcamento']);
            $saldoRestante = $orcamento->total - $validatedData['valor'];
    
            if ($saldoRestante <= 0) {
                $validatedData['status'] = 'Finalizado';
            } else {
                $validatedData['status'] = 'Em Pagamento';
            }
    
            $validatedData['codigo_transacao'] = $this->generateTransactionCode();
    
            Pagamento::create($validatedData);
            return redirect()->back()->with('success', 'Pagamento registrado com sucesso!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Erro ao registrar pagamento: ' . $e->getMessage());
        }
    }
    
    
// Controller
public function update(Request $request, $id)
{
    try {
        $pagamento = Pagamento::find($id);
        if (!$pagamento) {
            return redirect()->back()->with('error', 'Pagamento não encontrado!');
        }

        $validatedData = $request->validate([
            'valor' => 'required|numeric|min:1',
        ]);

        $orcamento = Orcamento::find($pagamento->id_orcamento);
        if (!$orcamento) {
            return redirect()->back()->with('error', 'Orçamento não encontrado!');
        }

        $pagamento->valor += $validatedData['valor'];
        if ($pagamento->valor >= $orcamento->total) {
            $pagamento->status = 'finalizado';
        }
        $pagamento->save();

        return redirect()->back()->with('success', 'Pagamento atualizado com sucesso!');
    } catch (Exception $e) {
        return redirect()->back()->with('error', 'Erro ao atualizar pagamento: ' . $e->getMessage());
    }
}

    /**
     * Excluir um pagamento
     */
    public function destroy($id)
    {
        $pagamento = Pagamento::find($id);

        if (!$pagamento) {
            return redirect()->back()->with('error', 'Pagamento não encontrado!');
        }

        $pagamento->delete();

        return redirect()->back()->with('success', 'Pagamento excluído com sucesso!');
    }

  

    public function downloadReceipt($id)
{
    $orcamento = DB::table('orcamentos')
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
            'pagamentos.codigo_transacao',
            'users.*',
            'users.status as estado_perfil',
            'orcamentos.status as estado_orcamento',
            'servicos.nome as servico_nome',
            'servicos.preco as servico_preco',
            DB::raw('COALESCE(JSON_ARRAYAGG(JSON_OBJECT("nome", COALESCE(taxas.nome, "N/A"), "total", COALESCE(taxas.total, 0))), JSON_ARRAY()) as taxes')
        )
        ->where('orcamentos.id', '=', $id)
        ->groupBy(
            'orcamentos.id',
            'servicos.id',
            'users.id',
            'pagamentos.id'
        )
        ->first(); 

    if (!$orcamento) {
        return redirect()->back()->with('error', 'Pagamento não encontrado!');
    }

    $pdf = Pdf::loadView('payments.receipt', compact('orcamento'));
    $filePath = "comprovativos/{$orcamento->codigo_transacao}.pdf";

    Storage::put($filePath, $pdf->output());

    return Storage::download($filePath, "Comprovativo-{$orcamento->codigo_transacao}.pdf");
}


   
    private function generateTransactionCode()
    {
        do {
            $codigo = mt_rand(10000000, 99999999);
        } while (Pagamento::where('codigo_transacao', $codigo)->exists());

        return (string) $codigo;
    }
}
