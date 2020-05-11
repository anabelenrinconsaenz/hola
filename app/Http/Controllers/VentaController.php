<?php

namespace App\Http\Controllers;

use App\Libro;
use App\Cliente;
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
        

        return view('altaVentas')->with($datos)->with($cliente);
    }




public function Ventas(){//TODAS LAS VENTAS

    $totalVentas['totalVentas']=Venta::all();

    $totalLibroxVenta['totalLibroxVenta']=LibroxVenta::all();

    return view('Ventas')->with($totalVentas)->with($totalLibroxVenta);

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

        \DB::table('venta')
        ->where('idVenta', $request->get('idVenta'))
        ->update([
            'idVenta' => $request->get('idVenta'),
            'fecha' => $request->get('fecha'),
            'condicion' => $request->get('condicion'),
            'lugar' => $request->get('domicilio'),
            'Cliente_dni_cuit' => $request->get('dni_cuit')
        ]);
        


//LIBRO X VENTA
        foreach ($request->ISBN as $key => $id) 
        {
            \DB::table('libroxventa')
            ->where('idVenta', $request->get('idVenta'))
            ->where('ISBN', $id)
            ->update([
            'cant' => $request->cantidad[$key]
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

       $idVenta = \DB::table('venta')->insertGetId(
        ['fecha' => $nuevaVenta->fecha, 
        'condicion' => $nuevaVenta->condicion, 
        'lugar' => $nuevaVenta->lugar, 
        'Cliente_dni_cuit' => $nuevaVenta->Cliente_dni_cuit
        ]);

       
//INSERTO LIBRO X VENTA

        foreach ($request->ISBNtabla as $key => $id) 
        {
            
            $libro = new LibroxVenta();
            $libro->ISBN=$id;
            $libro->idVenta=$idVenta;
            $libro->cant=$request->CANTIDADtabla[$key];
            
        
            \DB::table('libroxventa')->insert(
            ['ISBN' => $libro->ISBN, 
            'idVenta' => $libro->idVenta, 
            'cant' => $libro->cant, 
            ]);


        }

        return redirect('/todasVentas');

    }



}