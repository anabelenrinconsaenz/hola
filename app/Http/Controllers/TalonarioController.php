<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use App\Descuento;
use App\Talonario;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Mail;

class TalonarioController extends Controller
{
    public function show()
    {
        $talonario=Talonario::all();
     
        return view('talonarios')->with('talonario',$talonario);
    }

    
    public function store()
    {
        return view('altaTalonario'); 
    }

    public function create(Request $request)
    {
        $datosTalonario=request()->all();
        //Talonario::insert($datosTalonario);
        \DB::table('talonario')->insert(
            ['id_talonario' => $request->get('id_talonario') ,
            'nro_inicio' => $request->get('nro_inicio'), 
            'nro_fin' =>  $request->get('nro_fin'), 
            'estado'=> '0',
            'nro_actual'=> $request->get('nro_inicio')-1, ///siempre positivo
            ]);
        return redirect('talonario');
       
    }

    public function modificar($ID)
    {
        
    }

    public function enviarMailFacturacion ($ID){
       
        //codigo enviar la notificacion
        /*$id=1;
        $recibos=\DB::table('recibo')
        ->join('libroxventa', 'libroxventa.idVenta', '=', 'recibo.idVenta')
        ->join('venta', 'venta.idVenta', '=', 'recibo.idVenta')
        ->select('*')
        ->where('recibo.talonario_id_talonario', '=',$ID)
        ->get();
        foreach($recibos as $re){
            $info[$id]["total"]=$re->total;
            $id++;
        }//ver bien como obtner el titulo del libro y los datos de cliente
        
        //return response()->json($notificaciones);
        
        
        Mail::send('mailFacturacion',['info'=> $info], function ($message) {
            $message->from('libreriarectorado@gmail.com');
            $message->subject('Facturacion Libreria Rectorado General Pico');
            $message->to('libreriarectorado@gmail.com');
        });  */
        return redirect('talonario');
    }

    

    public function update(Request $request, Descuento $descuento)
    {

    }

    public function destroy($ID)
    {
        
    }
}