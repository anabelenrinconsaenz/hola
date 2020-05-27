<?php

namespace App\Http\Controllers;

use App\Libro;
use App\Cliente;
use App\Descuento;
use App\Venta;
use Illuminate\Http\Request;



use App\Http\Controllers\DB;

use App\LibroxVenta;
use App\Talonario;

class VentaController extends Controller
{
    private $reciboActual;
    private $talonarioActual; 
    private $reciboFin;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() //NUEVA VENTA
    {
        $datos['libros']=Libro::all();

        $cliente['datos']=Cliente::paginate();
        
        $descuentos['descuentos']=Descuento::paginate();


        return view('altaVentas')->with($datos)->with($cliente)->with($descuentos);
    }




public function Ventas(){//TODAS LAS VENTAS

    //$totalVentas['totalVentas']=Venta::all();
$totalVentas=Venta::orderBy('idVenta','DESC')->paginate(7);
  $totalLibroxVenta=LibroxVenta::all();
    $descuentos=Descuento::all();


    $clientes=Cliente::all();




  return view('Ventas',compact('totalVentas','totalLibroxVenta','descuentos','clientes'));

}




//BORRAR VENTA
public function eliminarVenta(Request $request){
        
  
  
        $idVenta=$request->idVenta;
          
        $libroxventa=LibroxVenta::where('idVenta',$idVenta)->first(); 
        $venta=Venta::where('idVenta',$idVenta)->first();
  
        if($libroxventa) {
          $libroxventa->delete();
          }
          
          if($venta) {
              $venta->delete();
          }
                  
          return "Venta Eliminada!";

  
  
      
}






public function modificarVenta(Request $request){

   $evento=$request->evento;//YA NO SERIA NECESARIO EL EVENTO

    if($evento=="MODIFICAR_VENTA"){ //CARGO LOS DATOS EN EL FORMULARIO
      /*####*/

      $idVenta=$request->idVenta;
      $libroxventa=LibroxVenta::where('idVenta',$idVenta)->get();
      $venta=Venta::where('idVenta',$idVenta)->get(); 
      $descuentos=Descuento::all();
      $libros=Libro::all();


     return view('ModificarVenta', [
        'libroxventa' => $libroxventa,
        'venta' => $venta,
        'descuentos' => $descuentos,
        'libros' => $libros
    ]);

    }
    
    

}





public function updateVenta(Request $request){ //MODIFICO VENTAS

        //VENTA

        //calculo el nuevo total
        $dni= $request->get('dni_cuit');

        $cliente=Cliente::where('dni_cuit',$dni)->get();

        $subtotal;
        $total=0;

                foreach ($request->ISBN as $key => $id){
                
                    $idDescuento=$request->IdDescuento[$key];
                    $idDescuento=Descuento::where('idDescuento',$idDescuento)->first();
                    $subtotal=$request->precio_unitario[$key]*$request->cantidad[$key];
                    $total=$total+((100-$idDescuento->porcentaje)*$subtotal)/100;


                    $antesVentas=LibroxVenta::where('ISBN',$id)->first();

                    $diferencia=$antesVentas->cant-$request->cantidad[$key];

                    if($diferencia!=0){ //SI ES CERO PUEDE SER QUE NO HAYA QUERIDO HACER CAMBIOS, O QUE EL LIBRO YA NO EXISTA Y NO SE LE HAYA PERMITIDO HACERLOS


                            //MODIFICO LAS CANTIDADES DE LIBROS VENDIDAS (CANT_VENTAS)

                            $antes=Libro::where('ISBN',$id)->first();

                            if($antesVentas->cant>=$request->cantidad[$key]){//VENDI MENOS QUE ANTES

                            $diferencia=$antesVentas->cant-$request->cantidad[$key];
                            $cant_venta=$antes->cant_venta-$diferencia;//CANTIDAD VENDIDA

                            $cant_deposito=$antes->cant_deposito+$diferencia;//CANTIDAD QUE ME QUEDA EN DEPOSITO
                            }

                        if($antesVentas->cant<$request->cantidad[$key]){//VENDI MAYOR CANTIDAD QUE ANTES
                        
                                        $diferencia=$request->cantidad[$key]-$antesVentas->cant;

                                    $cant_venta=$antes->cant_venta+$diferencia;//CANTIDAD VENDIDA

                                    $cant_deposito=$antes->cant_deposito-$diferencia;//CANTIDAD QUE ME QUEDA EN DEPOSITO
                            }

                                \DB::table('libro')
                                ->where('ISBN', $id)
                                ->update([
                                'cant_venta' =>$cant_venta,
                                'cant_deposito' => $cant_deposito
                                ]);

                    }

                }
                

        //TABLA VENTA
        \DB::table('venta')
        ->where('idVenta', $request->get('idVenta'))->update([
                    'idVenta' => $request->get('idVenta'),
                    'fecha' => $request->get('fecha'),
                    'condicion' => $request->get('condicion'),
                    'lugar' => $request->get('domicilio'),
                    'Cliente_dni_cuit' => $request->get('dni_cuit'),
                    'total' => $total

                ]);
                


        //LIBRO X VENTA
                foreach ($request->ISBN as $key => $id) 
                {
                    \DB::table('libroxventa')
                    ->where('ISBN', $id)
                    ->where('idVenta', $request->get('idVenta'))
                    ->update([
                    'cant' => $request->cantidad[$key],
                    'IdDescuento' => $request->IdDescuento[$key],
                    'precio_unitario' => $request->precio_unitario[$key]
                    ]);




                


                }

        return redirect('/todasVentas');


}

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('crearVentas');

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
     * @param  \App\Venta  $venta
     * @return \Illuminate\Http\Response
     */
    public function show(Venta $venta)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Venta  $venta
     * @return \Illuminate\Http\Response
     */
    public function edit(Venta $venta)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Venta  $venta
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Venta $venta)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Venta  $venta
     * @return \Illuminate\Http\Response
     */
    public function imprimir(Request $request)
    {
       //return response()->json($request->get('telefono'));
        $data = [
            'id_recibo' => $request->get('id_recibo'),
            'id_talonario' => $request->get('id_talonario'),
            'fecha' => $request->get('fecha'),
            'nombre' => $request->get('nombre'),
            'dni_cuit' => $request->get('dni'),
            'domicilio' => $request->get('domicilio'),
            'telefono' => $request->get('telefono'),
            'email' => $request->get('email'),
            'titulo' => $request->get('titulo'),
            'cantidad' => $request->get('cantidad'),
            'precio_unitario' => $request->get('precio_unitario'),
            'total' => $request->get('total'),
            'subtotal' => $request->get('sub_total'),
        ];
        
        //inserto en la bd id_recibo	
        \DB::table('recibo')->insert(
            ['id_recibo' => $request->get('id_recibo'), //sacarle el incremental o no se
            'idVenta' => $request->get('idVenta'), 
            'talonario_id_talonario' => $request->get('id_talonario'), 
            'fecha'=> $request->get('fecha'),
            ]);
    
        $pdf = \PDF::loadView('ejemplo',compact('data'));
        return $pdf->download('ejemplo.pdf');
    }



    public function insertVenta(Request $request)
    {
        //inicializarTalonario
        if(Talonario::all()->count()==1){
            $talonario=Talonario::all();
            foreach($talonario as $tal){
                \DB::table('talonario')
                    ->where('id_talonario',$tal->id_talonario)
                    ->update([
                        'id_talonario' => $tal->id_talonario,
                        'nro_inicio' => $tal->nro_inicio,
                        'nro_fin' => $tal->nro_fin,
                        'estado' => '1',
                        'nro_actual' =>$tal->nro_actual
                    ]);
            }
        }
     
        //INSERTO VENTA
        $nuevaVenta = new Venta();
        $nuevaVenta->fecha=$request->fecha;
        $nuevaVenta->condicion=$request->condicion;
        $nuevaVenta->lugar=$request->lugar;
        $nuevaVenta->Cliente_dni_cuit=$request->dni;

        //calculo el total de la venta
        $subtotal;
        $total=0;
        if($request->id_tipo_cliente==1){ //GENERAL
            foreach ($request->PRECIO_GENERALtabla as $i => $precio) {
                    $idDescuento=$request->idDescuento[$i];
                    $idDescuento=Descuento::where('idDescuento',$idDescuento)->first();
                    $subtotal=$precio*$request->CANTIDADtabla[$i];
                    $total=$total+((100-$idDescuento->porcentaje)*$subtotal)/100;
            }
        }else if($request->id_tipo_cliente==2){ //ESTUDIANTE
            foreach ($request->PRECIO_ESTUDIANTEtabla as $i => $precio) {
                    $idDescuento=$request->idDescuento[$i];
                    $idDescuento=Descuento::where('idDescuento',$idDescuento)->first();
                    $subtotal=$precio*$request->CANTIDADtabla[$i];
                    $total=$total+((100-$idDescuento->porcentaje)*$subtotal)/100;
            }
        }else if($request->id_tipo_cliente==3){ //DOCENTE
            foreach ($request->PRECIO_DOCENTEtabla as $i => $precio) {
                    $idDescuento=$request->idDescuento[$i];
                    $idDescuento=Descuento::where('idDescuento',$idDescuento)->first();
                    $subtotal=$precio*$request->CANTIDADtabla[$i];
                    $total=$total+((100-$idDescuento->porcentaje)*$subtotal)/100;
            }
        }

        //INSERTO EN TABLA VENTA

       $idVenta = \DB::table('venta')->insertGetId(
        ['fecha' => $nuevaVenta->fecha, 
        'condicion' => $nuevaVenta->condicion, 
        'lugar' => $nuevaVenta->lugar, 
        'Cliente_dni_cuit' => $nuevaVenta->Cliente_dni_cuit,
        'total' => $total

        ]);

       
        //INSERTO LIBRO X VENTA
        $i=0;
        foreach ($request->ISBNtabla as $key => $id) 
        {
            
            $libro = new LibroxVenta();
            $libro->ISBN=$id;
            $libro->idVenta=$idVenta;
            $libro->cant=$request->CANTIDADtabla[$key];

            //PRECIO_UNITARIO
            if($request->id_tipo_cliente==1){ //GENERAL
                $libro->precio_unitario=$request->PRECIO_GENERALtabla[$key];
            }else if($request->id_tipo_cliente==2){ //ESTUDIANTE
                $libro->precio_unitario=$request->PRECIO_ESTUDIANTEtabla[$key];

            }else if($request->id_tipo_cliente==3){ //DOCENTE
                $libro->precio_unitario=$request->PRECIO_DOCENTEtabla[$key];

            }



            \DB::table('libroxventa')->insert(
            ['ISBN' => $libro->ISBN, 
            'idVenta' => $libro->idVenta, 
            'cant' => $libro->cant, 
            'IdDescuento' => $request->idDescuento[$key], 
            'precio_unitario' => $libro->precio_unitario,
            'titulo' => $request->TITULOtabla[$key]
            ]);


            //ana
            $titulo=\DB::table('libro')->select('titulo')->where("ISBN","=",$libro->ISBN)->get();
            $info[$i]["ISBN"]=$id;
            $info[$i]["titulo"]=$titulo;
            $info[$i]["cantidad"]=$request->CANTIDADtabla[$key];
            $info[$i]["precio_unitario"]= $libro->precio_unitario;
            $i++;
            //ana
            //MODIFICO LAS CANTIDADES DE LIBROS VENDIDAS (CANT_VENTAS)

            $antes=Libro::where('ISBN',$id)->first();
            $cant_venta=$antes->cant_venta+$libro->cant;//CANTIDAD VENDIDA

            $cant_deposito=$antes->cant_deposito-$libro->cant;//CANTIDAD QUE ME QUEDA EN DEPOSITO
            $sub_total=$libro->precio_unitario*$request->CANTIDADtabla[$key];//ESTO ES PARA TENER EL SUBTOTAL(CNAT*PRECIO UNITARIO)
            \DB::table('libro')
            ->where('ISBN', $id)
            ->update([
            'cant_venta' =>$cant_venta,
            'cant_deposito' => $cant_deposito
            ]);
        

        }
        $idVenta=\DB::table('venta')->select('idVenta')->get()->last();
        //ana   //numero de recibo corresponda y talonario,pasar id venta
        //incrementar numero, control si no talonario nuevo.
        //return response()->json();
        $flag=false;
        $talonario=\DB::table('talonario')->select('*')->where('estado','=','1')->get();
        foreach($talonario as $tal){
            
            if($tal->nro_actual< $tal->nro_fin){
                
                \DB::table('talonario')
                ->where('id_talonario',$tal->id_talonario)
                ->update([
                    'id_talonario' => $tal->id_talonario,
                    'nro_inicio' => $tal->nro_inicio,
                    'nro_fin' => $tal->nro_fin,
                    'estado' => '1',
                    'nro_actual' =>$tal->nro_actual+1 //ver
                ]);
                $flag=false;
            }
            else{
                //cambio el estado del talonario actual 
                \DB::table('talonario')
                ->where('id_talonario',$tal->id_talonario)
                ->update([
                    'id_talonario' => $tal->id_talonario,
                    'nro_inicio' => $tal->nro_inicio,
                    'nro_fin' => $tal->nro_fin,
                    'estado' => '0',
                    'nro_actual' =>$tal->nro_actual 
                ]);
                //nuevo talonario 
                $flag=true;
            }
        }
        if($flag=true){
            $talo=\DB::table('talonario')->select('*')->get()->last();
            
                \DB::table('talonario')
                ->where('id_talonario',$talo->id_talonario)
                ->update([
                    'id_talonario' => $talo->id_talonario,
                    'nro_inicio' => $talo->nro_inicio,
                    'nro_fin' => $talo->nro_fin,
                    'estado' => '1',
                    'nro_actual' =>$talo->nro_actual 
                ]);
            
        }
        $numero=\DB::table('talonario')->select('*')->where('estado','=','1')->get();
        
       
        $cliente=\DB::table('cliente')->select('*')->where("dni_cuit","=",$nuevaVenta->Cliente_dni_cuit)->get();
        return view('recibo.alta')->with('numero',$numero)->with('nuevaVenta',$nuevaVenta)->with('info',$info)->with('cliente',$cliente)->with('total',$total)->with('sub_total',$sub_total)->with('idVenta',$idVenta);   
        //ana
    

    }


    public function buscadorTodasVentas(Request $request){
    
      
        $totalVentas=Venta::orderBy('idVenta','DESC')->paginate(7);

    
        $totalLibroxVenta=LibroxVenta::all();
        $descuentos=Descuento::all();


        $clientes=Cliente::all();

      

        return view('TodasVentasAJAX',compact('totalVentas','totalLibroxVenta','descuentos','clientes'));

    }

  



    public function buscadorClientexventa(Request $request){
        $totalVentas=Venta::all();

        $totalLibroxVenta=LibroxVenta::all();
        $descuentos=Descuento::all();


        $clientes=Cliente::where("nombre_apellido","like","%".$request->texto."%")->take(2)->get();
        //$totalVentas=Venta::orderBy('idVenta','DESC')->paginate(7);

        //return view("paginaprincipal",compact('totalLibros'));

        return view('paginasClientexVentas',compact('totalVentas','totalLibroxVenta','descuentos','clientes'));

        
    }











}