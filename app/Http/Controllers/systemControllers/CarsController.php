<?php

namespace App\Http\Controllers\systemControllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Viatura;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class CarsController extends Controller
{
    
    //READ
    public function index(Request $request)
    { $user_status = auth()->user()->tipo;
        $cars = 0;
        
        if($user_status == 'Cliente') {
        $cars = DB::table('viaturas')
        ->join('users', 'users.id', '=', 'viaturas.id_cliente')
        ->select('viaturas.*','users.nome as cliente')
        ->where('users.id','=',auth()->user()->id)
        ->orderBy('viaturas.id', 'desc') 
        ->get();
        }else{
            $cars = DB::table('viaturas')
        ->join('users', 'users.id', '=', 'viaturas.id_cliente')
        ->select('viaturas.*','users.nome as cliente')
        ->orderBy('viaturas.id', 'desc') 
        ->get(); 
        }
        $users = User::where('tipo','=','cliente')->get();
        $ip = $request->ip();
       return view('dash_pages.cars',compact('cars','users','ip'));
    }

    //CREATE - Para registar
    public function store(Request $request)
    {
      try {
        $data = $request->all();
        $data['codigo_validacao'] = rand(999999,111111);
        Viatura::create($data);
        return redirect()->to(url('/customers/customers-details/' . $data['id_cliente']))->with('success', 'Viatura salva com sucesso');
         } catch (\Throwable $th) {
        return back()->with('error','Ops! Algo deu errado '.$th);
      }
    }


    // UPDATE - Para actualizar
    public function update(Request $request, string $id)
    {
        try {
            $car = Viatura::find($id);
    
            if (!$car) {
                return back()->with('error', 'Viatura não encontrada.');
            }
            $data = $request->all();
            $codigoValidacaoInput = $request->input('codigo_validacao');
            $senhaInput = $request->input('senha');
            if ($codigoValidacaoInput !== $car->codigo_validacao) {
                return back()->with('error', 'Código de validação incorreto.');
            }
            $funcionario = Auth::user(); 
            if (!Hash::check($senhaInput, $funcionario->password)) {
                return back()->with('error', 'Senha incorreta.');
            }
            $car->update($data);
            return redirect()->back()->with('success', 'Viatura atualizada com sucesso.');
        } catch (\Throwable $th) {
            return back()->with('error', 'Ops! Algo deu errado ' . $th->getMessage());
        }
    }
    
    // Tela de redirecionamento, após leitura de qrcode
    public function show($id)
    {
    $viatura = Viatura::find($id);
    return view('qrCode.show',compact('viatura'));
    }

    //Deletar viatura
   
    public function destroy(string $id)
    {
        try {
            $car = Viatura::find($id);
            $car->delete();
            return redirect()->back()->with('success','Viatura deletada com sucesso');
          } catch (\Throwable $th) {
            return back()->with('error','Ops! Algo deu errado '.$th);
          }
    }
}
