<?php

namespace App\Http\Controllers;

use App\Libro;
use App\Cliente;
use App\Descuento;
use App\Venta;
use Illuminate\Http\Request;





use App\LibroxVenta;


class VentaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() //NUEVA VENTA
    {
        $datos['libros']=Libro::paginate();

        $cliente['datos']=Cliente::paginate();
        
        $descuentos['descuentos']=Descuento::paginate();


        return view('altaVentas')->with($datos)->with($cliente)->with($descuentos);
    }




public function Ventas(){//TODAS LAS VENTAS

    $totalVentas['totalVentas']=Venta::all();

    $totalLibroxVenta['totalLibroxVenta']=LibroxVenta::all();
    $Descuentos['descuentos']=Descuento::all();

    $Libros['libros']=Libro::all();



    return view('Ventas')->with($totalVentas)->with($totalLibroxVenta)->with($Descuentos)->with($Libros);

}




//BORRAR VENTA


//RECIBO UN DATO ADICIONAL QUE INDICA EL EVENTO A REALIZAR
public function deleteVenta(Request $request){

   $evento=$request->evento;

    if($evento=="MODIFICAR_VENTA"){ //CARGO LOS DATOS EN EL FORMULARIO
      /*####*/

      $idVenta=$request->idVenta;
      $libroxventa=LibroxVenta::where('idVenta',$idVenta)->get();
      $venta=Venta::where('idVenta',$idVenta)->get(); 


     return view('ModificarVenta', [
        'libroxventa' => $libroxventa,
        'venta' => $venta
    ]);

    }
    
    if($evento=="ELIMINAR_VENTA"){ //ELIMINO UNA VENTA CON SU IDVENTA
      /*####*/


      $idVenta=$request->idVenta;
        
      $libroxventa=LibroxVenta::where('idVenta',$idVenta)->first(); 
      $venta=Venta::where('idVenta',$idVenta)->first();

      if($libroxventa) {
        $libroxventa->delete();
        }
        
        if($venta) {
            $venta->delete();
        }
                
        return redirect('/todasVentas')->with('success', 'Stock has been deleted Successfully');


    }

}





public function updateVenta(Request $request){ //MODIFICO VENTAS

//VENTA

//calculo el nuevo total
$dni= $request->get('dni_cuit');
$cliente = new Cliente();

$cliente=Cliente::where('dni_cuit',$dni)->get();

$subtotal;
$total=0;

    if($cliente->id_tipo_cliente==1){ //GENERAL
        foreach ($request->ISBN as $key => $id){
            $libro=Libro::where('ISBN',$id)->get();
        
                $idDescuento=$request->idDescuento[$key];
                $idDescuento=Descuento::where('idDescuento',$idDescuento)->first();
                $subtotal=$libro->precio_general*$request->CANTIDADtabla[$key];
                $total=$total+((100-$idDescuento->porcentaje)*$subtotal)/100;
        }
        
    }else if($cliente->id_tipo_cliente==2){ //ESTUDIANTE
        foreach ($request->ISBN as $key => $id){
                $libro=Libro::where('ISBN',$id)->get();
            $idDescuento=$request->idDescuento[$key];
            $idDescuento=Descuento::where('idDescuento',$idDescuento)->first();
            $subtotal=$libro->precio_estudiante*$request->CANTIDADtabla[$key];
            $total=$total+((100-$idDescuento->porcentaje)*$subtotal)/100;
        }

}else if($cliente->id_tipo_cliente==3){ //DOCENTE
    foreach ($request->ISBN as $key => $id){
            $libro=Libro::where('ISBN',$id)->get();
        $idDescuento=$request->idDescuento[$key];
        $idDescuento=Descuento::where('idDescuento',$idDescuento)->first();
        $subtotal=$libro->precio_docente*$request->CANTIDADtabla[$key];
        $total=$total+((100-$idDescuento->porcentaje)*$subtotal)/100;
    }

}




        \DB::table('venta')
        ->where('idVenta', $request->get('idVenta'))
        ->update([
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
            ->where('idVenta', $request->get('idVenta'))
            ->where('ISBN', $id)
            ->update([
            'cant' => $request->cantidad[$key],
            'IdDescuento' => $request->idDescuento[$key]
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
    public function destroy(Venta $venta)
    {
        //
    }



    public function insertVenta(Request $request)
    {

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
            $libro->idDescuento=$request->idDescuento[$key];

        
            \DB::table('libroxventa')->insert(
            ['ISBN' => $libro->ISBN, 
            'idVenta' => $libro->idVenta, 
            'cant' => $libro->cant, 
            'idDescuento' => $libro->idDescuento, 

            ]);
            $titulo=\DB::table('libro')->select('titulo')->where("ISBN","=",$libro->ISBN)->get();
            $info[$i]["ISBN"]=$id;
            $info[$i]["titulo"]=$titulo;
            $info[$i]["cantidad"]=$request->CANTIDADtabla[$key];
            $i++;
            


        }
        //busco los datos del cliente
        $cliente=\DB::table('cliente')->select('*')->where("dni_cuit","=",$nuevaVenta->Cliente_dni_cuit)->get();
        //table('cliente')->select('dni_cuit','nombre_apellido','domicilio','telefono','email')->where('nombre_apellido','=',$cli)->get();
        
        return view('recibo.alta')->with('nuevaVenta',$nuevaVenta)->with('info',$info)->with('cliente',$cliente)->with('total',$total);
        //$talonario=\DB::table('talonario')->select('*')->get()->last();
        //return response()->json($talonario);
        //info lo tenes que recorrer como el array de notificacion para el cuerpo del mail, depues nuevaVenta 
        //es una objeto comun. $nuevaVenta tiene:fecha, y dni_cuit del cliente.
        //info tiene los ISBN, y la cantidad
        // y $cliente tiene todos los datos de cliente.
        // $total tiene el total ya con descuentos y cantidades multiplicadas
        //faltaria ponerle el numero de recibo pero todavia lo estoy pensando 
    }



}