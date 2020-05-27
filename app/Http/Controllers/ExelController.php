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
        ini_set('memory_limit', '-1');
        $file= $request->file('exelLibro'); 

        \DB::table('libro')->where('ISBN', '=', 'auxghostybook')->delete();
        \DB::table('libro')->insert(['ISBN' => 'auxghostybook']);
        Excel::import(new LibroImport, $file);
        \DB::table('libro')->where('ISBN', '=', 'auxghostybook')->delete();
        
        return back()->with('mensaje','Importacion completada con exito');
    }

    /*public function importar(Request $request)
    {
        $path= $request->file('exelLibro')->getRealPath();
        $data= Excel::load($path)->get();

        if($data->count() > 0){
            foreach($data->toArray() as $key => $value){
                foreach( $value as $row){
                    $test=$row['B'];
                }
            }
        }
        return $test;
        //return back()->with('mensaje','Importacion completada con exito');
    }*/   
}