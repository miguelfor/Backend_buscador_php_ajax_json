<?php
  require('leer.php');
  //arreglo devuelto en json a ajax
  $response=array();
  // ciudades y tipos a cargar, y las  filtra
  $ciudades=array();
  $tipos=array();
  $response['tituloContenido'] = '<div class="tituloContenido card">
                    <h5>Resultados de la búsqueda:</h5>
                    <div class="divider"></div>
                    <button type="button" name="todos" class="btn-flat waves-effect" id="mostrarTodos">Mostrar Todos</button>
                    </div>';
  foreach ($data as $key => $value) {
    // seleccionar ciudades
    $ciudades[$key]=$value['Ciudad'];
    $tipos[$key]=$value['Tipo'];
    // valor que devolbera
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
  // filtro de ciudades y tipo
  $ciudades_f=array_unique($ciudades);
  $ciudades_filtradas= array_values($ciudades_f);
  $tipos_f= array_unique($tipos);
  $tipos_filtrados= array_values($tipos_f);
  //  variable filtrada
  $response['ciudades'] =$ciudades_filtradas;
  $response['tipos']=$tipos_filtrados;
  //json eviado
  echo json_encode($response);
  fclose($file);
?>