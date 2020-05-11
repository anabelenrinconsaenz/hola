<?php

namespace App\Imports;

use App\libro;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithCalculatedFormulas;

class LibroImport implements ToModel, WithCalculatedFormulas
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        //$row->skipColumns(4);
        //$row->calculate();
        
        $consultaISBN=\DB::select("SELECT COUNT(*) AS cant FROM libro WHERE ISBN=\"".$row[1]."\"");
        foreach($consultaISBN as $c){
            $data=$c->cant;
        } 

        if($data>0){ //si se cumple, entonces el ISBN ya existe, por lo que toca hacer un update.
            \DB::table('libro')->where('ISBN', '=', $row[1])->delete();//borrar registro para poder cargarlo denuevo.
        }

        return new libro([
            'ISBN' => $row[1],              //B
            'titulo' => $row[2],            //C
            'editorial' => $row[3],         //D
            'precio_general' => $row[6],    //G
            'precio_estudiante' => $row[7], //H
        ]);
    }
}
