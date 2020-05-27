<?php

namespace App\Http\Controllers;

use App\Libro;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;

use App\Http\Controllers\Exception;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Arr;
use Redirect;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\View;
use App\Notificaciones;
use App\Http\Controllers\DB;
use App\LibroxVenta;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Mockery\Matcher\Not;

class LibroController extends Controller
{

    //VENTAS

    public function buscador(Request $request){//SI QUIERO HACERLO POR AUTOR SOLO AGREGO QUE TAMBIEN COMPARE CON AUTOR
        $librosAJAX=Libro::where("titulo","like","%".$request->texto."%")->take(2)->get();
        return view("paginas",compact("librosAJAX"));
    }



    //



    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() //Retorna la vista indexLibro en respuesta a la ruta "/"
    {

        return view('indexLibro'); 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() //Retorna la vista createLibro en respuesta a la ruta "/Libro/Create"
    {
        return view('createLibro');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) /*Realiza una carga de datos a la base de datos, en respuesta a
                                                un llamado post dentro de alguna vista referente a libro*/
    {
        $dataLibro=$request->all();
        //$dataLibro=$request->except('_token');
        Libro::insert($dataLibro);
        return "Libro Creado!";

        //return response()->json($dataLibro);
        
    }

    public function buscar (Request $request){

        $dataLibro=$request->all();
        $libros=\DB::table('libro')->select('*')
        ->where('ISBN', '=', $dataLibro)->get();
        return $libros;
    }

    public function consultar (Request $request){

        $dataLibro=$request->all();
        $libros=\DB::table('libro')->select('*')
        ->where('ISBN', '=', $dataLibro)->get();
        return $libros;
    }

    public function eliminar (Request $request){

        $id=$request->all();
        \DB::table('libro')->where('ISBN', '=', $id)->delete();
        return "Libro Eliminado!";
    }

    public function editar (Request $request){

        $isbn = $request->ISBN;
        $libro = Libro::where('ISBN',$isbn)->get();

        return view('modificarLibro',['libro' => $libro]);
    }

    public function modificar (Request $request){

        //$request->all();

        \DB::table('libro')
        ->where('ISBN', $request->get('id'))
        ->update([
            'ISBN' => $request->get('id'),
            'titulo' => $request->get('titulo'),
            'autor' => $request->get('autor'),
            'editorial' => $request->get('editorial'),
            'cant_venta' => $request->get('venta'),
            'cant_deposito' => $request->get('deposito'),
            'stock_min' => $request->get('stock_min'),
            'precio_estudiante' => $request->get('estudiante'),
            'precio_general' => $request->get('general'),
            'precio_docente' => $request->get('docente')
        ]);
        
        //return "Libro modificado con exito!";
        
        return redirect('paginaprincipal');
    }

    public function agregarStock (Request $request){

        //$x = "\"".$request->get('id')."\"";
        \DB::table('libro')
        ->where('ISBN',$request->get('id'))
        ->update([
            'cant_deposito' => $request->get('cant_deposito') + $request->get('stock')
        ]);

        //return $x;
        return "Deposito actualizado!";

        /*$x = "\"".$request->get('id')."\"";
        return response()->json($x);*/
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Libro  $libro
     * @return \Illuminate\Http\Response
     */
    
    public function altaNotificar(){
       //se cargan en la base de datos en la tabla notificaciones aquellos libros que en doposito tengan 
       //una cantidad menor al limite de stock minimo establecido
        $libros=\DB::select('SELECT ISBN,titulo,cant_deposito FROM libro WHERE cant_deposito <= stock_min');
        $notificaciones=Notificaciones::all();
        $flag=false;
        foreach($libros as $li){
            $nuevaNotificacion = new Notificaciones();
            $nuevaNotificacion->ISBN=$li->ISBN;
            $nuevaNotificacion->titulo=$li->titulo;
            $nuevaNotificacion->cant_deposito=$li->cant_deposito;
            $nuevaNotificacion->leido=0;
           //antes de cargarla en la base de datos nos fijamos que no exista ya ese libro en notificaciones
            foreach($notificaciones as $not){
                if($li->ISBN == $not->ISBN){
                    $flag=true;
                }
            }
            //si no existe previamente lo cargamos
            if($flag==false){
                \DB::table('notificaciones')->insert(
                    ['ISBN' => $nuevaNotificacion->ISBN,
                    'titulo' => $nuevaNotificacion->titulo, 
                    'cant_deposito' => $nuevaNotificacion->cant_deposito, 
                    'leido'=> $nuevaNotificacion->leido,
                    ]);
           }
        }
        return response()->json("se cargo correctamente");
    }
    public function bajaNotificacion($id)
    {
        //buscamos la notificaciones que queremos borrar por id
        $noti=Notificaciones::where('ISBN', '=',$id);
        // La eliminamos de la base de datos
        $noti->delete();
        return redirect('notificaciones');
    }
    public function verNotificacion()
    {
        //codigo mostrar notificacion
        $notificaciones=Notificaciones::all();
        //cantidad de notificaciones que existen
        $cant=Notificaciones::count();
        return view('notificacion')->with('notificaciones',$notificaciones)->with('cant',$cant);
    }
    public function modificarNotificacion($id)
    {
        //codigo modificar notificacion
       //buscamos la notificaciones que queremos modificar por id
       $noti=\DB::table('notificaciones')->select('ISBN','titulo','cant_deposito','leido')->where('ISBN','=',$id)->get();
       // La eliminamos de la base de datos
        foreach($noti as $n){
        $nuevaNotificacion = new Notificaciones();
        $nuevaNotificacion->ISBN=$n->ISBN;
        $nuevaNotificacion->titulo=$n->titulo;
        $nuevaNotificacion->cant_deposito=$n->cant_deposito;
        $nuevaNotificacion->leido=1;
        }
       \DB::table('notificaciones')
       ->where('ISBN',$id)
       ->update([
           'ISBN' => $nuevaNotificacion->ISBN,
           'titulo' => $nuevaNotificacion->titulo,
           'cant_deposito' => $nuevaNotificacion->cant_deposito,
           'leido' =>$nuevaNotificacion->leido
       ]);
       return redirect('notificaciones');
      
    }
    public function enviarMail()
    {
        //codigo enviar la notificacion
        $notificaciones=\DB::table('notificaciones')->select('ISBN','titulo','cant_deposito','leido')->where('leido','=',0)->get();
        $id=1;
        //return response()->json($notificaciones);
        foreach($notificaciones as $n){
            $info[$id]["ISBN"]=$n->ISBN;
            $info[$id]["titulo"]=$n->titulo;
            $info[$id]["cant_deposito"]=$n->cant_deposito;
            $id++;
        }
        
        Mail::send('mail',['info'=> $info], function ($message) {
            $message->from('libreriarectorado@gmail.com');
            $message->subject('Notificacion compra de libro');
            $message->to('libreriarectorado@gmail.com');
        });        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Libro  $libro
     * @return \Illuminate\Http\Response
     */
    public function edit(Libro $libro)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Libro  $libro
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Libro $libro)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Libro  $libro
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Libro::destroy($id);
    }
    

    //FUNCIONES DE LA PAGINA PRINCIPAL


    public function paginaprincipal() //PAGINA PRINCIPAL
    {
        
       $totalLibros=Libro::orderBy('titulo','ASC')->paginate(10);
       $LibrosxVentas=LibroxVenta::all();

       $this->altaNotificar(); //SE CARGAN LAS NOTIFICACIONES NUEVAS
        return view('listarLibros',compact('totalLibros','LibrosxVentas'));
    
    }

    public function paginaprincipalBuscador(Request $request) //BUSCADOR DE PAGINA PRINCIPAL POR TEXTO
    {
        $totalLibros=Libro::where("titulo","like","%".$request->texto."%")->orWhere("editorial","like","%".$request->texto."%")->orWhere("autor","like","%".$request->texto."%")->take(10)->get();
        return view("paginaprincipal",compact('totalLibros'));
    }


    public function todos() //VUELVO A MOSTRAR TODOS LOS LIBROS DESPUES DE QUE TEXTO ES NULO
    {
        // $totalLibros['totalLibros']=Libro::all();
         $totalLibros=Libro::orderBy('titulo','ASC')->paginate(10);
         return view('paginaprincipal',compact('totalLibros'));

        // return view('paginaprincipal')->with($totalLibros);
  
    }
}