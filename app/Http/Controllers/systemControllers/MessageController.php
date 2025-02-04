<?php

namespace App\Http\Controllers\systemControllers;

use App\Http\Controllers\Controller;
use App\Models\Mensagem;
use Illuminate\Http\Request;
use Exception;

class MessageController extends Controller
{
    public function index()
    {
        try {
            $mensagens = Mensagem::all();
            return  view('dash_pages.message',compact('mensagens'));
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Erro ao carregar mensagens');
        }
    }

    public function create()
    {
        return redirect()->back()->with('message', 'Formulário de criação de mensagem');
    }

    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'contacto' => 'required',
                'conteudo' => 'required|string',
                'nome' => 'required|string',
                'titulo' => 'required|string',
            ]);

            Mensagem::create($validated);

            return redirect()->to('/#contact')->with('success', 'Mensagem enviada com sucesso');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Erro ao enviar a mensagem'.$e->getMessage());
        }
    }

    public function show(string $id)
    {
        try {
            $mensagem = Mensagem::find($id);

            if (!$mensagem) {
                return redirect()->back()->with('error', 'Mensagem não encontrada');
            }

            return redirect()->back()->with('success', 'Mensagem encontrada');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Erro ao carregar a mensagem');
        }
    }

    public function edit(string $id)
    {
        try {
            $mensagem = Mensagem::find($id);

            if (!$mensagem) {
                return redirect()->back()->with('error', 'Mensagem não encontrada');
            }

            return redirect()->back()->with('success', 'Formulário de edição de mensagem carregado');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Erro ao carregar o formulário de edição');
        }
    }

    public function update(Request $request, string $id)
    {
        try {
            $validated = $request->validate([
                'contacto' => 'required',
                'conteudo' => 'required|string',
                'nome' => 'required|string',
                'titulo' => 'required|string',
            ]);

            $mensagem = Mensagem::find($id);

            if (!$mensagem) {
                return redirect()->back()->with('error', 'Mensagem não encontrada');
            }

            $mensagem->update($validated);

            return redirect()->back()->with('success', 'Mensagem atualizada com sucesso');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Erro ao atualizar a mensagem');
        }
    }

    public function destroy(string $id)
    {
        try {
            $mensagem = Mensagem::find($id);

            if (!$mensagem) {
                return redirect()->back()->with('error', 'Mensagem não encontrada');
            }

            $mensagem->delete();

            return redirect()->back()->with('success', 'Mensagem excluída com sucesso');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Erro ao excluir a mensagem');
        }
    }
}
