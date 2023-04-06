<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://bootswatch.com/4/lux/bootstrap.min.css">
    <title>Alarmas Activas</title>
</head>
<body>
    
    
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a href="#" class="navbar-brand"> Alarmas Activas</a>
    <ul class="navbar-nav ml-auto">
        <ul class="navbar-nav ml-auto">
            <form class="form-inline my-2 my-lg-0">
              <input name="search" id="search" class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
              <button class="btn btn-success my-2 my-sm-0" type="submit">
                Search
            </button>
            </form>
    </ul>
        
    </nav>

<div class="container p-4">

<div class="row">
 
    <div class="col-md-7">
         
            <table class="table table-bordered table-sm">
                <thead>
                    <tr>
                    <td>Id</td>
                    <td>Dias</td>
                    <td>Hora</td>
                    <td>Estado</td>
                    <td>Destinatario</td>
                    <td>description</td>
                    </tr>
                </thead>
                <tbody id="tasks-active">
                    
                </tbody>
            </table>

    </div>
    <div class="card my-4" id="tasksSearch-result">
                    <div class="card-body">
                        <ul id="container"> </ul>
                    </div>
                </div>
</div>

</div>


    <script src="https://code.jquery.com/jquery-3.6.1.min.js" 
    integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
    <script src="appAlarma.js"> </script>
</body>
</html>