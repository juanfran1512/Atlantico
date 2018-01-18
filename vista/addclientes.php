<?php
error_reporting( error_reporting() & ~E_NOTICE );
include_once("../modelo/clsZona.php");
//se crea el Objeto Cliente de la clase Cliente
//--------------------------------------------------------------------
  //se crea el Objeto Zona de la clase Zona
  //--------------------------------------------------------------------

  $objzona = new clsZona();
  $objmunicipio = new clsZona();
  $objzona->listarzona(); //llamamos la funcion listar que tiene la clase clsZona
  $objmunicipio->listarmunicipio(18);
?><meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
    <div class="row">
        <div class="col-xs-12 col-sm-12   "style="margin-top: 15;">
            <div class="panel panel-default">
                    <div class="panel-heading">
                        <img id="formulario-img" src="../default/imagenes/formulario.png" />
                        <strong >Clientes</strong>
                    </div>
                    <div class="panel-body">
                        <form name="form" action="" method="POST" class="form-horizontal" role="form">
                      
                            <div class="form-group">
                                <label class="col-sm-2  control-label"> C.I./RIF:</label>
                          <div class="col-sm-3" >
                              <input type="text" class="form-control" autocomplete="off" name="rif" onblur="this.value=this.value.toUpperCase()" value="<?php echo $arreglo_buscar["tlfn_cli"]?>">
                          </div>
                          <label class="col-sm-2  control-label"> Telefono:</label>
                          <div class="col-sm-3" >
                              <input type="text" class="form-control" autocomplete="off" name="telefono" value="<?php echo $arreglo_buscar["tlfn_cli"]?>">
                          </div>
                          </div>
                                <div class="form-group">
                          <label class="col-sm-2  control-label">* Nombre:</label>
                                <div class="col-sm-8" >
                                    <input type="text" class="form-control" autocomplete="off" name="nombre"  onblur="this.value=this.value.toUpperCase()" value="<?php echo $arreglo_buscar["nom_cli"];?>">
                                </div>
                            </div>

                                            <div class="form-group">
                          

                          <label class="col-sm-2  control-label">* Persona Responsable:</label>
                          <div class="col-sm-8" >
                              <input type="text" class="form-control" autocomplete="off" name="persona"  onblur="this.value=this.value.toUpperCase()" value="<?php echo $arreglo_buscar["pers_cli"]?>">
                          </div>
                            </div>
                      <div class="form-group">
                          

                          <label class="col-sm-2  control-label">* Correo:</label>
                          <div class="col-sm-8" >
                              <input type="text" class="form-control" autocomplete="off" name="correo"  onblur="this.value=this.value.toUpperCase()" value="<?php echo $arreglo_buscar["correo_cli"]?>">
                          </div>
                      </div>
                      <div class="form-group">
                        <label class="col-sm-2  control-label">* Direccion:</label>
                          <div class="col-sm-8" >
                              <input type="text" class="form-control" autocomplete="off" name="direccion"  onblur="this.value=this.value.toUpperCase()" value="<?php echo $arreglo_buscar["dir_cli"]?>">
                          </div>
                      </div>
                      <div class="form-group" >
                                <label class="col-sm-2 control-label">Zona:</label>
                                <div class="col-sm-3" >
                                   <select class="form-control" name="zona">
                               <option >Seleccione la Zona</option>
                             <?php
                                                      while($zona = $objzona->row()){
                                                 ?>
                                <option <?php if($zona['cod_zona'] == $arreglo_buscar["zona_fk"]) print("selected");  ?>     value="<?php  echo $zona['cod_zona'];       ?>"> <?php print($zona['des_zona']); ?></option>
                             <?php
                                }
                             ?>
                             </select>
                                </div>

                          
                          <label class="col-sm-2 control-label">Municipio:</label>
                          <div class="col-sm-3" >
                             <select class="form-control" name="municipio" style="width: 94%;">
                               <option >Seleccione el Municipio</option>
                             <?php
                                  while($muni = $objmunicipio->row()){
                             ?>
                                <option <?php if($muni['cod_muni'] == $arreglo_buscar["municipio_fk"]) print("selected");  ?>     value="<?php  echo $muni['cod_muni'];       ?>"> <?php print($muni['des_muni']); ?></option>
                             <?php
                                }
                             ?>
                             </select>
                          </div>
                            </div>
                      <h6 class="col-sm-offset-3">Nota: Los Campos Marcados con (*) son Obligatorios.</h6>
                            <hr>
                                <div class="col-sm-12">
                                    <input type="submit" class="btn btn-default col-sm-offset-3" name="btnGuardarCli"  value="Guardar">
                                    <input type="button" class="btn btn-default col-sm-offset-2"  name="cerrar" id="cerrar"  onclick="f_cerrar()" value="Cerrar">
                                </div>
                        </form>
                    </div>
            </div>
        </div>
    </div>
