<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithCalculatedFormulas;
use App\Exports\LibroExport;
use App\Imports\LibroImport;

class ExelController extends Controller
{
    public function exportar()
    {
        return Excel::download(new LibroExport, 'Libros.xlsx');   
    }

    public function show()
    {
        return view('funcionesExel/mainExelFunction');
    }

    public function ayuda()
    {
        return view('funcionesExel/comoPrepararExel');
    }

    public function test(Request $request){
        $id=\DB::select("SELECT COUNT(*) AS cant FROM libro WHERE ISBN=\"".$request->get('ISBN')."\"");
        foreach($id as $i){
            $data=$i->cant;
        } 
        $rta="El ISBN no existe";
        if($data>0){
            $rta="El ISBN existe";
        }
        return $rta;
    }

    public function importar(Request $request)
    {
        $file= $request->file('exelLibro');

        Excel::import(new LibroImport, $file);
        return back()->with('mensaje','Importacion completada con exito');
    }
}
