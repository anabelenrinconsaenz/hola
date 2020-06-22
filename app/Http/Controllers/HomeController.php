<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function inicioBU()
    {
        return view('backupFront/buFront');
    }

    public function iniBackup()
    {
        //$rta=\Artisan::call('backup:run --only-db');
        \Artisan::call('backup:run',['--only-db'=>true]); 
        //\Artisan::call('backup:run'); 
        //\Artisan::call('make:controller Prueba');
        return back()->with('mensaje','Backup realizado con exito');
        //return back()->with('mensaje','RTA: '.$rta);
    }
}
