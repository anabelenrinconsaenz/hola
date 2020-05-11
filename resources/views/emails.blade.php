 @import('layout')
<!DOCTYPE html>

<html >
   
   <body>
        <br>hola este mail es para comprobar<br>
      
      $i=0;
         for($i=0;$i<count($id);$i++)
        {
            
            Key:{{$i->$key}}
            Value: {{$i->$value}}
            
        }

       /* @foreach ( $data['1']['0'] as $contact )
            {{$contact }}
         @endforeach*/
   </body>
</html>