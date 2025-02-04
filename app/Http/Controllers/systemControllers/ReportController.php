<?php

namespace App\Http\Controllers\systemControllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Viatura;
use Barryvdh\DomPDF\Facade\Pdf;


class ReportController extends Controller
{
    public function index(Request $request)
    {
        $dataInicio = $request->input('data_inicio');
        $dataFim = $request->input('data_fim');

        $query = Viatura::all();

        if ($dataInicio && $dataFim) {
            $query->whereBetween('created_at', [$dataInicio, $dataFim]);
        }

        $totalViaturas = $query->count();
        $viaturasConcluidas = $query->where('estado','=', 'Concluído')->count();
        $viaturasPorConcluir = $query->where('estado', '!=', 'Concluído')->count();

        return view('reports.index', compact('totalViaturas', 'viaturasConcluidas', 'viaturasPorConcluir', 'dataInicio', 'dataFim'));
    }

    public function gerarPdf(Request $request)
    {
        $dataInicio = $request->input('data_inicio');
        $dataFim = $request->input('data_fim');

        $query = Viatura::all();

        if ($dataInicio && $dataFim) {
            $query->whereBetween('created_at', [$dataInicio, $dataFim]);
        }

        $viaturas = $query;

        $pdf = Pdf::loadView('reports.pdf', compact('viaturas', 'dataInicio', 'dataFim'));

        return $pdf->download('relatorio_viaturas.pdf');
    }
}
