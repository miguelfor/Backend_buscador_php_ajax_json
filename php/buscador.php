<?php
  //llamado a leer.php 
  require('leer.php');
  //se visualizara en json a ajax
  $response=array();
  //para capturar las captura variables
  if($_POST['ciudad'] != "null"){
      $ciudad = $_POST['ciudad'];
  }else{
    $ciudad = null;
  }
  if($_POST['tipo'] != "null"){
      $tipo = $_POST['tipo'];
  }else{
    $tipo = null;
  }
    $p = $_POST['precio'];
    $precio = explode(";",$p);
    $precio_i = intval($precio[0]);
    $precio_f = intval($precio[1]);
    
      if($ciudad != null && $tipo != null){// nos empieza a filtrar
        // si  existe la  ciudad y tipo muestre resultado:
        foreach ($data as $key => $value) {
          $arreglar = array("$",",");
          $valor = str_replace($arreglar,"",$value['Precio']);
          $valor = intval($valor);
          // filtro por precio
          if($precio_i<=$valor && $valor<= $precio_f){
            if($ciudad == $value['Ciudad'] && $tipo == $value['Tipo'] ){
              $response[$key] = '<div class="itemMostrado card">
                      <img src="img/home.jpg">
                        <div class="card-stacked">
                          <span><strong>&nbsp;&nbsp;&nbsp;Direccion :</strong>'.$value['Direccion'].'</span><br />
                          <span><strong>&nbsp;&nbsp;&nbsp;Ciudad : </strong>'.$value['Ciudad'].'</span><br />
                          <span><strong>&nbsp;&nbsp;&nbsp;Telefono : </strong>'.$value['Telefono'].'</span><br />
                          <span><strong>&nbsp;&nbsp;&nbsp;Codigo Postal : </strong>'.$value['Codigo_Postal'].'</span><br />
                          <span><strong>&nbsp;&nbsp;&nbsp;Tipo : </strong>'.$value['Tipo'].'</span><br />
                          <span><strong>&nbsp;&nbsp;&nbsp;Precio : </strong><span class="precioTexto">'.$value['Precio'].'</span></span><br /><br />
                        <div class="divider"></div>
                        <div class="card-action">VER MAS</div>
                        </div>
                      </div>';
            }
          }
        }
      }else if($ciudad !=null xor $tipo !=null){
        // verifica si alguno de los dos existe:
        foreach ($data as $key => $value) {
          $arreglar = array("$",",");
          $valor = str_replace($arreglar,"",$value['Precio']);
          $valor = intval($valor);
          // y lo filtro por precio
          if($precio_i<=$valor && $valor<= $precio_f){
            if($ciudad == null){
              if($tipo == $value['Tipo']){
                $response[$key] = '<div class="itemMostrado card">
                        <img src="img/home.jpg">
                          <div class="card-stacked">
                            <span><strong>&nbsp;&nbsp;&nbsp;Direccion :</strong>'.$value['Direccion'].'</span><br />
                            <span><strong>&nbsp;&nbsp;&nbsp;Ciudad : </strong>'.$value['Ciudad'].'</span><br />
                            <span><strong>&nbsp;&nbsp;&nbsp;Telefono : </strong>'.$value['Telefono'].'</span><br />
                            <span><strong>&nbsp;&nbsp;&nbsp;Codigo Postal : </strong>'.$value['Codigo_Postal'].'</span><br />
                            <span><strong>&nbsp;&nbsp;&nbsp;Tipo : </strong>'.$value['Tipo'].'</span><br />
                            <span><strong>&nbsp;&nbsp;&nbsp;Precio : </strong><span class="precioTexto">'.$value['Precio'].'</span></span><br /><br />
                          <div class="divider"></div>
                          <div class="card-action">VER MAS</div>
                          </div>
                        </div>';
              }
            }else if($tipo == null){
              if($ciudad == $value['Ciudad']){
                $response[$key] = '<div class="itemMostrado card">
                        <img src="img/home.jpg">
                          <div class="card-stacked">
                            <span><strong>&nbsp;&nbsp;&nbsp;Direccion :</strong>'.$value['Direccion'].'</span><br />
                            <span><strong>&nbsp;&nbsp;&nbsp;Ciudad : </strong>'.$value['Ciudad'].'</span><br />
                            <span><strong>&nbsp;&nbsp;&nbsp;Telefono : </strong>'.$value['Telefono'].'</span><br />
                            <span><strong>&nbsp;&nbsp;&nbsp;Codigo Postal : </strong>'.$value['Codigo_Postal'].'</span><br />
                            <span><strong>&nbsp;&nbsp;&nbsp;Tipo : </strong>'.$value['Tipo'].'</span><br />
                            <span><strong>&nbsp;&nbsp;&nbsp;Precio : </strong><span class="precioTexto">'.$value['Precio'].'</span></span><br /><br />
                          <div class="divider"></div>
                          <div class="card-action">VER MAS</div>
                          </div>
                        </div>';
              }
            }
          }
        }
      }else{
        // y si no existen:
        foreach ($data as $key => $value) {
          $arreglar = array("$",",");
          $valor = str_replace($arreglar,"",$value['Precio']);
          $valor = intval($valor);
        
          if($precio_i<=$valor && $valor<= $precio_f){
            $response[$key] = '<div class="itemMostrado card">
                    <img src="img/home.jpg">
                      <div class="card-stacked">
                        <span><strong>&nbsp;&nbsp;&nbsp;Direccion :</strong>'.$value['Direccion'].'</span><br />
                        <span><strong>&nbsp;&nbsp;&nbsp;Ciudad : </strong>'.$value['Ciudad'].'</span><br />
                        <span><strong>&nbsp;&nbsp;&nbsp;Telefono : </strong>'.$value['Telefono'].'</span><br />
                        <span><strong>&nbsp;&nbsp;&nbsp;Codigo Postal : </strong>'.$value['Codigo_Postal'].'</span><br />
                        <span><strong>&nbsp;&nbsp;&nbsp;Tipo : </strong>'.$value['Tipo'].'</span><br />
                        <span><strong>&nbsp;&nbsp;&nbsp;Precio : </strong><span class="precioTexto">'.$value['Precio'].'</span></span><br /><br />
                      <div class="divider"></div>
                      <div class="card-action">VER MAS</div>
                      </div>
                    </div>';
          }
        }
      }
    //evie la  respuesta
    $res=array_unique($response);
    $r= array_values($res);
    //json eviado
    echo json_encode($r);
?>