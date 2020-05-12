@include('layout')


        <div class=" container ">
        <h1> Agregar Talonario </h1>
        <BR>
            <form action="agregarTalonario/alta">
            

                <div class="row">
                    <div class="col-25">
                            <labe for="id_talonario" style="font-size:20px;">Numero de Talonario</label>
                    </div>
                    <div class="col-75">
                        <input type="number" id="id_talonario" name="id_talonario"  value=""  style="width: 100%;padding: 12px;border: 1px solid #ccc;border-radius: 4px;resize: vertical;">
                    </div>
                </div>
<BR>
                <div class="row">
                    <div class="col-25">
                        <label for="nro_inicio"  style="font-size:20px;"> Numero de Inicio de recibos </label>
                    </div>
                    <div class="col-75">
                      <input type="number" id="nro_inicio" name="nro_inicio"  value=""  style="width: 100%;padding: 12px;border: 1px solid #ccc;border-radius: 4px;resize: vertical;">
                    </div>
                </div>
                <BR>
                <div class="row">
                    <div class="col-25">
                        <label for="nro_fin"  style="font-size:20px;"> Numero de Fin de reciibos </label>
                    </div>
                    
                    <div class="col-75">
                        <input type="number" id="nro_fin" name="nro_fin"  style="width: 100%;padding: 12px;border: 1px solid #ccc;border-radius: 4px;resize: vertical;">
                    </div>
                </div>
                
                <br>
                 <div align="right" style="margin-top: 10px;">
                       <button type="submit" class="btn btn-primary btn-lg btn-block">Agregar</button>
                </div>
            </form>
           
        </div>