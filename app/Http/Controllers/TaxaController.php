<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Taxa;

class TaxaController extends Controller
{
    public function index() {
        $taxas = Taxa::all();
        return view('dash_pages.taxes', compact('taxas'));
    }

    public function create() {
        return view('taxas.create');
    }

    public function store(Request $request) {
        try {
            $request->validate([
                'nome' => 'required|string|max:255',
                'total' => 'required|numeric|min:0',
            ]);

            Taxa::create($request->all());
            return redirect()->back()->with('success', 'Taxa cadastrada com sucesso!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Erro ao cadastrar a taxa: ' . $e->getMessage());
        }
    }

    public function show(Taxa $taxa) {
        return view('taxas.show', compact('taxa'));
    }

    public function update(Request $request, string $id) {
        try {
            $taxa = Taxa::find($id);
            $request->validate([
                'nome' => 'required|string|max:255',
                'total' => 'required|numeric|min:0',
            ]);

            $taxa->update($request->all());
            return redirect()->back()->with('success', 'Taxa atualizada com sucesso!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Erro ao atualizar a taxa: ' . $e->getMessage());
        }
    }

    public function destroy(string $id) {
        try {
            $taxa = Taxa::find($id);
            $taxa->delete();
            return redirect()->back()->with('success', 'Taxa removida com sucesso!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Erro ao remover a taxa: ' . $e->getMessage());
        }
    }
}
