$(document).ready(function(){
 
      //capturar el input de search 
      $('#search').keyup(function(e){
          //Si el campo search tiene datos ejecuta la busqueda sino queda en blanco.
         if($('#search').val()){
           //guardar el valor en una variable
           let search = $('#search').val();
           $.ajax({
            url: 'tabla-informe.php',
            type: 'POST',
             data: {search},
            success: function(respuesta){
                //asignando los datos de tablaAlarma a una variable para mostrar en tabla
               let informeTablas = JSON.parse(respuesta);
               let template='';
               informeTablas.forEach(informeTabla =>{
                template+= `
            
                <tr>
                <th>Operaciones Totales</th><td>${informeTabla.cantidad_total_operaciones}</td><td>${informeTabla.total_suma}</td>
                </tr>
                <tr>
                <th>Operaciones Confirmadas</th><td>${informeTabla.cantidad_estado1}</td><td>${informeTabla.montos_estado1}</td>
                </tr>
                <tr>
                <th>Operaciones Pendientes</th><td>${informeTabla.cantidad_estado0}</td><td>${informeTabla.montos_estado0}</td>
                </tr>
            
                `
               });
               //Ahora decimos a donde queremos mostrarlo
               $('#informe-operaciones').html(template);
          
            }
        });
         }
      });

//capturar los datos para agregar en base de dato

$('#pago-form').submit(e => {
    e.preventDefault();

    const postData = {
        tipo_operacion: $('#tipo_operacion').val(),
        nombre_empresa: $('#nombre_empresa').val(),
        rut_empresa: $('#rut_empresa').val(),
        fecha_pago: $('#fecha_pago').val(),
        nombre_banco: $('#nombre_banco').val(),
        tipo_cuenta: $('#tipo_cuenta').val(),
        numero_cuenta: $('#numero_cuenta').val(),
        monto: $('#monto').val(),
        fecha_ingreso: $('#fecha_ingreso').val(),
        id_usuario: $('#id_usuario').val(),
        descripcion: $('#descripcion').val()

};
 




//enviar los datos a pago-app.php
$.post('pago-add.php',postData, function(respuesta) {
    console.log(respuesta);
    
    $('#pago-form').trigger('reset');
    if(postData===""){

    }else{
        swal({
            title: 'Operacion registrada con exito!',
            icon: 'success',
            timer: 5000,
    
    
    
        });
        
    }
  
    

});


});



$.ajax({
    url: 'tabla-informe.php',
    type: 'GET',
    success: function(respuesta){
        //asignando los datos de tablaAlarma a una variable para mostrar en tabla
       let informeTablas = JSON.parse(respuesta);
       let template='';
       informeTablas.forEach(informeTabla =>{
        template+= `
    
        <tr>
        <th>Operaciones Totales</th><td>${informeTabla.cantidad_total_operaciones}</td><td>${informeTabla.total_suma}</td>
        </tr>
        <tr>
        <th>Operaciones Confirmadas</th><td>${informeTabla.cantidad_estado1}</td><td>${informeTabla.montos_estado1}</td>
        </tr>
        <tr>
        <th>Operaciones Pendientes</th><td>${informeTabla.cantidad_estado0}</td><td>${informeTabla.montos_estado0}</td>
        </tr>
    
        `
       });
       //Ahora decimos a donde queremos mostrarlo
       $('#informe-operaciones').html(template);
  
    }
});



});