$(document).ready(function(){

    console.log('jQuery is working');
    //Oculta card antes de buscar resultados
    $('#tasksSearch-result').hide();

    //capturar el input de search 
    $('#search').keyup(function(e){
        //Si el campo search tiene datos ejecuta la busqueda sino queda en blanco.
       if($('#search').val()){
         //guardar el valor en una variable
         let search = $('#search').val();
         $.ajax({
             url: 'buscador-alarma.php',
             type: 'POST',
             data: {search},
             success: function(respuesta){
              let tasksSearch = JSON.parse(respuesta);
              let template = '';
              tasksSearch.forEach(tasksSearch => {
                     template += `<li>
                     ${tasksSearch.hora}
                     
                     ${tasksSearch.descripcion}
                     </li>`
                 });
                 //llena el container con el template y los datos de bsuqueda
                 $('#container').html(template);
                 //Muesta los datos de la busqueda en la card.
                 $('#tasksSearch-result').show();
             }
 
         });
       }
    });




$.ajax({
    url: 'tablaAlarma.php',
    Type: 'GET',
    success: function(respuesta){
        //asignando los datos de tablaAlarma a una variable para mostrar en tabla
       let tasksActive = JSON.parse(respuesta);
       let template='';
       tasksActive.forEach(tasksActive =>{
        template+= `
        <tr>
        <td>${tasksActive.id}</td>
        <td>${tasksActive.dias_frecuencia}</td>
        <td>${tasksActive.hora}</td>
        <td>${tasksActive.estado}</td>
        <td>${tasksActive.destinatario}</td>
        <td>${tasksActive.descripcion}</td>
        </tr>
        `
       });
       //Ahora decimos a donde queremos mostrarlo
       $('#tasks-active').html(template);
    }
})









});