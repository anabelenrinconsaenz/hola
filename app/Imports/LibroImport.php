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
        $trueISBN=$row[1];
        
        $consultaISBN=\DB::select("SELECT COUNT(*) AS cant FROM libro WHERE ISBN=\"".$row[1]."\"");
        foreach($consultaISBN as $c){
            $data=$c->cant;
        } 

        if($data>0){ //si se cumple, entonces el ISBN ya existe, por lo que toca hacer un update.

            /* \DB::table('libro')->where('ISBN', '=', $row[1])->delete(); */
            /*\DB::table('libro')
              ->where('ISBN', "\"".$row[1]."\"")
              ->update(['precio_general' => $row[6],'precio_estudiante' => $row[7]]); */
              if (!is_null($row[6])){
                \DB::update(
                    "UPDATE libro SET precio_general =".$row[6]." WHERE ISBN = \"".$row[1]."\""
                  );
              }
              if (!is_null($row[7])){
                \DB::update(
                    "UPDATE libro SET precio_estudiante =".$row[7]." WHERE ISBN = \"".$row[1]."\""
                  );
              }
            \DB::table('libro')->where('ISBN', '=', 'auxghostybook')->delete();
            $trueISBN="auxghostybook";
        }
        return new libro([
            'ISBN' => $trueISBN,             //B
            'titulo' => $row[2],            //C
            'editorial' => $row[3],         //D
            'precio_general' => $row[6],    //G
            'precio_estudiante' => $row[7], //H
        ]);
    }
}