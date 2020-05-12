<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use App\Descuento;
use App\Talonario;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class TalonarioController extends Controller
{
    public function show()
    {
        $tal=Talonario::all();
     
        return view('talonarios')->with('talonario',$tal);;
    }

    
    public function store()
    {
        return view('altaTalonario'); 
    }

    public function create()
    {
        $tipoDescuento=DB::table('tipo_descuento')->select('*')->get();
        return view('descuento.crear')->with('tipoDescuento',$tipoDescuento);
        //return view('descuento.crear');
       
    }

    public function modificar($ID)
    {
        /*$data['tipoDescuento']=DB::table('tipo_descuento')->select('*')->get();
        $data['descuento']=DB::table('descuento')->where('idDescuento', $ID)->select('*')->get();
        return view('descuento.modificar')->with('data',$data); */ 

        $descuento=DB::table('descuento')->where('idDescuento', $ID)->select('*')->get();
        //$datos=DB::table('libro')->where('ISBN', $isbn)->select('cant_deposito','cant_venta')->get();
        foreach($descuento as $d){
            $data["idDescuento"]=$d->idDescuento;
            $data["ISBN"]=$d->ISBN;
            $data["fecha_inicio"]=$d->fecha_inicio;
            $data["fecha_final"]=$d->fecha_final;
            $data["porcentaje"]=$d->porcentaje;
            $data["descripcion"]=$d->descripcion;
        }   
        //return response()->json($data);
        return view('descuento.modificar')->with('data',$data); 
    }

    public function modificarAlta (Request $request){

    }

    public function buscarDes(Request $request){
       
    }

    public function buscarLibros(Request $request){

    }

    public function vistaRegistrarDescuento ($ID){
       
    }

    public function update(Request $request, Descuento $descuento)
    {

    }

    public function destroy($ID)
    {
        
    }
}