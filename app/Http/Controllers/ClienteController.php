<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Cliente;
use App\Libro;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use App\Tipo_cliente;
use App\Tipo_facultad;
use App\Http\Controllers\Exception;
class ClienteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
   /* public function index()
    {
        return view('welcome');
    }*/

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
   

//VENTAS

//BUSCADOR DE CLIENTE 
public function buscadorCliente(Request $request){
    $clientesAJAX=Cliente::where("nombre_apellido","like","%".$request->texto."%")->take(2)->get();
    return view("paginasCliente",compact("clientesAJAX"));
}




    public function index()
    {
      
        $datos['clientes']=Cliente::paginate();
        
        return view("ClientesAJAX",$datos);



    }
    


    //





    public function create()
    {
        $tipoCliente=Tipo_cliente::all();
        $tipoFacultad=Tipo_facultad::all();
        
        return view('cliente.create')->with('Tipo_cliente',$tipoCliente)->with('Tipo_facultad',$tipoFacultad);
      
    }
    public function modificarSeleccionado(Request $request, $cli)
    {
        
        $cliente=DB::table('cliente')->select('dni_cuit','nombre_apellido','domicilio','telefono','email')->where('nombre_apellido','=',$cli)->get();
        return view('cliente.modificar',compact('cliente'));
        //return response()->json($cli);
    }
    public function change(Request $request){
        $request->all();
        DB::table('cliente')
        ->where('nombre_apellido', $request->get('nombre_apellido'))
        ->update([
        'dni_cuit' => $request->get('dni_cuit'),
        'nombre_apellido' => $request->get('nombre_apellido'),
        'telefono'=>$request->get('telefono'),
        'domicilio'=>$request->get('domicilio'),
        'email'=>$request->get('email')
        ]);
        
        return view('cliente.confirmacionAlta');
       //return response()->json($request);
    }
    public function alta( Request $request )
    {
        $datosCliente=request()->all();
        Cliente::insert($datosCliente);
        return view('cliente.confirmacionAlta');
    }
    public function modificar(Request $request,$dni_cuit){

        Cliente::find($dni_cuit)->update($request->all());
        //return view( 'cliente.confirmacionUpdate');
        return redirect('cliente');
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function show()
    {

        //$clientes=DB::table('cliente')
        $clientes=Cliente::orderBy('nombre_apellido','ASC')
        ->select('*')
        ->join('tipo_cliente', 'tipo_cliente.id_tipo_cliente', '=', 'cliente.id_tipo_cliente')
        ->join('tipo_facultad', 'tipo_facultad.id_tipo_facultad', '=', 'cliente.id_tipo_facultad')
        ->paginate(10);
    
        return view('cliente.show')->with('clientes',$clientes);
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Cliente  $cliente
     * @return \Illuminate\Http\Response
     */
  
    public function buscar (Request $request)
    {
        $cliente=Cliente::where("nombre_apellido","like","%".$request->text."%")->get();
        return view('cliente/buscado',compact('cliente'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, string $cliente)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function destroy(Cliente $cliente)
    {
        //
    }
    public function modificacion(Request $request)
    {
        DB::table('cliente')
        ->where ('dni_cuit',$request->get('dni_cuit'))
        ->update(
            ['nombre_apellido' => $request->get('nombre_apellido'), 'domicilio' => $request->get('domicilio'), 'telefono'=>$request->get('telefono'),'email'=>$request->get('email'),'id_tipo_cliente'=>$request->get('id_tipo_cliente'),'id_tipo_facultad'=>$request->get('id_tipo_facultad')]
        );
        return redirect('cliente');
    }
    public function edit($id)
    {
       
        $clientes=DB::table('cliente')
        ->join('tipo_cliente', 'tipo_cliente.id_tipo_cliente', '=', 'cliente.id_tipo_cliente')
        ->join('tipo_facultad', 'tipo_facultad.id_tipo_facultad', '=', 'cliente.id_tipo_facultad')
        ->select('*')
        ->where('cliente.dni_cuit', '=',$id)
        ->get();
        $tipoCliente=Tipo_cliente::all();
        $tipoFacultad=Tipo_facultad::all();
        return view('cliente.edit')->with('clientes',$clientes)->with('Tipo_cliente',$tipoCliente)->with('Tipo_facultad',$tipoFacultad);
    }
}
