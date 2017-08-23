var  itemMostrado=[], ciudad_f, tipos_f;

function mostrarTodos(event){
  event.preventDefault();
  $(".colContenido").html(itemMostrado);
}

function datos(){
    $.ajax({
          data:  "",
          url:   "./php/lib.php",
          type:  "post",
          dataType: "json",
          success:  function (response) {
            tituloContenido=response.tituloContenido;
            ciudad_f = response.ciudades;
            tipos_f= response.tipos;
            // carga filtros
            filtrosInit(ciudad_f,tipos_f);
            //si se presiona mostrarTodos antes de hacer consulta se nuestre todo el contenido
            for(i=0; i<100;i++){
              itemMostrado[i]=response[i];
            }
          }
    });
}

function filtrosInit(ci,ti){
  // para cargue los filtros
  var filtro1 = JSON.stringify(ci);
  var filtro2 = JSON.stringify(ti);

  var largo1 = filtro1.length-2;
  var largo2 = filtro2.length-2;

  filtro1 = filtro1.substr(1,largo1);
  filtro2 = filtro2.substr(1,largo2);

  filtro1 = filtro1.replace(/['"]+/g, '');
  filtro2 = filtro2.replace(/['"]+/g, '');


  // convertir string a array
  filtro1 = filtro1.split(',');
  filtro2 = filtro2.split(',');

  //  jQuery que carga la pagina

    $('#selectCiudad').append('<option value="'+filtro1[0]+'">'+filtro1[0]+'</option>',
      '<option value="'+filtro1[1]+'">'+filtro1[1]+'</option>',
      '<option value="'+filtro1[2]+'">'+filtro1[2]+'</option>',
      '<option value="'+filtro1[3]+'">'+filtro1[3]+'</option>',
      '<option value="'+filtro1[4]+'">'+filtro1[4]+'</option>'
    );

    $('#selectTipo').append('<option value="'+filtro2[0]+'">'+filtro2[0]+'</option>',
      '<option value="'+filtro2[1]+'">'+filtro2[1]+'</option>',
      '<option value="'+filtro2[2]+'">'+filtro2[2]+'</option>'
    );

    $("select").material_select('update');

}

function envio_de_datos(){

    var ciudad = $('#selectCiudad').val();
    var tipo = $('#selectTipo').val();
    var rango = $('#rangoPrecio').val();
    var filtro= 'ciudad='+ciudad +'&tipo='+tipo+'&precio='+rango;

    $.ajax({
          type:  "post",
          url: "./php/buscador.php",
          data: filtro,
          dataType: "json",
          success:  function (response) {
            if(response!=""){
              $(".colContenido").html(response);
            }else {
              $(".colContenido").html('<div class="tituloContenido card"><h5>No se encuentran resultados de la búsqueda!</h5><div class="divider"></div><button type="button" name="todos" class="btn-flat waves-effect" id="mostrarTodos">Mostrar Todos</button></div>');
            }
          }
    });
return false;
}

$(function(){
  datos();
  $("#mostrarTodos").click(mostrarTodos);
})
