<?php

namespace App\Http\Controllers\systemControllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Servico;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class UsersController extends Controller
{

    public function index()
    {
        $users = User::where('tipo','=','Cliente')->get();
        return view('dash_pages.customers',compact('users'));
    }
    public function dashboard()
    {
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
        'users.nome as cliente',
        'users.status as estado_perfil',
        'orcamentos.status as estado_orcamento',
        'servicos.nome as servico_nome',
        'servicos.preco as servico_preco',
        DB::raw('COALESCE(JSON_ARRAYAGG(JSON_OBJECT("nome", taxas.nome, "total", taxas.total)), JSON_ARRAY()) as taxes')
    )
    ->groupBy('orcamentos.id', 'servicos.id', 'users.id', 'pagamentos.id') 
    ->orderBy('orcamentos.id', 'desc') 
    ->get();
        return view('dashboard', compact('orcamentos'));
    }

    public function indexFunc()
    {
        $users = User::where('tipo', '!=', 'Cliente')->get();
        return view('dash_pages.employe', compact('users'));
    }
    

    public function store(Request $request)
    {
        try {
           $data = $request->all();
            $user = new User();
            $user->nome = $data['nome'];
            $user->email = $data['email'];
            $user->password = Hash::make($data['password']);
            $user->documento_identificacao = $this->uploadFile($request,'identity','document');
            $user->tipo = $data['tipo'];
            $user->save();
            return redirect()->back()->with('success','Registro Feito com sucesso');
        } catch (\Throwable $th) {
            return back()->with('error','Ops! Algo deu errado '.$th->getMessage());
        }
    }

    public function uploadFile($request, $file,$name)
    {
        $userFolder = $file;
        $folderPath = "uploads/{$userFolder}/{$name}";
        $fileName = time().'.'.$request->$name->extension();

        $request->$name->move(public_path($folderPath), $fileName);

        $fullpath = "$folderPath/$fileName";
        return $fullpath;
    }

    public function show(string $id)
    {
        $user = User::find($id);
        $orcamentos = DB::table('orcamentos')
        ->join('servicos', 'orcamentos.id_servico', '=', 'servicos.id')
        ->join('users', 'users.id', '=', 'orcamentos.id_cliente')
        ->leftJoin('taxas_registradas', 'servicos.id', '=', 'taxas_registradas.id_servicos')
        ->leftJoin('taxas', 'taxas_registradas.id_taxa', '=', 'taxas.id')
        ->select(
            'orcamentos.*',
            'servicos.nome as servico_nome',
            'servicos.preco as servico_preco',
            DB::raw('COALESCE(JSON_ARRAYAGG(JSON_OBJECT("nome", taxas.nome, "total", taxas.total)), JSON_ARRAY()) as taxes')
        )
        ->where('users.id','=',$id)
        ->groupBy('orcamentos.id', 'servicos.id') 
        ->get();    
        
        $servicos = DB::table('servicos')
        ->leftJoin('taxas_registradas', 'servicos.id', '=', 'taxas_registradas.id_servicos')
        ->leftJoin('taxas', 'taxas_registradas.id_taxa', '=', 'taxas.id')
        ->select(
            'servicos.*',
            DB::raw('JSON_ARRAYAGG(JSON_OBJECT("nome", taxas.nome, "total", taxas.total)) as taxes')
        )
        ->groupBy('servicos.id')
        ->get();

        if (!$user) {
            return back()->with('error','Usuário não existe');
        }
        return view('dash_pages.customers_details',compact('user','servicos','orcamentos'));
    }


    public function update(Request $request, string $id)
    {
        try {
            $data = $request->all();
            $user = User::findOrFail($id);
            $user->update($data);
            if ($user->id == auth()->user()->id && isset($request->status) && $request->status == 'cancelado') {
                Auth::logout();
                return redirect('/')->with('success', 'Sua conta foi cancelada. Você foi desconectado.');
            }
            return redirect()->back()->with('success', 'Registro atualizado com sucesso');
        } catch (\Throwable $th) {
            return back()->with('error', 'Ops! Algo deu errado: ' . $th->getMessage());
        }
    }
    

    public function destroy(string $id)
    {
        try {
            $user = User::findOrFail($id);
            $user->delete();
            return redirect()->back()->with('success','Registro deletado com sucesso');
           } catch (\Throwable $th) {
            return back()->with('error','Ops! Algo deu errado '.$th);
           }
    }

    public function updatePassword(Request $request)
    {
        $validator = $request->validate([
            'new_password' => 'required|string',
            'old_password' => 'required|string',
        ]);
        $user_id = auth()->user()->id;
        $user = User::find($user_id);

        if (!Hash::check($request->old_password, $user->password)) {
            return back()->with('error' , 'Senha antiga incorreta.');
        }
        $user->password = Hash::make($request->new_password);
        $user->save();
        return redirect()->back()->with('success' , 'Senha atualizada com sucesso.');
    }


}
