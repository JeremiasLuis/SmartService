<?php

namespace App\Http\Controllers\systemControllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Servico;
use App\Models\Taxa;
use App\Models\TaxaRegistrada;
use Illuminate\Support\Facades\DB;

class ServiceController extends Controller
{
  
    public function index()
    {
        $services = DB::table('servicos')
        ->leftJoin('taxas_registradas', 'servicos.id', '=', 'taxas_registradas.id_servicos')
        ->leftJoin('taxas', 'taxas_registradas.id_taxa', '=', 'taxas.id')
        ->select(
            'servicos.*',
            DB::raw('JSON_ARRAYAGG(JSON_OBJECT("nome", taxas.nome, "total", taxas.total)) as taxes')
        )
        ->groupBy('servicos.id')
        ->orderBy('servicos.id', 'desc') 
        ->get();
    
        $taxas = Taxa::all();
        return view('dash_pages.services',compact('services','taxas'));
    }
    public function pricing()
    {
        $services = DB::table('servicos')
        ->leftJoin('taxas_registradas', 'servicos.id', '=', 'taxas_registradas.id_servicos')
        ->leftJoin('taxas', 'taxas_registradas.id_taxa', '=', 'taxas.id')
        ->select(
            'servicos.*',
            DB::raw('JSON_ARRAYAGG(JSON_OBJECT("nome", taxas.nome, "total", taxas.total)) as taxes')
        )
        ->groupBy('servicos.id')
        ->orderBy('servicos.id', 'desc') 
        ->get();
    
        $taxas = Taxa::all();
        return view('pricing',compact('services','taxas'));
    }

    
    public function store(Request $request)
    {
        DB::beginTransaction();
        try {
            $data = $request->all();
            $data['imagem'] = $this->uploadFile($request, 'image', 'document');
            $servicos = Servico::create($data);
           
            if (isset($data['taxas'])) {
                foreach ($data['taxas'] as $taxaId) {
                    $taxa = new TaxaRegistrada();
                    $taxa->id_taxa = $taxaId;
                    $taxa->id_servicos = $servicos->id;
                    $taxa->save(); 
                }
            }
            DB::commit();
            return redirect()->back()->with('success', 'Serviço adicionado com sucesso');
        } catch (\Throwable $th) {
            DB::rollback();
            return back()->with('error', 'Ops! Algo deu errado: ' . $th->getMessage());
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

    public function update(Request $request, string $id)
    {
        try {
            $service = Servico::find($id);
            $data = $request->all();
            if(hash_file($request)){
                $data['imagem'] = $this->uploadFile($request,'image','document');
            }
            $service->update($data);
            return redirect()->back()->with('success','Serviço Actualizado com sucesso');
           } catch (\Throwable $th) {
           return back()->with('error','Ops! Algo deu errado '.$th);
           }
    }

    public function destroy(string $id)
    {
        try {
            $service = Servico::find($id);
            $service->delete();
            return redirect()->back()->with('success','Serviço deletado com sucesso');
           } catch (\Throwable $th) {
           return back()->with('error','Ops! Algo deu errado '.$th);
           }
    }
}
