<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use App\Descuento;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class DescuentoController extends Controller
{
    public function show()
    {
        $descuento=DB::table('descuento')
        ->select('*')
        ->paginate(10);
        // return response()->json($descuento);
        return view('descuento.mostrar')->with('descuento',$descuento);;
    }

    public function showFiltrado(Request $request)
    {
        $descuento=DB::table('descuento')
        ->whereBetween('fecha_inicio', [$request->get('fecha_inicio'),$request->get('fecha_final')])
        ->whereBetween('fecha_final', [$request->get('fecha_inicio'),$request->get('fecha_final')])
        ->select('*')->paginate(10);

        /*$descuento=\DB::select("SELECT id,descripcion FROM descuento WHERE fecha_inicio BETWEEN $request->get('fecha_inicio') 
        AND $request->get('fecha_final') AND fecha_final BETWEEN $request->get('fecha_inicio') AND 
        $request->get('fecha_final')")->paginate(10);*/
        return view('descuento.mostrar')->with('descuento',$descuento);
    }

    public function store(Request $request)
    {
        $dataDescuento=$request->all();
        //$dataDescuento=$request->except('_token');
        //$dataDescuento=$request->except('ISBN');
        Descuento::insert($dataDescuento);
        
        /*\DB::insert("INSERT INTO descuento(idDescuento,fecha_inicio, fecha_final, porcentaje, descripcion, idtipo_descuento, ISBN) 
        VALUES (0,$request->get('fecha_inicio'),$request->get('fecha_final'),$request->get('porcentaje'),
        $request->get('descripcion'),$request->get('idtipo_descuento'),$request->get('ISBN'))");*/

        /*$data=\DB::select("SELECT idDescuento FROM descuento ORDER BY idDescuento DESC LIMIT 1");
        $ISBN=$request->get('ISBN');
        $IDd=$data[0]->idDescuento;
        
        \DB::insert("INSERT INTO libroxdescuento (ISBN, idDescuento) VALUES ($ISBN,$IDd)");*/

        /*\DB::table('libroxdescuento')
        ->update([
            'ISBN' => $ISBN,
            'idDescuento' => $IDd[0]->idDescuento
        ]);*/
        $descuento=DB::table('descuento')
        ->select('*')
        ->paginate(10);
       // return response()->json($descuento);
        return view('descuento/mostrar')->with('descuento',$descuento);;  
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
            $data["fecha_inicio"]=$d->fecha_inicio;
            $data["fecha_final"]=$d->fecha_final;
            $data["porcentaje"]=$d->porcentaje;
            $data["descripcion"]=$d->descripcion;
            $data["idtipo_descuento"]=$d->idtipo_descuento;
        }   
        //return response()->json($data);
        return view('descuento.modificar')->with('data',$data); 
    }

    public function modificarAlta (Request $request){

        /*\DB::table('descuento')
        ->where('idDescuento', $request->get('idDescuento'))
        ->update([
            'fecha_inicio' => $request->get('fecha_inicio'),
            'fecha_final' => $request->get('fecha_final'),
            'porcentaje' => $request->get('porcentaje'),
            'descripcion' => $request->get('descripcion'),
            'idtipo_descuento' => $request->get('idtipo_descuento'),
            'ISBN' => $request->get('ISBN')
        ]);*/

         
        DB::table('descuento')
        ->where ('idDescuento',$request->get('idDescuento'))
        ->update([
            'fecha_inicio' => $request->get('fecha_inicio'), 
            'fecha_final' => $request->get('fecha_final'), 
            'porcentaje'=>$request->get('porcentaje'),
            'descripcion'=>$request->get('descripcion'),
            'idtipo_descuento'=>$request->get('idtipo_descuento')
        ]);
        
        $descuento=DB::table('descuento')
        ->select('*')
        ->paginate(10);
       // return response()->json($descuento);
        //return view('descuento/mostrar')->with('descuento',$descuento);
        //return View::make('descuento/mostrar')->with('descuento',$descuento);
        return redirect('descuento')->with('descuento',$descuento);
    }

    public function buscarDes(Request $request){
        $dataDescuento=$request->all();
        $descuento=DB::table('descuento')->select('*')
        ->where('idDescuento', '=', $dataDescuento)->get();
        return $descuento;
    }

    public function buscarLibros(Request $request){

        $titulo=trim($request->get('titulo'));
        $autor=trim($request->get('autor'));
        $editorial=trim($request->get('editorial'));

        $validos=collect();
        if(!(empty($titulo))){
            $validos->put('titulo',$titulo);
        }
        if(!(empty($autor))){
            $validos->put('autor',$autor);
        }
        if(!(empty($editorial))){
            $validos->put('editorial',$editorial);
        }

        $cant=$validos->count();
        $keys=$validos->keys();

        $sql="SELECT ISBN,titulo,autor,editorial From libro WHERE ";
        for ($i = 0; $i < $cant; $i++){
            $sql=$sql.$keys[$i].' LIKE "%'.$validos->get($keys[$i]).'%"';
            if($i+1 < $cant){
                $sql=$sql." OR ";
            }
        }
        
        $libros=DB::select($sql);

        return $libros;
    }

    public function vistaRegistrarDescuento (){
        $data['tipoDescuento']=DB::table('tipo_descuento')->select('*')->get();
        
        return view('descuento.altaDescuento')->with('data',$data);
    }

    public function update(Request $request, Descuento $descuento)
    {

    }

    public function destroy($ID)
    {
        DB::table('descuento')->where('idDescuento', '=', $ID)->delete();
        return back();
    }
}